<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('judul', 'ARR MOTOR')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/1/arrmotor.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/welcome/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/welcome/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/welcome/css/bootstrap.min.css') }}" rel="stylesheet">
    

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/welcome/css/style.css') }}" rel="stylesheet">
    <style>
        /* Fade transition */
        #modalImage {
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
        }

        #modalImage.loaded {
            opacity: 1;
        }

        /* Active thumbnail styling */
        .img-thumbnail.active-thumb {
            border: 2px solid #198754 !important;
            box-shadow: 0 0 5px rgba(25, 135, 84, 0.6);
        }

        /* Modal background override */
        #imageModal .modal-content {
            background-color: #111 !important;
            border: none;
        }

        #imageModal .modal-body {
            padding: 0 !important;
        }

        @media (max-width: 576px) {
            .navbar-brand img {
                width: 70px !important;
                height: auto;
            }

            .navbar-brand h1 {
                font-size: 1.25rem;
                /* lebih kecil */
            }
        }
    </style>

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
                <a href="{{ route('welcome') }}" class="navbar-brand d-flex align-items-center mb-0">
                    <img class="img-fluid me-2" src="{{ asset('assets/1/arrmotor2.png') }}" alt="Icon"
                        style="width: 90px; height: 50px;">
                    <span class="fw-bold fs-4 m-0">ARR MOTOR</span>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{ route('welcome') }}"
                            class="nav-item nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('about') }}"
                            class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
                        <a href="{{ route('contact') }}"
                            class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                    </div>
                    @if (Route::has('login'))
                        @auth
                            <div class="dropdown ms-lg-3 mt-2 mt-lg-0">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    @if (Auth::user()->role === 'admin')
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                        </li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                    @endif
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="dropdown-item" type="submit">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary ms-lg-3 mt-2 mt-lg-0">Masuk</a>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        @yield('content')


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container mt-1 mb-5">
                <div class="row justify-content-evenly text-center text-lg-start">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+628999546541</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>salfriandry@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="{{ route('about') }}">About Us</a>
                        <a class="btn btn-link text-white-50" href="{{ route('contact') }}">Contact Us</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">ARR MOTOR</a>, All Right Reserved.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

    </div>

    @yield('scripts')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/welcome/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/welcome/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/welcome/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/welcome/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/welcome/js/main.js') }}"></script>


</body>

</html>
