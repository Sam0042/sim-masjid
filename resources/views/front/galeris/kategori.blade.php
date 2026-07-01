@extends('admin.layouts.app')
@section('konten')
    <section
        style="background-image: url('/admin/image/3.jpeg'); 
           background-size: cover; 
           background-position: 50% 30%; 
           height: 200px; 
           width: 100%; 
           position: relative;
           ">

        <!-- overlay hitam transparan -->
        <div
            style="position: absolute; top:0; left:0; width:100%; height:100%; 
                background-color: rgba(0,0,0,0.8);">
        </div>

        <!-- konten teks -->
        <div class="d-flex flex-column justify-content-center align-items-center h-100"
            style="position: relative; z-index: 1;">
            <h1 class="judul-header">
                GALERI
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="/" class="text-white fw-semibold text-decoration-none">Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('front-galeri.index') }}"
                        class="text-white fw-semibold text-decoration-none">Kategori</a>
                </li>
                <li class="breadcrumb-item active fw-semibold" id="target-bcm">{{ $kategoris->nama }}</li>
            </ol>

        </div>
    </section>


    <style>
        .card-super-date {
            color: goldenrod;
            font-weight: 600;
            font-size: 1rem;
        }

        .card-date {
            color: goldenrod;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .card-title {
            font-weight: 700;
            margin-top: 0.5rem;
            color: white;
        }

        .section-title {
            border-left: 5px solid #198754;
            padding-left: 10px;
            margin-bottom: 10px;
        }

        .section-title h2 {
            font-weight: 700;
            margin-bottom: 0;
            color: #111;
        }

        .section-title p {
            margin-bottom: 0;
            color: #6c757d;
        }

        .lihat-lengkap {
            color: black;
            transition: color 0.3s ease;
        }

        .lihat-lengkap:hover {
            color: #198754
        }

        .card-label {
            background: rgba(32, 201, 151, 0.9);
            /* teal */
            color: #022c22;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .card-agenda,
        .card-galeri {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            height: 100%;
        }

        .card-agenda img,
        .card-galeri img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* GRADIENT HIJAU (MAKIN KE BAWAH MAKIN PEKAT) */
        .card-agenda::after,
        .card-galeri::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.08) 0%,
                    rgba(1, 80, 43, 0.35) 35%,
                    rgba(0, 32, 17, 0.75) 70%,
                    rgba(0, 0, 0, 0.95) 100%);
        }

        .card-text-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 15px;
            z-index: 2;
            color: white;
            width: 100%;
        }

        .card-agenda:hover,
        .card-galeri:hover {
            transform: scale(1.02);
            transition: 0.3s;
        }

        /* ===== JADWAL ===== */
        .jadwal-container {
            background: linear-gradient(135deg, #198754, #20c997, #157347);
            color: white;
            border-radius: 15px;
            padding: 25px;
        }

        .jadwal-box {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }

        #jam-sekarang {
            font-size: 30px;
            font-weight: bold;
        }

        .pagination .page-link {
            color: #198754;
        }

        .pagination .page-link:hover {
            background-color: #198754;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #198754;
            border-color: #198754;
            color: white
        }
    </style>

    <div class="container py-4" id="konten">

        {{-- ================= SEMUA AGENDA ================= --}}
        <div class="d-flex justify-content-between align-items-center mb-2">

            <div class="section-title">
                <h2>Folder {{ $kategoris->nama }}</h2>
            </div>

        </div>

        {{-- CARD --}}
        <div class="row g-3">
            @if ($data->isEmpty())
                <p style="text-align: center;color:grey">Belum Ada Folder yang Tersedia</p>
            @else
                @foreach ($data as $p)
                    <div class="col-12 col-md-3">

                        <a href="{{ route('front-galeri.folder', $p->id) }}" class="text-decoration-none">

                            <div class="card-galeri" style="height:180px;">

                                <img src="{{ url('admin/assets/img/galeri/folder') }}/{{ $p->thumbnail }}">

                                <div class="card-text-overlay">

                                    <small class="card-date" id="jml-foto">
                                        {{ $p->jumlah_foto }}
                                    </small>

                                    <h6 class="card-title">
                                        {{ \Illuminate\Support\Str::words($p->nama, 5, '...') }}
                                    </h6>

                                </div>

                            </div>

                        </a>

                    </div>
                @endforeach
            @endif

        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $data->links() }}
        </div>

    </div>
@endsection
