<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login ARR MOTOR</title>
    <meta charset="utf-8" />
    <meta name="description" content="showroom mobil, tempat dimana anda menemukan mobil impian anda" />
    <meta name="keywords" content="showroom mobil, arr motor" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="showroom mobil, arr motor" />
    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/arr-motor1.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-image: url('assets/1/bg1-dark.jpg');
        }

        /* Responsive adjustment for mobile */
        @media (max-width: 768px) {
            .logo-wrapper {
                margin-top: 100px;
            }

            .form-wrapper {
                margin-top: -30px;
            }
        }
    </style>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100 logo-wrapper">
                    <a href="{{ route('welcome') }}">
                        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                            src="{{ asset('assets/admin/media/logos/arr-motor1.png') }}" alt="Logo ARR MOTOR" />
                    </a>
                </div>
            </div>
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="d-flex flex-center rounded-4 w-md-600px p-10 form-wrapper">
                    <div class="w-md-400px">
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                            action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-light fw-bolder mb-3">Sign In</h1>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="fv-row mb-8">
                                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}"
                                    autocomplete="off" class="form-control bg-transparent text-light" required />
                            </div>
                            <div class="fv-row position-relative mb-8">
                                <input type="password" placeholder="Password" name="password" autocomplete="off"
                                    class="form-control bg-transparent text-light" id="password" required />
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                    onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-5 mt-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="form-check">
                                    <label for="form-check" class="form-check-label">
                                        Remember Me
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" class="link-primary">Forgot Password?</a>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>

                            {{-- FITUR REGISTER DI NONAKTIFKAN --}}
                            {{-- <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                                <a href="{{ route('register') }}" class="link-primary">Sign up</a>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
