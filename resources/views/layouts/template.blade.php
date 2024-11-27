<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetCare</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://unpkg.com/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav id="main-nav" class="navbar navbar-expand-lg"
        style="background-color: #fff; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center">
                <img src="https://img.freepik.com/fotos-premium/nombre-logotipo-pet-care-diseno-eslogan-inspiracion-marca_947814-183110.jpg"
                    alt="Logo Luxe Pet Care" style="width: 75px; height: 75px;" class="me-2">
                <span class="fw-bold text-dark" style="font-size: 2rem;">PetCare</span>
            </a>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ url('/mascotas') }}">Mascotas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ url('/servicios') }}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ url('/citas') }}">Citas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="text-white py-4" style="background-color: #699bc9;">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <!-- Redes Sociales -->
            <div class="mb-3 mb-md-0">
                <p class="mb-2">Síguenos en nuestras redes sociales:</p>
                <div class="d-flex">
                    <a href="https://www.facebook.com" target="_blank" class="text-white mx-2">
                        <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                    </a>
                    <a href="https://www.twitter.com" target="_blank" class="text-white mx-2">
                        <i class="bi bi-twitter" style="font-size: 1.5rem;"></i>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" class="text-white mx-2">
                        <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                    </a>
                    <a href="https://www.google.com/maps" target="_blank" class="text-white mx-2">
                        <i class="bi bi-map" style="font-size: 1.5rem;"></i>
                    </a>
                </div>
            </div>

            <!-- Información de Contacto -->
            <div class="mb-3 mb-md-0">
                <p class="mb-2">Contáctanos:</p>
                <p class="mb-0">Teléfono: +1 123 456 7890</p>
                <p class="mb-0">Correo: contacto@petcare.com</p>
                <p class="mb-0">Dirección: 123 Calle Principal, Ciudad</p>
            </div>

            <!-- Derechos Reservados -->
            <div class="mb-3 mb-md-0 text-md-end">
                <p class="mb-2">&copy; PetCare. Todos los derechos reservados.</p>
                <p class="mb-0">Lunes a Viernes: 8:00 AM - 8:00 PM</p>
                <p class="mb-0">Sábados: 9:00 AM - 6:00 PM</p>
                <p class="mb-0">Domingos: Cerrado</p>
            </div>
        </div>
    </footer>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
