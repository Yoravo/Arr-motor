@extends('layouts.master')
@section('judul', 'ARR MOTOR')
@section('content')
    <style>
        @media (max-width: 576px) {

            .property-item h5,
            .property-item a,
            .property-item p,
            .property-item small {
                font-size: 0.75rem !important;
            }

            .property-item .p-4 {
                padding: 0.75rem !important;
            }

            .property-item .d-flex.border-top>small {
                padding: 0.5rem 0 !important;
            }

            .property-item .status-badge,
            .property-item .brand-badge {
                font-size: 0.65rem !important;
                padding: 2px 6px !important;
            }
        }
    </style>
    <!-- List Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4 gx-1">
                        @foreach ($cars as $car)
                            <div class="col-6 col-md-6 col-lg-4 px-1 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">

                                    <div class="position-relative overflow-hidden">
                                        @php
                                            $images = $car->images;
                                        @endphp

                                        @if ($images->count() > 1)
                                            <div id="carouselCar{{ $car->id }}" class="carousel slide"
                                                data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    {{-- Bagian Carousel / Gambar Mobil --}}
                                                    @foreach ($images as $key => $img)
                                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                            <img class="img-fluid w-100"
                                                                src="{{ asset('storage/' . $img->image_path) }}"
                                                                loading="lazy"
                                                                alt="Foto {{ $car->merek }} {{ $car->nama }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselCar{{ $car->id }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselCar{{ $car->id }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        @else
                                            {{-- Gambar Tunggal --}}
                                            <img class="img-fluid w-100"
                                                src="{{ $images->first()?->image_path
                                                    ? asset('storage/' . $images->first()->image_path)
                                                    : asset('assets/img/kosong.png') }}"
                                                loading="lazy"
                                                alt="{{ $images->isNotEmpty()
                                                    ? 'Foto ' . $car->merek . ' ' . $car->nama
                                                    : 'Gambar belum tersedia untuk ' . $car->merek . ' ' . $car->nama }}">
                                        @endif

                                        <div
                                            class="status-badge bg-{{ $car->status === 'tersedia' ? 'primary' : 'danger' }} rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            {{ ucfirst($car->status) }}
                                        </div>
                                        <div
                                            class="brand-badge bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                            {{ $car->merek }}
                                        </div>


                                    </div>

                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">Rp{{ number_format($car->harga, 0, ',', '.') }}</h5>
                                        <a class="d-block h5 mb-2"
                                            href="{{ route('cars.detail', $car->slug) }}">{{ ucfirst($car->merek) }}
                                            {{ ucfirst($car->nama) }}</a>
                                        <p><i class="fa fa-car text-primary me-2"></i>{{ ucfirst($car->transmisi) }} -
                                            {{ ucfirst($car->bahan_bakar) }}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-bottom py-2">
                                            <i class="fa fa-calendar-alt text-primary me-2"></i>{{ $car->tahun }}
                                        </small>
                                        <small class="flex-fill text-center border-bottom py-2">
                                            <i
                                                class="fa fa-eye text-primary me-2"></i>{{ $car->status === 'tersedia' ? 'Tersedia' : 'Terjual' }}
                                        </small>
                                        <small class="flex-fill text-center border-bottom py-2">
                                            <i class="fa fa-tag text-primary me-2"></i>{{ strtoupper($car->merek) }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- List End -->

        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0 mt-3 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn">Temukan <span class="text-primary">Mobil yang Terbaik</span>
                        Untuk Anda dan Keluarga</h1>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{ asset('assets/1/deal1.jpg') }}" loading="lazy" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{ asset('assets/1/deal2.jpg') }}" loading="lazy" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->


        <!-- Call to Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded p-3">
                    <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid rounded w-100" src="{{ asset('assets/1/call-us.png') }}"
                                    alt="" loading="lazy">
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="mb-4">
                                    <h1 class="mb-3">Hubungi Kami Untuk Lebih Lanjut</h1>
                                    <p>Kami siap membantu Anda menemukan mobil impian dengan harga dan kualitas terbaik.
                                        Jangan ragu untuk menghubungi kami untuk konsultasi, pertanyaan, atau penawaran
                                        spesial!
                                    </p>
                                </div>
                                <a href="https://wa.me/628999546541" class="btn btn-primary py-3 px-4 me-2 mb-2"
                                    target="_blank"><i class="fab fa-whatsapp fa-lg me-2"></i>WhatsApp</a>
                                <a href="mailto:salfriandry@gmail.com" class="btn btn-dark py-3 px-4 me-2 mb-2"><i
                                        class="fa fa-envelope fa-lg me-2"></i>Email</a>
                                <a href="https://instagram.com" class="btn btn-dark py-3 px-4 me-2 mb-2"><i
                                        class="fab fa-instagram fa-lg me-2"></i>Instagram</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->
    @endsection
