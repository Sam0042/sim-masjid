@extends('admin.layouts.app')

@section('konten')
    <div class="container-fluid px-4">

        <h1 class="mt-4">
            Data Profil Masjid
        </h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="dashboard">Dashboard</a>
            </li>

            <li class="breadcrumb-item active">
                Profil Masjid
            </li>
        </ol>

        @auth

            @foreach ($data as $d)
                <form action="{{ route('ketua-profil.update', $d->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- ================= SEJARAH ================= --}}
                    <div class="card border mb-4">

                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                🕌 Sejarah Masjid
                            </h5>
                        </div>

                        <div class="card-body">

                            <label class="fw-bold mb-2">
                                Deskripsi Sejarah
                            </label>

                            <textarea name="sejarah" class="form-control mb-4" rows="10" placeholder="Masukkan sejarah masjid...">{{ $d->sejarah }}</textarea>


                            <label class="fw-bold mb-2">
                                Foto Sejarah Saat Ini
                            </label>

                            <div class="mb-4">

                                @if (!empty($d->foto_sejarah))
                                    <img src="{{ url('admin/assets/img/sejarah') }}/{{ $d->foto_sejarah }}" alt="project-image"
                                        class=" mt-1" style="width: 250px;height:150px">
                                @endif

                            </div>


                            <div>

                                <label class="fw-bold mb-2">
                                    Upload Foto Baru
                                </label>

                                <input type="file" name="foto_sejarah" class="form-control">

                            </div>

                        </div>

                    </div>


                    {{-- ================= VISI ================= --}}
                    <div class="card border mb-4">

                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                🌿 Visi Masjid
                            </h5>
                        </div>

                        <div class="card-body">

                            <textarea name="visi" class="form-control" rows="2" placeholder="Masukkan visi masjid...">{{ $d->visi }}</textarea>

                        </div>

                    </div>


                    {{-- ================= MISI ================= --}}
                    <div class="card border mb-4">

                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                🎯 Misi Masjid
                            </h5>
                        </div>

                        <div class="card-body">

                            <textarea name="misi" class="form-control" rows="2" placeholder="Masukkan misi masjid...">{{ $d->misi }}</textarea>

                        </div>

                    </div>


                    {{-- ================= STRUKTUR ================= --}}
                    <div class="card border mb-4">

                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                👥 Struktur Organisasi
                            </h5>
                        </div>

                        <div class="card-body">

                            <label class="fw-bold mb-2">
                                Foto Struktur Saat Ini
                            </label>

                            <div class="mb-4">

                                @if (!empty($d->foto_struktur))
                                    <img src="{{ url('admin/assets/img/struktur') }}/{{ $d->foto_struktur }}"
                                        alt="project-image" class=" mt-1" style="width: 250px;height:150px">
                                @endif

                            </div>

                            <div>

                                <label class="fw-bold mb-2">
                                    Upload Foto Baru
                                </label>

                                <input type="file" name="foto_struktur" class="form-control">

                            </div>

                        </div>

                    </div>


                    {{-- ================= KONTAK ================= --}}
                    <div class="card border mb-4">

                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                📍 Informasi Kontak
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Alamat
                                </label>

                                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat masjid...">{{ $d->alamat }}</textarea>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Telepon
                                </label>

                                <input type="number" name="telepon" class="form-control" value="{{ $d->telepon }}"
                                    placeholder="Masukkan nomor telepon">

                            </div>


                        </div>

                    </div>


                    {{-- ================= SOSMED ================= --}}
                    <div class="card border mb-4">

                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                🌐 Sosial Media
                            </h5>
                        </div>

                        <div class="card-body">



                            <div class="mb-3">

                                <label class="form-label fw-bold">
                                    Instagram
                                </label>

                                <input type="text" name="instagram" class="form-control" value="{{ $d->instagram }}"
                                    placeholder="Masukkan link Instagram">

                            </div>



                        </div>

                    </div>


                    {{-- ================= BUTTON ================= --}}
                    <div class="text-end">

                        <button type="submit" class="btn btn-success px-4">

                            <i class="fa-solid fa-floppy-disk me-1"></i>

                            SIMPAN DATA

                        </button>

                    </div>

                </form>
            @endforeach
        @endauth

    </div>
@endsection
