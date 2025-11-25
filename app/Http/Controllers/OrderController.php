<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cesta;
use App\Models\ProductoStock;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Stripe\Stripe;
use Stripe\Checkout\Session;
class OrderController extends Controller
{
    /**
     * Función auxiliar (copiada de CartController) para obtener la Cesta.
     */

    public function pagarConStripe()
    {
        $user = Auth::user();
        if ($user) {
            $cesta = Cesta::where('user_id', $user->id)->first();
        } else {
            $sessionId = session()->getId();
            $cesta = Cesta::where('session_id', $sessionId)->first();
        }

        if (!$cesta || $cesta->productos->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'La cesta está vacía.');
        }

        // 1. Configurar API Key primero (necesaria para crear el cupón)
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // 2. Preparar los productos
        $lineItems = [];
        foreach ($cesta->productos as $producto) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $producto->Nombre . ' (Talla: ' . $producto->pivot->talla . ')',
                    ],
                    'unit_amount' => $producto->Precio * 100, // Céntimos
                ],
                'quantity' => $producto->pivot->cantidad,
            ];
        }

        // 3. GESTIÓN DEL CUPÓN (NUEVO)
        $stripeDiscounts = [];

        if (session()->has('cupon')) {
            $cuponLocal = session('cupon');

            try {
                // Creamos un cupón temporal en Stripe
                if ($cuponLocal['tipo'] === 'porcentaje') {
                    // Si es porcentaje (ej: 20%)
                    $stripeCoupon = \Stripe\Coupon::create([
                        'percent_off' => $cuponLocal['valor'],
                        'duration' => 'once',
                        'name' => $cuponLocal['codigo'],
                    ]);
                } else {
                    // Si es fijo (ej: 10€ -> 1000 céntimos)
                    $stripeCoupon = \Stripe\Coupon::create([
                        'amount_off' => $cuponLocal['valor'] * 100,
                        'currency' => 'eur',
                        'duration' => 'once',
                        'name' => $cuponLocal['codigo'],
                    ]);
                }

                // Lo añadimos a la lista de descuentos para la sesión
                $stripeDiscounts[] = ['coupon' => $stripeCoupon->id];

            } catch (\Exception $e) {
                // Si falla la creación del cupón en Stripe, seguimos sin descuento para no romper la web
                // Opcional: Loguear el error
            }
        }

        // 4. Crear la sesión de pago INCLUYENDO LOS DESCUENTOS
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'discounts' => $stripeDiscounts, // <--- AQUÍ SE APLICA EL DESCUENTO
            'success_url' => route('stripe.success'),
            'cancel_url' => route('cart.show'),
        ]);

        return redirect($checkout_session->url);
    }

    // 2. PAGO COMPLETADO
    public function stripeSuccess() // <--- ANTES ERA success
    {
        // ... (Aquí va EL MISMO código que te pasé en la función success anterior) ...
        // ... Copia la lógica de crear pedido, mover detalle, restar stock, etc. ...

        // (Resumen rápido del código por si no lo tienes a mano)
        $user = Auth::user();
        if ($user) {
            $cesta = Cesta::where('user_id', $user->id)->with('productos')->first();
        } else {
            $cesta = Cesta::where('session_id', session()->getId())->with('productos')->first();
        }

        if (!$cesta) return redirect()->route('home');

        // Calcular total (incluyendo descuentos de cupón si tienes)
        $subtotal = $cesta->productos->sum(function($p) { return $p->Precio * $p->pivot->cantidad; });
        $descuento = 0;
        if (session()->has('cupon')) {
            $cupon = session('cupon');
            $descuento = ($cupon['tipo'] == 'porcentaje') ? $subtotal * ($cupon['valor']/100) : $cupon['valor'];
        }
        $total = max(0, $subtotal - $descuento);

        // Crear Pedido
        $pedido = Pedido::create([
            'user_id' => $user ? $user->id : 1,
            'total' => $total,
            'estado' => 'pagado',
        ]);

        // Mover productos y restar stock
        foreach ($cesta->productos as $producto) {
            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto->id_producto,
                'nombre_producto' => $producto->Nombre,
                'precio_unitario' => $producto->Precio,
                'cantidad' => $producto->pivot->cantidad,
                'talla' => $producto->pivot->talla,
            ]);

            $stock = ProductoStock::where('id_producto', $producto->id_producto)
                ->where('talla', $producto->pivot->talla)->first();
            if ($stock) {
                $stock->stock = $stock->stock - $producto->pivot->cantidad;
                $stock->save();
            }
        }

        $cesta->productos()->detach();
        session()->forget('cupon');

        return view('checkout.success', compact('pedido'));
    }
}
