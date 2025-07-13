@extends('admin.template.master')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">

            <h3 class="mb-4">Edit Data Mobil</h3>

            <!--begin::Errors-->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!--end::Errors-->

            <form action="{{ route('cars.update', $car->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Merk --}}
                    <div class="mb-3 col-md-6">
                        <label for="merek" class="form-label">Merk Mobil</label>
                        <input type="text" name="merek" class="form-control" id="merek"
                            value="{{ old('merek', $car->merek) }}" required>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" id="status">
                            <option value="tersedia" {{ old('status', $car->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="terjual" {{ old('status', $car->status) == 'terjual' ? 'selected' : '' }}>Terjual</option>
                        </select>
                    </div>

                    {{-- Nama Mobil --}}
                    <div class="mb-3 col-md-6">
                        <label for="nama" class="form-label">Nama Mobil</label>
                        <input type="text" name="nama" class="form-control" id="nama"
                            value="{{ old('nama', $car->nama) }}" required>
                    </div>

                    {{-- Transmisi --}}
                    <div class="mb-3 col-md-6">
                        <label for="transmisi" class="form-label">Transmisi</label>
                        <select name="transmisi" class="form-select" id="transmisi">
                            <option value="manual" {{ old('transmisi', $car->transmisi) == 'manual' ? 'selected' : '' }}>Manual</option>
                            <option value="matic" {{ old('transmisi', $car->transmisi) == 'matic' ? 'selected' : '' }}>Matic</option>
                        </select>
                    </div>

                    {{-- Bahan Bakar --}}
                    <div class="mb-3 col-md-6">
                        <label for="bahan_bakar" class="form-label">Bahan Bakar</label>
                        <select name="bahan_bakar" class="form-select" id="bahan_bakar">
                            <option value="bensin" {{ old('bahan_bakar', $car->bahan_bakar) == 'bensin' ? 'selected' : '' }}>Bensin</option>
                            <option value="solar" {{ old('bahan_bakar', $car->bahan_bakar) == 'solar' ? 'selected' : '' }}>Solar</option>
                            <option value="listrik" {{ old('bahan_bakar', $car->bahan_bakar) == 'listrik' ? 'selected' : '' }}>Listrik</option>
                        </select>
                    </div>

                    {{-- Tahun --}}
                    <div class="mb-3 col-md-6">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" id="tahun"
                            min="2000" max="{{ date('Y') }}"
                            value="{{ old('tahun', $car->tahun) }}" required>
                    </div>

                    {{-- Harga --}}
                    <div class="mb-3 col-md-6">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" id="harga"
                            min="0" value="{{ old('harga', $car->harga) }}" required>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3">{{ old('deskripsi', $car->deskripsi) }}</textarea>
                </div>

                {{-- Gambar per angle --}}
                @php
                    $angles = ['gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'opsional1', 'opsional2', 'opsional3', 'opsional4', 'opsional5'];
                @endphp

                <div class="mb-3">
                    <label class="form-label">Gambar Mobil (Per Sudut)</label>
                    <div class="row gy-3">
                        @foreach ($angles as $angle)
                            @php
                                $carImage = $car->images->firstWhere('angle', $angle);
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label fw-bold text-capitalize">{{ $angle }}</label>
                                @if ($carImage)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $carImage->image_path) }}" alt="{{ $angle }}" loading="lazy" class="img-thumbnail" style="width: 150px; height: 100px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="mb-2 text-muted fst-italic">Belum ada gambar untuk sudut ini.</div>
                                @endif
                                <input type="file" name="{{ $angle }}" class="form-control" accept="image/*">
                                <div class="form-text">Kosongkan jika tidak ingin mengubah gambar ini.</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Mobil</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
