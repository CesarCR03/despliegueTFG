{{-- resources/views/partials/header.blade.php --}}
<header>
    <div class="banner-container">
        <div class="banner-content">
            <span class="carrusel">Nuevo drop el viernes a las 12 am.</span>
            <span class="carrusel">@0.000.000</span>
        </div>
    </div>
    <div class="header-content">
        <nav>
            <span class="enlacesI">
                <span class="hamburg">☰</span>
                @guest
                    <a href="{{ route('login') }}" title="Iniciar Sesión">
                        <img src="{{ asset('Img/PaginaPrincipal/user_17740782.png') }}" class="iconoSesion" alt="Iniciar Sesión">
                    </a>
                @endguest

                @auth
                    {{-- USUARIO: Clicar lleva directamente al Perfil --}}
                    <a href="{{ route('profile.edit') }}" title="Mi Perfil">
                        <img src="{{ asset('Img/PaginaPrincipal/user_17740782.png') }}" class="iconoSesion" alt="Mi Perfil"></a>
                @endauth
            </span>
            <span class="enlacesP">
                <a href="{{ route('tienda') }}" class="aux">Tienda</a>
                <a href="{{ url('menu/drops') }}" class="aux">Drops</a>
                <a href="{{ route('home') }}">
                <img src="{{ asset('Img/PaginaPrincipal/on_black_logo_transparent.png') }}" alt="Logo" class="header-logo"></a>
                <a href="{{ route('locations') }}" class="aux">Locations</a>
                <a href="{{route('influencers')}}" class="aux">Influencers</a>
            </span>
            <ul class="menuPrincipal">
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="{{ route('tienda') }}">Tienda</a></li>
                <li><a href="{{ url('menu/drops') }}">Drops</a></li>
                <li><a href="{{ route('locations') }}">Locations</a></li>
                <li><a href="{{route('influencers')}}">Influencers</a></li>
                <li class="icons-row">
                    <div class="icons-container">
                        {{-- 1. USUARIO --}}
                        @guest
                            <a href="{{ route('login') }}" title="Iniciar Sesión">
                                <img src="{{ asset('Img/PaginaPrincipal/user_17740782.png') }}" alt="Iniciar Sesión">
                            </a>
                        @endguest
                        @auth
                            <a href="{{ route('profile.edit') }}" title="Mi Perfil">
                                <img src="{{ asset('Img/PaginaPrincipal/user_17740782.png') }}" alt="Mi Perfil">
                            </a>
                        @endauth

                        {{-- 2. COMPARTIR --}}
                        <button type="button" onclick="intentarCopiar()" class="btn-share" title="Copiar enlace actual">
                            <img src="{{ asset('Img/PaginaPrincipal/share-alt-square_10470668.png') }}" alt="compartir">
                        </button>

                        {{-- 3. CARRITO --}}
                        <a href="{{ route('cart.show') }}">
                            <img src="{{ asset('Img/PaginaPrincipal/cart-arrow-down_9798256.png') }}" alt="cesta de compra">
                        </a>
                    </div>
                </li>
            </ul>
            <span class="enlacesD">
                <button type="button" onclick="intentarCopiar()" class="btn-share" title="Copiar enlace actual">
                    <img src="{{ asset('Img/PaginaPrincipal/share-alt-square_10470668.png') }}" alt="compartir">
                </button>

                <a href="{{ route('cart.show') }}">
                    <img src="{{ asset('Img/PaginaPrincipal/cart-arrow-down_9798256.png') }}" alt="cesta de compra">
                </a>
            </span>
        </nav>
    </div>
</header>

{{-- IMPORTANTE: El Toast fuera del header y del nav para evitar problemas de CSS --}}
<div id="toast-notification" class="toast">
    ¡Enlace copiado al portapapeles!
</div>
<style>
    /* Estilo para que el botón parezca solo una imagen */
    .btn-share {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        display: inline-flex; /* Alineación correcta */
    }

    /* Estilos del Toast */
    .toast {
        visibility: hidden; /* Oculto por defecto */
        min-width: 250px;
        background-color: #333; /* Fondo oscuro */
        color: #fff; /* Texto blanco */
        text-align: center;
        border-radius: 8px;
        padding: 16px;
        position: fixed;
        z-index: 1000;
        left: 50%;
        bottom: 30px;
        transform: translateX(-50%); /* Centrado horizontal exacto */
        font-size: 14px;
        box-shadow: 0px 4px 6px rgba(0,0,0,0.3);
        opacity: 0;
        transition: opacity 0.5s, bottom 0.5s, visibility 0.5s;
    }

    /* Clase para mostrar el Toast */
    .toast.show {
        visibility: visible;
        opacity: 1;
        bottom: 50px; /* Pequeña animación hacia arriba */
    }
</style>
<script>
    function intentarCopiar() {
        const texto = window.location.href;

        // Opción 1: API Moderna (Requiere HTTPS o localhost)
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(texto).then(() => {
                mostrarToast();
            }).catch(err => {
                console.error('Error API moderna:', err);
                copiarManualmente(texto); // Si falla, usa el plan B
            });
        } else {
            // Opción 2: Plan B (Funciona en http://tfg.test)
            copiarManualmente(texto);
        }
    }

    function copiarManualmente(texto) {
        // Crea un elemento de texto temporal invisible
        const textArea = document.createElement("textarea");
        textArea.value = texto;

        // Lo hace invisible pero parte del DOM
        textArea.style.position = "fixed";
        textArea.style.left = "-9999px";
        textArea.style.top = "0";
        document.body.appendChild(textArea);

        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
            mostrarToast(); // Éxito
        } catch (err) {
            console.error('No se pudo copiar', err);
            alert("No se pudo copiar el enlace automáticamente.");
        }

        document.body.removeChild(textArea);
    }

    function mostrarToast() {
        var toast = document.getElementById("toast-notification");

        // Reset para permitir múltiples clics seguidos
        toast.className = "toast";
        void toast.offsetWidth; // Truco para reiniciar la animación CSS

        toast.className = "toast show";

        setTimeout(function(){
            toast.className = toast.className.replace("show", "");
        }, 3000);
    }
</script>
