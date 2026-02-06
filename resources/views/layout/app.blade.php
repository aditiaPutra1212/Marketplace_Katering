<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace Katering - Solusi Makan Kamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #dc3545; /* Red */
            --secondary-color: #f8f9fa; /* White/Light */
            --dark-color: #212529; /* Black/Dark */
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            color: var(--dark-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* Override all primary colors to Red */
        .btn-primary, .bg-primary, .badge-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }

        a {
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        a:hover {
            color: #a71d2a;
        }

        .navbar {
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .nav-link {
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .footer {
            background-color: #212529;
            color: #f8f9fa;
            padding: 60px 0 20px;
            margin-top: 80px;
        }

        .footer-logo img {
            height: 50px;
            margin-bottom: 20px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
        }

        .hover-danger:hover {
            color: var(--primary-color) !important;
            text-decoration: underline !important;
        }

        .order-card-hover {
            transition: all 0.3s ease;
        }
        
        .order-card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('landing') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <span class="fw-bold text-white">Marketplace Katering</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a></li>
                    
                    @auth
                        @if(Auth::user()->role == 'customer')
                            <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('customer.dashboard') ? 'active text-danger fw-bold' : '' }}" href="{{ route('customer.dashboard') }}">Menu</a></li>
                            <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('customer.orders') ? 'active text-danger fw-bold' : '' }}" href="{{ route('customer.orders') }}">Riwayat</a></li>
                        @elseif(Auth::user()->role == 'merchant')
                            <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('merchant.dashboard') ? 'active text-white bg-danger rounded-pill' : '' }}" href="{{ route('merchant.dashboard') }}">Dashboard Merchant</a></li>
                        @endif

                        <li class="nav-item ms-lg-3">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-4 py-2 fw-bold">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3"><a class="nav-link fw-bold" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item ms-lg-2"><a class="btn btn-danger px-4 rounded-pill fw-bold shadow-sm" href="{{ route('register') }}">Daftar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="container mt-4">
                <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 footer-logo">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                        <span class="h4 fw-bold text-white mb-0 ms-2">Marketplace Katering</span>
                    </a>
                    <p class="mt-3 text-white-50">Solusi katering terbaik untuk setiap acara Anda. Rasa bintang lima, harga kaki lima.</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-4">Tautan Cepat</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2"><a href="{{ route('landing') }}" class="text-decoration-none text-white-50 hover-danger">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-decoration-none text-white-50 hover-danger">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('landing') }}#menu-section" class="text-decoration-none text-white-50 hover-danger">Menu Pilihan</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}" class="text-decoration-none text-white-50 hover-danger">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-4">Layanan</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2">Katering Kantoran</li>
                        <li class="mb-2">Acara Pernikahan</li>
                        <li class="mb-2">Harian Personal</li>
                        <li class="mb-2">Snack Box</li>
                    </ul>
                </div>
                <div class="col-lg-4" id="contact">
                    <h5 class="text-white mb-4">Kontak Kami</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2 text-danger"></i> Jl. Pagar Alam No.3, Lampung</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2 text-danger"></i> marketplacekatering.co.id</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2 text-danger"></i> +62 811 2556 0890</li>
                    </ul>
                    <div class="mt-4">
                        <a href="#" class="text-white me-3 h5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3 h5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white me-3 h5"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-5 border-secondary">
            <div class="text-center text-white-50">
                <p class="mb-0">&copy; {{ date('Y') }} Marketplace Katering. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
