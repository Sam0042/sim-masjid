@extends('admin.layouts.app')
@section('konten')
    @guest


        <section
            style="background-image: url('/admin/image/2.jpeg'); 
           background-size: cover; 
           background-position: center; 
           height: 200px; 
           width: 100%; 
           position: relative;
           ">

            <!-- overlay -->
            <div
                style="position: absolute; top:0; left:0; width:100%; height:100%; 
                background-color: rgba(0,0,0,0.6);">
            </div>

            <!-- konten -->
            <div class="d-flex justify-content-center align-items-center h-100" style="position: relative; z-index: 1;">
                <h2 class="judul-header">
                    <span style="font-weight:700;color:goldenrod">Selamat Datang di Website</span><br>
                    Masjid Jami Roudhotul Jannah
                </h2>
            </div>
        </section>



        <style>
            .card-super-date {
                color: goldenrod;
                font-weight: 600;
                font-size: 1rem;
            }

            .card-date {
                /* color: #0dcaf0; WARNA PLAN B */
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

            .card-jumat {
                position: relative;
                overflow: hidden;
                border-radius: 12px;
                height: 100%;
            }


            .card-jumat img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            /* GRADIENT HIJAU (MAKIN KE BAWAH MAKIN PEKAT) */

            .card-jumat::after {
                content: "";
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, #198754, #20c997, #157347);

            }

            .card-jumat:hover {
                transform: scale(1.02);
                transition: 0.3s;
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

            .tanggal-jumat {
                text-align: center;
                font-size: 18px;
                font-weight: 700;
                line-height: 1.5;
                margin-top: 1px;
                margin-bottom: 0.5rem;
            }

            .petugas-wrapper {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .petugas-item {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }

            .petugas-label {
                font-size: 0.7rem;
                color: #d1fae5;
                font-weight: 600;
                margin-bottom: 1px;
            }

            .petugas-nama {
                font-size: 1rem;
                font-weight: 500;
                color: white;
            }
        </style>



        <div class="container py-4">

            {{-- ================= AGENDA ================= --}}
            <div class="d-flex justify-content-between align-items-center mb-2">

                <div class="section-title">
                    <h2>Agenda Terkini</h2>
                    {{-- <p>Deskripsi singkat sejarah masjid</p> --}}
                </div>

                {{-- DESKTOP --}}
                <a href="agenda" class="text-decoration-none fw-bold lihat-lengkap d-none d-md-block">
                    Lihat Selengkapnya →
                </a>
            </div>

            <div class="row g-3">
                {{-- MOBILE --}}
                <div class="ms-1 d-block d-md-none">
                    <a href="agenda" class="text-decoration-none fw-bold lihat-lengkap">
                        Lihat Selengkapnya →
                    </a>
                </div>

                {{-- CARD BESAR --}}
                <div class="col-md-6">
                    @php $first = $relatedAgenda->first(); @endphp

                    <a href="{{ route('agenda.show', $first->id) }}" class="text-decoration-none">
                        <div class="card-agenda" style="height:417px">

                            <img src="{{ url('admin/assets/img/agenda') }}/{{ $first->foto }}">

                            <div class="card-text-overlay">
                                <small class="card-super-date">
                                    {{ \Carbon\Carbon::parse($first->tanggal_mulai)->translatedFormat('l, d F Y') }}
                                </small>

                                <h2 class="card-title">{{ $first->nama }}</h2>
                                <small style="color: rgb(191, 190, 190)">
                                    {{ \Illuminate\Support\Str::words($first->deskripsi, 20, '...') }}
                                </small>

                            </div>

                        </div>
                    </a>
                </div>

                {{-- GRID KANAN --}}
                <div class="col-md-6">
                    <div class="row g-3">

                        @foreach ($relatedAgenda->skip(1)->take(4) as $p)
                            <div class="col-6">

                                <a href="{{ route('agenda.show', $p->id) }}" class="text-decoration-none">

                                    <div class="card-agenda" style="height:200px;">

                                        <img src="{{ url('admin/assets/img/agenda') }}/{{ $p->foto }}">

                                        <div class="card-text-overlay">
                                            <small class="card-date">
                                                {{ \Carbon\Carbon::parse($p->tanggal_mulai)->translatedFormat('l, d F Y') }}
                                            </small>
                                            <h6 class="card-title">
                                                {{ \Illuminate\Support\Str::words($p->nama, 6, '...') }}
                                            </h6>
                                        </div>

                                    </div>

                                </a>

                            </div>
                        @endforeach

                    </div>
                </div>

            </div>


            <hr class="my-5">


            {{-- ================= GALERI ================= --}}
            <div class="d-flex justify-content-between align-items-center mb-2">

                <div class="section-title">
                    <h2>Galeri</h2>
                </div>

                {{-- DESKTOP --}}
                <a href="front-galeri" class="text-decoration-none fw-bold lihat-lengkap d-none d-md-block">
                    Lihat Selengkapnya →
                </a>

            </div>

            <div class="row g-3">
                {{-- MOBILE --}}
                <div class="ms-1 d-block d-md-none">
                    <a href="front-galeri" class="text-decoration-none fw-bold lihat-lengkap">
                        Lihat Selengkapnya →
                    </a>
                </div>

                @foreach ($relatedGaleri->take(4) as $p)
                    {{-- MOBILE = 1 CARD KE BAWAH | DESKTOP = 4 CARD --}}
                    <div class="col-12 col-md-3">



                        <div class="card-galeri" style="height:180px;">

                            <img src="{{ url('admin/assets/img/galeri/foto') }}/{{ $p->foto }}">

                            <div class="card-text-overlay">

                                <h6 class="card-title">
                                    {{ \Illuminate\Support\Str::words($p->nama, 5, '...') }}
                                </h6>

                            </div>

                        </div>



                    </div>
                @endforeach



            </div>



            <hr class="my-5">


            {{-- ================= JADWAL ================= --}}
            @if ($jadwal)
                <div class="jadwal-container">

                    <h2 class="fw-bold mb-1">Waktu Sholat</h2>
                    <h6>{{ $tanggalFormat }}</h6>

                    <div class="text-center my-3">
                        <div>Waktu Saat Ini</div>
                        <div id="jam-sekarang"></div>
                    </div>

                    <div class="row text-center g-3">

                        <div class="col">
                            <div class="jadwal-box">Subuh<br>
                                <h3>{{ $jadwal['subuh'] }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="jadwal-box">Dzuhur<br>
                                <h3>{{ $jadwal['dzuhur'] }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="jadwal-box">Ashar<br>
                                <h3>{{ $jadwal['ashar'] }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="jadwal-box">Maghrib<br>
                                <h3>{{ $jadwal['maghrib'] }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="jadwal-box">Isya<br>
                                <h3>{{ $jadwal['isya'] }}</h3>
                            </div>
                        </div>

                    </div>

                </div>
            @endif

            <hr class="my-5">

            {{-- JADWAL JUMAT }}
            <div class="container py-4">

        {{-- ================= SEMUA AGENDA ================= --}}
            <div class="d-flex justify-content-between align-items-center mb-2">

                <div class="section-title">
                    <h2>Jadwal Khotib dan Muazin Jumat</h2>
                </div>
                {{-- DESKTOP --}}
                <a href="front-jumat" class="text-decoration-none fw-bold lihat-lengkap d-none d-md-block">
                    Lihat Selengkapnya →
                </a>

            </div>

            {{-- CARD --}}
            <div class="row g-3">
                {{-- MOBILE --}}
                <div class="ms-1 d-block d-md-none">
                    <a href="front-jumat" class="text-decoration-none fw-bold lihat-lengkap">
                        Lihat Selengkapnya →
                    </a>
                </div>

                @foreach ($relatedJumat as $p)
                    <div class="col-12 col-md-3">

                        <div href="{{ route('agenda.show', $p->id) }}" class="text-decoration-none">

                            <div class="card-jumat" style="height:180px;">


                                <div class="card-tulisan-overlay jadwal-card-content">

                                    <div class="tanggal-jumat">
                                        {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('l, d F Y') }}
                                    </div>

                                    <div class="petugas-wrapper">

                                        <div class="petugas-item">
                                            <span class="petugas-label">Khotib</span>
                                            <span class="petugas-nama">
                                                {{ ucwords(strtolower($p->khotib)) }}
                                            </span>
                                        </div>

                                        <div class="petugas-item">
                                            <span class="petugas-label">Muazin</span>
                                            <span class="petugas-nama">
                                                {{ ucwords(strtolower($p->muazin)) }}

                                            </span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

            {{-- PAGINATION --}}
            {{-- <div class="d-flex justify-content-center mt-5">
            {{ $data->links() }}
        </div> --}}

        </div>

        </div>


        <script>
            function updateJam() {
                const sekarang = new Date();

                const waktu = sekarang.toLocaleTimeString('id-ID', {
                    timeZone: 'Asia/Jakarta',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });

                document.getElementById("jam-sekarang").innerHTML = waktu;
            }

            setInterval(updateJam, 1000);
            updateJam();
        </script>


    @endguest
    @auth
        <section
            style="background-image: url('/admin/image/2.jpeg'); 
           background-size: cover; 
           background-position: 50% 30%; 
           height: 95vh; 
           width: 100%; 
           position: relative;
           margin-top:0;">

            <!-- overlay hitam transparan -->
            <div
                style="position: absolute; top:0; left:0; width:100%; height:100%; 
                background-color: rgba(0,0,0,0.8);">
            </div>

            <!-- konten teks -->
            <div class="d-flex flex-column justify-content-center align-items-center h-100"
                style="position: relative; z-index: 1;">
                <h1 class="text-white fw-bold text-center mb-4" style="font-size: 50px">
                    Selamat Datang di Sistem Informasi<br>Masjid Jami Roudhotul Jannah
                </h1>

            </div>
        </section>
    @endauth
@endsection
