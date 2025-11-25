@extends('layouts.app')

@section('title', 'Pedido Completado')

@section('content')
        <div class="success-wrapper">

        {{-- Icono Check SVG elegante --}}
        <div class="success-icon-circle">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="success-title">¡Gracias por tu compra!</h1>

        <p class="success-message">
            Tu pedido ha sido procesado con éxito. Hemos enviado un correo electrónico de confirmación con todos los detalles.
        </p>

        {{-- Cajita con el resumen clave --}}
        <div class="order-summary-box">
            <span class="order-ref">Referencia del Pedido</span>
            <div style="font-size: 1.2rem; font-weight: bold; margin-bottom: 10px;">#{{ $pedido->id }}</div>

            <span class="order-ref">Total Pagado</span>
            <div class="order-total">{{ number_format($pedido->total, 2) }}€</div>
        </div>

        <a href="{{ route('home') }}" class="btn-home">
            Volver a la Tienda
        </a>
    </div>
@endsection
