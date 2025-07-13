@extends('admin.template.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">

                <!--begin::Search & Toolbar-->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div class="flex-grow-1 me-2">
                        <input type="text" id="search-input" name="query" class="form-control form-control-sm"
                            placeholder="Cari mobil...">
                    </div>
                    <div class="mt-2 mt-md-0">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_car">
                            Tambah Mobil
                        </button>
                    </div>
                </div>
                <!--end::Search & Toolbar-->

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

                <!--begin::Responsive Table-->
                <div class="table-responsive-md">
                    <table class="table table-bordered table-striped border-primary table-sm align-middle fs-7 w-100">
                        <thead class="text-center text-uppercase bg-light fw-bold border border-gray-500">
                            <tr>
                                <!-- Kolom ini akan hilang di mobile (xs, sm) dan muncul di desktop (md+) -->
                                <th class="d-none d-md-table-cell">Gambar</th>
                                <!-- Kolom ini akan selalu terlihat -->
                                <th class="">Merek</th>
                                <!-- Kolom ini akan selalu terlihat -->
                                <th class="">Nama</th>
                                <!-- Kolom ini akan hilang di mobile (xs, sm) dan muncul di desktop (md+) -->
                                <th class="d-none d-md-table-cell">Transmisi</th>
                                <!-- Kolom ini akan selalu terlihat -->
                                <th class="">Tahun</th>
                                <!-- Kolom ini akan selalu terlihat -->
                                <th class="">Harga</th>
                                <!-- Kolom ini akan selalu terlihat -->
                                <th class="">Status</th>
                                <!-- Kolom ini akan selalu terlihat -->
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center border border-gray-500">
                            @foreach ($cars as $car)
                                <tr>
                                    <!-- Sel ini akan hilang di mobile (xs, sm) dan muncul di desktop (md+) -->
                                    <td class="d-none d-md-table-cell">
                                        @if ($car->images && $car->images->count() > 0)
                                            <img src="{{ asset('storage/' . $car->images[0]->image_path) }}" alt="Gambar"
                                                class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <span class="text-active">Kosong</span>
                                        @endif
                                    </td>
                                    <!-- Sel ini akan selalu terlihat -->
                                    <td class="">{{ $car->merek }}</td>
                                    <!-- Sel ini akan selalu terlihat -->
                                    <td>{{ $car->nama }}</td>
                                    <!-- Sel ini akan hilang di mobile (xs, sm) dan muncul di desktop (md+) -->
                                    <td class="d-none d-md-table-cell">{{ ucfirst($car->transmisi) }}</td>
                                    <!-- Sel ini akan selalu terlihat -->
                                    <td>{{ $car->tahun }}</td>
                                    <!-- Sel ini akan selalu terlihat -->
                                    <td class="">Rp {{ number_format($car->harga, 0, ',', '.') }}</td>
                                    <!-- Sel ini akan selalu terlihat -->
                                    <td>
                                        <span
                                            class="badge {{ $car->status == 'tersedia' ? 'bg-success' : 'bg-danger text-white' }}">
                                            {{ ucfirst($car->status) }}
                                        </span>
                                    </td>
                                    <!-- Sel ini akan selalu terlihat -->
                                    <td class="position-relative">
                                        {{-- Untuk layar kecil (mobile) tampilkan tombol langsung --}}
                                        <div class="d-grid d-md-none">
                                            <a href="{{ route('cars.edit', $car->slug) }}"
                                                class="btn btn-sm btn-warning mb-1">Edit</a>
                                            <form action="{{ route('cars.destroy', $car->slug) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus mobil ini?')">Hapus</button>
                                            </form>
                                        </div>

                                        {{-- Untuk layar besar (desktop) tampilkan dropdown --}}
                                        <div class="dropdown d-none d-md-block">
                                            <button class="btn btn-sm btn-light dropdown-toggle text-light" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('cars.edit', $car->slug) }}">Edit</a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('cars.destroy', $car->slug) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Yakin ingin menghapus mobil ini?')">Hapus</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!--begin::Pagination-->
                    <div class="d-flex justify-content-end mt-4">
                        {{ $cars->links() }}
                    </div>
                    <!--end::Pagination-->
                </div>
                <!--end::Responsive Table-->


                <!--begin::Modal - Add Car-->
                <div class="modal fade" id="kt_modal_add_car" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Mobil Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3" action="{{ route('cars.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    {{-- Merek --}}
                                    <div class="col-md-6">
                                        <label for="merek" class="form-label">Merek</label>
                                        <input type="text" class="form-control" name="merek" id="merek"
                                            value="{{ old('merek') }}" required>
                                        @error('merek')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Nama Mobil --}}
                                    <div class="col-md-6">
                                        <label for="nama" class="form-label">Nama Mobil</label>
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Transmisi --}}
                                    <div class="col-md-6">
                                        <label for="transmisi" class="form-label">Transmisi</label>
                                        <select class="form-select" name="transmisi" id="transmisi" required>
                                            <option value="">Pilih Tranmisi</option>
                                            <option value="manual">Manual</option>
                                            <option value="matic">Matic</option>
                                        </select>
                                        @error('transmisi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    {{-- Bahan Bakar --}}
                                    <div class="col-md-6">
                                        <label for="bahan_bakar" class="form-label">Bahan Bakar</label>
                                        <select class="form-select" name="bahan_bakar" id="bahan_bakar" required>
                                            <option value="">Pilih Bahan Bakar</option>
                                            <option value="bensin">Bensin</option>
                                            <option value="solar">solar</option>
                                            <option value="listrik">listrik</option>
                                        </select>
                                        @error('bahan_bakar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tahun --}}
                                    <div class="col-md-3">
                                        <label for="tahun" class="form-label">Tahun</label>
                                        <input type="number" name="tahun" class="form-control" id="tahun"
                                            min="2000" max="{{ date('Y') }}" value="{{ old('tahun') }}"
                                            required>
                                        @error('tahun')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Harga --}}
                                    <div class="col-md-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" name="harga" class="form-control" id="harga"
                                            min="0" value="{{ old('harga') }}" required>
                                        @error('harga')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-select" id="status">
                                            <option value="">Pilih Status</option>
                                            <option value="tersedia">Tersedia</option>
                                            <option value="terjual">Terjual</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- deskripsi --}}
                                    <div class="col-md-12">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Gambar Utama (Wajib) --}}
                                    <div class="mb-4">
                                        <label class="form-label">Upload 5 Gambar Wajib</label>
                                        <div class="row">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <div class="col-md-3 mb-3">
                                                    <input type="file" name="gambar{{ $i }}"
                                                        id="gambar{{ $i }}" class="form-control previewable">
                                                    <div class="preview-container mt-2 d-flex flex-wrap gap-2"
                                                        data-preview="gambar{{ $i }}"></div>
                                                    @error('gambar' . $i)
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endfor
                                        </div>

                                        {{-- Gambar Opsional --}}
                                        <div class="mb-4">
                                            <label class="form-label">Upload hingga 5 Gambar Opsional (Opsional)</label>
                                            <div class="row">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <div class="col-md-3 mb-3">
                                                        <input type="file" name="opsional{{ $i }}"
                                                            id="opsional{{ $i }}"
                                                            class="form-control previewable">
                                                        <div class="preview-container mt-2 d-flex flex-wrap gap-2"
                                                            data-preview="opsional{{ $i }}"></div>
                                                        @error('opsional' . $i)
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>

                                        {{-- image preview --}}
                                        {{-- <div id="image-preview-container" class="mt-2 d-flex flex-wrap gap-2"> --}}

                                        {{-- </div> --}}

                                        {{-- Modal Menampilkan Gambar --}}
                                        <div class="image-modal" id="myMimageModal">
                                            <span class="image-modal-close" id="closeModal"></span>
                                            <img class="image-modal-content" id="modalImageContent">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Modal - Add Car-->

            </div>
        </div>
    </div>

@endsection
