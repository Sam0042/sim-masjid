@extends('admin.layouts.app')
@section('konten')
    <style>
        /* Menggunakan style yang konsisten dengan halaman sebelumnya */
        .card-galeri {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            height: 100%;
            transition: transform 0.3s;
        }

        .card-galeri img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

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

        .card-galeri:hover {
            transform: scale(1.02);
        }

        .card-tulisan-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 15px;
            z-index: 2;
            color: white;
            width: 100%;
        }

        .section-title {
            border-left: 5px solid #198754;
            padding-left: 10px;
            margin-bottom: 20px;
        }

        .card-date {
            color: goldenrod;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .deskripsi-text {
            font-size: 1rem;
            line-height: 1.9;
            color: #6c757d;
            text-align: justify;
            white-space: pre-line;
        }

        .btn-kembali {
            background: #198754;
            color: white;

            border-radius: 50px;

            padding: 10px 22px;

            font-weight: 600;

            border: none;

            transition: 0.3s;
        }

        .btn-kembali:hover {
            background: #157347;
            color: white;

            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .deskripsi-text {
                font-size: 0.9rem;

            }

            #agenda-lain {
                margin-top: 2rem;
            }


        }
    </style>

    {{-- HEADER SECTION --}}
    <section
        style="background-image: url('/admin/image/3.jpeg'); 
           background-size: cover; 
           background-position: 50% 30%; 
           height: 200px; 
           width: 100%; 
           position: relative;">

        <div style="position: absolute; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.8);"></div>

        <div class="d-flex flex-column justify-content-center align-items-center h-100"
            style="position: relative; z-index: 1;">
            <h1 class="text-white fw-bold">AGENDA</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/" class="text-white fw-semibold text-decoration-none">Beranda</a>
                </li>
                <li class="breadcrumb-item"><a href="/front-agenda"
                        class="text-white fw-semibold text-decoration-none">Agenda</a>
                </li>
                <li class="breadcrumb-item active fw-semibold" id="target-bcm">Detail</li>
            </ol>
        </div>
    </section>


    {{-- new --}}
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-2">
                <div class="border-start border-4 border-success ps-3 mb-4">
                    <p class="text-muted mb-1">Mulai</p>
                    <h6 class="mb-3">
                        {{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->translatedFormat('d F Y, H:i A') }}
                    </h6>
                    <p class="text-muted mb-1">Selesai</p>
                    <h6 class="mb-3">
                        {{ \Carbon\Carbon::parse($agenda->tanggal_selesai)->translatedFormat('d F Y, H:i A') }}
                    </h6>
                    <p class="text-muted mb-1">Lokasi</p>
                    <h6 class="mb-3">{{ $agenda->lokasi }}</h6>

                    <a href="{{ url()->previous() }}" class="btn btn-kembali mb-4">

                        <i class="fas fa-arrow-left me-2" id="panah-balik"></i>

                        <span class="tulisan-kembali">Kembali</span>

                    </a>

                </div>
            </div>

            <div class="col-lg-7">
                <img src="{{ empty($agenda->foto) ? 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg' : url('admin/assets/img/agenda/' . $agenda->foto) }}"
                    class="img-fluid rounded-4 shadow-sm mb-4">
                <h1 class="fw-bold mb-3">{{ $agenda->nama }}</h1>
                <p class="deskripsi-text">{{ $agenda->deskripsi }}</p>
            </div>

            <div class="col-lg-3" id="agenda-lain">
                <h5 class="fw-bold mb-3">Agenda Lainnya</h5>
                <div class="list-group">
                    @foreach ($related as $r)
                        @if ($loop->iteration > 4)
                            @break
                        @endif
                        <div class="mb-3">
                            <a href="{{ route('front-agenda.show', $r->id) }}" class="text-decoration-none">
                                <div class="card-galeri" style="height: 200px;">
                                    <img src="{{ empty($r->foto) ? 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg' : url('admin/assets/img/agenda/' . $r->foto) }}"
                                        alt="{{ $r->nama }}">
                                    <div class="card-tulisan-overlay">
                                        <small class="card-date">
                                            {{ \Carbon\Carbon::parse($r->tanggal_mulai)->translatedFormat('l, d F Y') }}
                                        </small>
                                        <h6 class="fw-bold text-white">
                                            {{ \Illuminate\Support\Str::words($r->nama, 5, '...') }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
