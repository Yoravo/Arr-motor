@extends('layouts.master')

@section('judul', 'Tentang Kami')
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Tentang Kami</h1>
                <p>Selamat datang di website <strong>Showroom Arr Motor!</strong> Kami adalah tim yang berdedikasi untuk memberikan informasi dan layanan terbaik kepada Anda. Dengan pengalaman dan keahlian kami, kami siap membantu Anda dalam berbagai kebutuhan.</p>
                <p>Visi kami adalah menjadi sumber informasi terpercaya dan solusi inovatif bagi masyarakat. Kami percaya bahwa dengan kerja keras, integritas, dan komitmen terhadap kualitas, kami dapat mencapai tujuan tersebut.</p>
                <p>Terima kasih telah mengunjungi website kami. Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut. Kami siap membantu Anda!</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <h2 class="text-center">Tim Kami</h2>
                    <p>Kami terdiri dari tim profesional yang berpengalaman di bidangnya masing-masing. Setiap anggota tim kami memiliki keahlian khusus yang memungkinkan kami untuk memberikan layanan terbaik kepada Anda.</p>
                </div>
                <div class="col-md-6 wow fadeInRight" data-wow-delay="0.3s">
                    <h2 class="text-center">Komitmen Kami</h2>
                    <p>Kami berkomitmen untuk selalu memberikan layanan yang berkualitas tinggi dan memenuhi kebutuhan Anda. Kepuasan pelanggan adalah prioritas utama kami, dan kami akan terus berusaha untuk meningkatkan layanan kami.</p>
                </div>
                <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.5s">
                    <h2 class="text-center">Hubungi Kami</h2>
                    <p>Jika Anda memiliki pertanyaan atau ingin mengetahui lebih lanjut tentang layanan kami, jangan ragu untuk menghubungi kami melalui email atau telepon. Kami siap membantu Anda kapan saja.</p>
                </div>
                <div class="col-md-6 wow fadeInRight" data-wow-delay="0.7s">
                    <h2 class="text-center">Lokasi Kami</h2>
                    <p>Kami berlokasi di <strong>Samping Pom Bensin Bakan Maja</strong>, Jl. Jendral Sudirman, Jomin Barat., Kec. Kota Baru, Karawang, Jawa Barat 41374. Anda dapat mengunjungi kami di kantor kami untuk mendapatkan layanan serta transaksi secara langsung.</p>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('contact') }}" class="btn btn-primary">Hubungi Kami</a>
            </div>
        </div>
    </div>
@endsection
