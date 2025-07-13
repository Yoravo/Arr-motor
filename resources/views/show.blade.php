@extends('layouts.master')

@section('title', $car->merek . ' ' . $car->nama)

@section('content')
    <style>
        .custom-thumb {
            padding: 0;
            border: none;
            background: transparent;
            box-shadow: none;
            border-radius: 4px;
        }

        .btn-close-custom {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
        }

        .custom-thumb.active-thumb {
            border: 2px solid #3ac785;
            border-radius: 4px;
        }

        #previewImage,
        #modalImage {
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
        }

        #previewImage.loaded,
        #modalImage.loaded {
            opacity: 1;
        }

        #imageModal .modal-content {
            background-color: #ffffff;
            border: none;
            position: relative;
        }

        #imageModal .modal-dialog {
            max-width: 1000px;
            margin: 1rem auto;
        }

        #modalImage {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
        }

        .image-counter {
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            z-index: 1056;
            color: white;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 0.25rem 0.6rem;
            border-radius: 1rem;
            font-size: 0.8rem;
        }

        @media (max-width: 767.98px) {
            .main-preview-container {
                max-height: 70vh;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                overflow: hidden;
                padding: 1rem 0;
            }

            #modalImageMobile {
                max-width: 90%;
                max-height: 100%;
                object-fit: contain;
            }

            .modal-header-mobile {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1055;
                color: white;
                background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), transparent);
                padding: 1rem;
            }

            .modal-footer-mobile {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1055;
                display: flex;
                overflow-x: auto;
                padding: 1rem;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
            }

            .modal-footer-mobile img {
                height: 50px;
                width: 50px;
                object-fit: cover;
                margin-right: 8px;
                flex-shrink: 0;
            }
        }
    </style>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-3">{{ $car->merek }} {{ $car->nama }} ({{ $car->tahun }})</h3>

                @if ($car->images->count())
                    <img id="previewImage" src="{{ asset('storage/' . $car->images->first()->image_path) }}"
                        class="img-fluid rounded mb-3 loaded" style="cursor: pointer;" onclick="openImageModal(currentIndex)">


                    <div class="d-flex gap-2 overflow-auto py-2">
                        @foreach ($car->images as $key => $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" id="preview-thumb-{{ $key }}"
                                loading="lazy"
                                class="rounded border preview-thumb {{ $key === 0 ? 'active-thumb' : '' }}"
                                style="height: 70px; cursor: pointer;" onclick="changePreviewImage({{ $key }})">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-md-6">
                <h4 class="text-primary">Detail Mobil</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>Merek:</strong> {{ $car->merek }}</li>
                    <li class="list-group-item"><strong>Nama:</strong> {{ $car->nama }}</li>
                    <li class="list-group-item"><strong>Transmisi:</strong> {{ ucfirst($car->transmisi) }}</li>
                    <li class="list-group-item"><strong>Bahan Bakar:</strong> {{ ucfirst($car->bahan_bakar) }}</li>
                    <li class="list-group-item"><strong>Tahun:</strong> {{ $car->tahun }}</li>
                    <li class="list-group-item"><strong>Harga:</strong> Rp{{ number_format($car->harga, 0, ',', '.') }}
                    </li>
                    <li class="list-group-item">
                        <strong>Status:</strong>
                        <span class="badge {{ $car->status === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($car->status) }}
                        </span>
                    </li>
                </ul>

                @if ($car->deskripsi)
                    <h5 class="text-secondary">Deskripsi</h5>
                    <p>{{ $car->deskripsi }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <button type="button"
                    class="btn-close btn-close-white position-absolute top-0 end-0 mt-3 me-3 z-3 d-none d-md-block"
                    data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="modal-body d-none d-md-block">
                    <div class="row bg-white g-0">
                        <!-- Kiri: Gambar utama -->
                        <div class="col-md-9 position-relative d-flex justify-content-center align-items-center">

                            <!-- Tombol Kiri -->
                            <button id="btnPrevDesktop"
                                class="btn btn-light rounded-circle position-absolute top-50 start-0 translate-middle-y z-2 ms-2 d-none"
                                onclick="prevImage()">&lt;</button>

                            <!-- Gambar -->
                            <div id="panzoom" class="w-100 text-center">
                                <img id="modalImage" src="" class="img-fluid">
                            </div>

                            <!-- Tombol Kanan -->
                            <button id="btnNextDesktop"
                                class="btn btn-light rounded-circle position-absolute top-50 end-0 translate-middle-y z-2 me-2 d-none"
                                onclick="nextImage()">&gt;</button>
                        </div>

                        <!-- Kanan: Judul + Thumbnail -->
                        <div class="col-md-3 bg-white ps-3 pe-3 d-flex flex-column justify-content-between align-items-center py-4"
                            style="height: 100%;">
                            <!-- Judul -->
                            <div class="w-100">
                                <p class="fw-bold text-dark text-center mb-3">Gambar Mobil</p>
                            </div>

                            <!-- Thumbnail list -->
                            <div class="w-100 d-flex flex-wrap justify-content-between gap-2">
                                <!-- Tombol Close (Desktop) -->
                                <button type="button"
                                    class="position-absolute top-0 end-0 mt-3 me-3 z-3 border-0 bg-transparent text-dark fs-3"
                                    data-bs-dismiss="modal" aria-label="Close">&times;</button>

                                @foreach ($car->images as $key => $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        id="thumb-desktop-{{ $key }}"
                                        class="custom-thumb {{ $key === 0 ? 'active-thumb' : '' }}" width="61"
                                        height="61" style="aspect-ratio: 1 / 1; object-fit: cover;"
                                        onclick="openImageModal({{ $key }})">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile -->
                <div class="modal-header-mobile d-md-none">
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>
                <div class="modal-body d-flex d-md-none p-0 position-relative">
                    <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y z-1 ms-2"
                        onclick="prevImage()">&lt;</button>

                    <div class="main-preview-container">
                        <div id="panzoom">
                            <img id="modalImageMobile" src="">
                        </div>
                    </div>

                    <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y z-1 me-2"
                        onclick="nextImage()">&gt;</button>
                </div>

                <div id="imageCounter" class="image-counter d-md-none"></div>

                <div class="modal-footer-mobile d-md-none">
                    @foreach ($car->images as $key => $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" id="thumb-mobile-{{ $key }}"
                            loading="lazy"
                            class="img-thumbnail" onclick="openImageModal({{ $key }})">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://unpkg.com/@panzoom/panzoom@9.4.0/dist/panzoom.min.js"></script>
    <script>
        const imagePaths = @json($car->images->pluck('image_path'));
        let currentIndex = 0,
            panzoomInstance, isZoomed = false;
        const panzoomEl = document.getElementById('panzoom');
        const imageCounter = document.getElementById('imageCounter');
        const modalEl = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalImageMobile = document.getElementById('modalImageMobile');

        function getActiveModalImage() {
            return window.innerWidth < 768 ? modalImageMobile : modalImage;
        }

        function changePreviewImage(index) {
            currentIndex = index;
            const preview = document.getElementById('previewImage');
            preview.classList.remove('loaded');
            preview.src = `/storage/${imagePaths[index]}`;
            preview.onload = () => preview.classList.add('loaded');

            document.querySelectorAll('.preview-thumb').forEach((el, i) => {
                el.classList.toggle('active-thumb', i === index);
            });
        }

        function openImageModal(index) {
            currentIndex = index;
            updateModalImage();
            let modal = bootstrap.Modal.getInstance(modalEl);
            if (!modal) modal = new bootstrap.Modal(modalEl);
            modal.show();
        }

        function updateModalImage() {
            const modalImage = getActiveModalImage();
            modalImage.classList.remove('loaded');
            modalImage.src = `/storage/${imagePaths[currentIndex]}`;
            modalImage.onload = () => {
                modalImage.classList.add('loaded');
                if (panzoomInstance) panzoomInstance.destroy();
                panzoomInstance = Panzoom(panzoomEl, {
                    maxScale: 4,
                    contain: 'outside'
                });
                panzoomEl.parentElement.addEventListener('wheel', panzoomInstance.zoomWithWheel);
                isZoomed = false;
            };

            // Update tombol prev/next desktop
            const btnPrev = document.getElementById('btnPrevDesktop');
            const btnNext = document.getElementById('btnNextDesktop');

            if (btnPrev && btnNext) {
                btnPrev.classList.toggle('d-none', currentIndex === 0);
                btnNext.classList.toggle('d-none', currentIndex === imagePaths.length - 1);
            }

            if (imageCounter)
                imageCounter.textContent = `${currentIndex + 1} / ${imagePaths.length}`;

            document.querySelectorAll('[id^="thumb-desktop-"], [id^="thumb-mobile-"]').forEach((el) => {
                const key = parseInt(el.id.split('-').pop());
                el.classList.toggle('active-thumb', key === currentIndex);
            });
        }


        function nextImage() {
            if (isZoomed) return;
            currentIndex = (currentIndex + 1) % imagePaths.length;
            updateModalImage();
        }

        function prevImage() {
            if (isZoomed) return;
            currentIndex = (currentIndex - 1 + imagePaths.length) % imagePaths.length;
            updateModalImage();
        }

        modalEl.addEventListener('shown.bs.modal', () => {
            const thumb = document.querySelector('#thumb-mobile-' + currentIndex);
            if (thumb) thumb.scrollIntoView({
                behavior: 'smooth',
                inline: 'center'
            });
            document.querySelector('.container-xxl').style.overflow = 'hidden';
        });

        modalEl.addEventListener('hidden.bs.modal', () => {
            document.querySelector('.container-xxl').style.overflow = '';
        });
    </script>
@endsection
