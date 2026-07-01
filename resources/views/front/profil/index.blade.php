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
                PROFIL
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="/" class="text-white fw-semibold text-decoration-none">Beranda</a>
                </li>
                <li class="breadcrumb-item active fw-semibold" id="target-bcm">Profil</li>
            </ol>

        </div>
    </section>


    <style>
        .paragraf {
            text-indent: 40px;
        }

        .profil-section {

            background: #f8f9fa;
        }

        .section-title {
            border-left: 5px solid #198754;
            padding-left: 10px;
            margin-bottom: 10px;
        }

        .section-title h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #111;
        }

        .section-title p {
            margin-bottom: 0;
            color: #6c757d;
        }

        .profil-img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }


        .profil-text {
            font-size: 18px;
            line-height: 1.9;
            color: #4d4d4d;
            text-align: justify;
        }

        .profil-divider {
            margin: 80px 0;
            border-color: rgba(0, 0, 0, 0.15);
        }

        .visi-box {
            max-width: 900px;
            margin: auto;
        }

        .map-box iframe {
            width: 100%;
            height: 450px;
            border: 0;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        @media (max-width: 768px) {

            .profil-section {
                padding: 40px 0;
            }

            .profil-img {
                height: 250px;
            }

            .profil-text {
                font-size: 16px;
            }

            .map-box iframe {
                height: 300px;
            }
        }
    </style>

    @foreach ($data as $d)
        <div class="profil-section py-4">

            <div class="container">

                {{-- SEJARAH MASJID --}}
                <div class="section-title">
                    <h2>Sejarah Masjid</h2>

                </div>

                <div class="row justify-content-center">

                    <div class="col-lg-9">

                        <img src="{{ url('admin/assets/img/sejarah') }}/{{ $d->foto_sejarah }}" class="profil-img mb-5">

                        <div class="profil-text">
                            <p class="paragraf">
                                {{ $d->sejarah }}
                            </p>



                        </div>

                    </div>

                </div>

                <hr class="my-5">


                {{-- VISI MISI --}}
                <div class="section-title">
                    <h2>Visi dan Misi Masjid</h2>
                    {{-- <p>Tujuan dan arah pengembangan masjid</p> --}}
                </div>

                <div class="row justify-content-center">

                    <div class="col-lg-8">

                        <div class="profil-text visi-box">

                            <p class="paragraf"><b>Visi:</b> {{ $d->visi }}</p>
                            <p class="paragraf"><b>Misi:</b> {{ $d->misi }}</p>

                        </div>

                    </div>

                </div>

                <hr class="my-5">

                {{-- KEPENGURUSAN --}}
                <div class="section-title">
                    <h2>Susunan Kepengurusan</h2>
                    {{-- <p>Deskripsi singkat sejarah masjid</p> --}}
                </div>

                <div class="row justify-content-center">

                    <div class="col-lg-9">

                        <img src="{{ url('admin/assets/img/struktur') }}/{{ $d->foto_struktur }}" class="profil-img mb-5">

                    </div>

                </div>

                <hr class="my-5">

                {{-- DENAH LOKASI --}}
                <div class="section-title">
                    <h2>Denah Lokasi Masjid</h2>
                    {{-- <p>Lokasi masjid pada Google Maps</p> --}}
                </div>

                <div class="row justify-content-center">

                    <div class="col-lg-9">

                        <div class="map-box">

                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.4323571319765!2d106.81079679999999!3d-6.4667852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c206a0ff76cf%3A0xa30c207f564313a1!2sMasjid%20Jami&#39;%20Roudhotul%20Jannah%20Taman%20Raya%20Citayam!5e0!3m2!1sid!2sid!4v1765933693600!5m2!1sid!2sid"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endforeach
@endsection
