<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Roudhotul Jannah Web</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/styles.css" rel="stylesheet" />


    <style>
        .notif-hapus {
            margin-top: 3.4rem;
        }

        .sb-topnav {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
        }

        body {
            padding-top: 55px;
        }

        .hover-effect {
            color: #ff5667;
            transition: 0.3s;
        }

        .hover-effect:hover,
        .hover-effect:hover i {
            color: white;
        }

        .welcome {
            margin-right: 5px;
        }

        .btn-dkm {
            display: inline-block;
            font-family: 'Inter', sans-serif;
            padding: 7px 22px;
            background: linear-gradient(135deg, #198754, #20c997);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
        }

        .btn-dkm:hover {
            background: linear-gradient(135deg, #157347, #198754);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(25, 135, 84, 0.45);
        }

        .offcanvas {
            background-color: #212529;
        }

        .offcanvas .nav-link {
            color: white;
            font-weight: 600;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .offcanvas .nav-link:hover {
            color: #20c997;
            padding-left: 5px;
        }

        .offcanvas .nav-link.active {
            color: #20c997 !important;
            /* Warna hijau menyala saat aktif */
            /* padding-left: 10px; */
        }

        .dropdown-menu {
            border: none;
            border-radius: 10px;
            margin-top: 10px;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #dc3545 !important;
        }



        /* MOBILE */
        @media (max-width: 991px) {

            .navbar-brand-mobile {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                padding-left: 0 !important;
                margin: 0 !important;
            }

            .navbar-brand-mobile img {
                height: 45px !important;
            }
        }

        /* DESKTOP */
        @media (min-width: 992px) {

            .navbar-brand-mobile {
                position: static;
                transform: none;
            }

            .notif-hapus {
                margin-top: 2.2rem;
            }
        }
    </style>

</head>

<body>

    @include('sweetalert::alert')

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark fixed-top position-relative">

        {{-- HAMBURGER MOBILE --}}
        @guest
            <button class="btn btn-link text-white d-lg-none ms-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu">

                <i class="fas fa-bars fs-5"></i>

            </button>
        @endguest


        {{-- HAMBURGER ADMIN --}}
        @auth
            <button class="btn btn-link btn-sm text-white ms-2 me-2" id="sidebarToggle">

                <i class="fas fa-bars"></i>

            </button>
        @endauth


        {{-- LOGO --}}
        <a class="navbar-brand navbar-brand-mobile fw-bold d-flex align-items-center" href="/"
            style="padding-left: 30px;">

            <img src="{{ asset('front/assets/img/logo-masjid.png') }}" alt="Logo Masjid"
                style="height: 50px; width: auto;">

        </a>


        {{-- MENU DESKTOP --}}
        @guest
            <ul class="navbar-nav me-auto ms-3 fw-bold d-none d-lg-flex">

                <li class="nav-item me-3">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">BERANDA</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link {{ Request::is('profil') ? 'active' : '' }}"
                        href="{{ route('profil.index') }}">PROFIL</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link {{ Request::is(['front-galeri*', 'galeri/kategori*', 'galeri/folder*']) ? 'active' : '' }}"
                        href="{{ route('front-galeri.index') }}">GALERI</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link {{ Request::is('front-agenda*') ? 'active' : '' }}"
                        href="{{ route('front-agenda.index') }}">AGENDA</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link {{ Request::is('front-keuangan') ? 'active' : '' }}"
                        href="{{ route('front-keuangan.index') }}">KEUANGAN</a>
                </li>

                <li class="nav-item me-3">
                    <a class="nav-link {{ Request::is('front-jumat') ? 'active' : '' }}"
                        href="{{ route('front-jumat.index') }}">JADWAL JUMAT</a>
                </li>

            </ul>
        @endguest


        {{-- MENU KANAN --}}
        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            @guest
                <li class="nav-item">
                    <a class="btn-dkm btn-sm" href="{{ route('login') }}" style="position: relative; z-index: 1050;">
                        <b>LOGIN DKM</b>
                    </a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i> {{ ucwords(Auth::user()->name) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item text-danger" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </ul>

    </nav>


    {{-- SIDEBAR MOBILE --}}
    @guest
        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-white">MENU</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav fw-bold">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">BERANDA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('profil*') ? 'active' : '' }}"
                            href="{{ route('profil.index') }}">PROFIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is(['front-galeri*', 'galeri/kategori*', 'galeri/folder*']) ? 'active' : '' }}"
                            href="{{ route('front-galeri.index') }}">GALERI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('front-agenda*') ? 'active' : '' }}"
                            href="{{ route('front-agenda.index') }}">AGENDA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('front-keuangan*') ? 'active' : '' }}"
                            href="{{ route('front-keuangan.index') }}">KEUANGAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('front-jumat*') ? 'active' : '' }}"
                            href="{{ route('front-jumat.index') }}">JADWAL JUMAT</a>
                    </li>
                </ul>
            </div>
        </div>
    @endguest


    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        console.log(bootstrap);
    </script>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
