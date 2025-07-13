<!DOCTYPE html>
<html lang="en">

<head>
    <base href="" />
    <title>@yield('page-title', 'ARR MOTOR')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/admin/media/logos/arr-motor1.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .dropdown-menu {
            z-index: 9999 !important;
        }

        .image-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            padding: 1rem;
            overflow: auto;
        }

        .image-modal.show {
            display: flex;
        }

        .image-modal-content {
            max-width: 90%;
            max-height: 90%;
            transition: transform 0.25s ease;
            object-fit: contain;
            cursor: zoom-in;
        }

        .image-modal-content.zoomed {
            transform: scale(2.5);
            cursor: zoom-out;
        }

        .image-modal-close {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
            z-index: 10000;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/admin/css/image-modal.css') }}">
</head>

<body id="kt_body" class="d-flex flex-column min-vh-100">
    <script>
        const defaultThemeMode = "light";
        let themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                themeMode = localStorage.getItem("data-theme") || defaultThemeMode;
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>

    {{-- START WRAPPER --}}
    <div class="d-flex flex-column flex-grow-1">
        {{-- Sidebar dan Navbar tetap --}}
        <div class="page d-flex flex-row flex-column-fluid">
            @include('admin.template.sidebar')

            {{-- Wrapper isi halaman --}}
            <main class="wrapper d-flex flex-column flex-grow-1" id="kt_wrapper">
                @include('admin.template.navbar')

                <div class="content d-flex flex-column flex-grow-1" id="kt_content">
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">
                            @yield('content')
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <footer>
                    @include('admin.template.footer')
                </footer>
            </main>
        </div>
    </div>
    {{-- END WRAPPER --}}

    {{-- SCRIPTS --}}
    <script src="{{ asset('assets/admin/js/image-modal.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom/widgets.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ALERT VALIDASI --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Input Tidak Valid',
                html: `<ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>`
            });
        @endif
    </script>
</body>

</html>
