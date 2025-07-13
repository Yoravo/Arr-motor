<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/welcome/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
    </style>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <script>
        var defaultThemeMode = "dark";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                themeMode = localStorage.getItem("data-theme") !== null ? localStorage.getItem("data-theme") : defaultThemeMode;
            }
            themeMode = themeMode === "system" ? window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light" : themeMode;
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>

    <div class="d-flex flex-column flex-root">
        <style>
            body { background-image: url("{{ asset('assets/welcome/img/bg5-dark.jpg') }}") }
        </style>

        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-center flex-column">
                    <a href="{{ route('welcome') }}">
                        <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px" src="{{ asset('assets/1/arr-motor1.png') }}" alt="" />
                    </a>
                </div>
            </div>

            <div class="d-flex flex-center w-lg-50 p-10">
                <div class="card rounded-3 w-md-550px bg-transparent">
                    <div class="card-body p-10 p-lg-20">
                        <form method="POST" action="{{ route('register') }}" class="form w-100">
                            @csrf
                            
                            <h1 class=" text-center text-dark fw-bolder mb-5">Sign Up</h1>
                            
                            <!-- Name Input -->
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Nama" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus class="form-control bg-transparent @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="fv-row mb-8">
                                <input type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control bg-transparent @error('email') is-invalid @enderror" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <div class="position-relative mb-3">
                                    <input type="password" placeholder="Password" name="password" required autocomplete="new-password" class="form-control bg-transparent @error('password') is-invalid @enderror" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="fv-row mb-8">
                                <input type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password" class="form-control bg-transparent" />
                            </div>

                            <!-- Register Button -->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                    <span class="indicator-label">Sign up</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>

                            <!-- Link to Login -->
                            <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                                <a href="{{ route('login') }}" class="link-primary fw-semibold">Sign in</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>var hostUrl = "assets/";</script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-up/general.js') }}"></script>
</body>
</html>