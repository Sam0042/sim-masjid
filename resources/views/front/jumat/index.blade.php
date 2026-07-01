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
                JADWAL JUMAT
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="/" class="text-white fw-semibold text-decoration-none">Beranda</a>
                </li>
                <li class="breadcrumb-item active fw-semibold" id="target-bcm">Jadwal Jumat</li>
            </ol>

        </div>
    </section>


    <style>
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

        .card-text-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 15px;
            z-index: 2;
            color: white;
            width: 100%;
        }

        .card-jumat:hover {
            transform: scale(1.02);
            transition: 0.3s;
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

        .jadwal-card-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;

            color: white;
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

        {{-- ================= SEMUA AGENDA ================= --}}
        <div class="d-flex justify-content-between align-items-center mb-2">

            <div class="section-title">
                <h2>Jadwal Khotib dan Muazin Jumat</h2>
            </div>

        </div>

        {{-- CARD --}}
        <div class="row g-3">

            {{-- @foreach ($data as $p)
                <div class="col-12 col-md-3">

                    <div href="{{ route('agenda.show', $p->id) }}" class="text-decoration-none">

                        <div class="card-jumat" style="height:180px;">


                            <div class="card-text-overlay jadwal-card-content">

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
            @endforeach --}}

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- Menambahkan kelas table-striped untuk membuat baris selang-seling abu-putih --}}
                        <table id="datatablesSimple" class="table table-bordered table-striped align-middle">
                            {{-- Menambahkan kelas table-dark untuk latar hitam dan teks putih pada header --}}
                            <thead class="table-dark">
                                <tr>

                                    <th>Tanggal</th>
                                    <th>Khotib/Imam</th>
                                    <th>Muazin</th>
                                    @auth
                                        <th class="text-center" style="width: 15%">Action</th>
                                    @endauth
                                </tr>
                            </thead>
                            {{-- Menambahkan kelas table-dark juga pada footer agar serasi --}}
                            <thead class="table-dark">
                                <tr>

                                    <th>Tanggal</th>
                                    <th>Khotib/Imam</th>
                                    <th>Muazin</th>
                                    @auth
                                        <th class="text-center">Action</th>
                                    @endauth
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>

                                        <td>{{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $d->khotib }}</td>
                                        <td>{{ $d->muazin }}</td>

                                        @auth
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $d->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $d->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>

                                                <div class="modal fade apus text-start" id="exampleModal{{ $d->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus data
                                                                </h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah anda yakin akan menghapus data {{ $d->tanggal }}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>

                                                                <form action="{{ route('khotibMuazin.destroy', $d->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endauth
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Skrip JavaScript diletakkan di bawah div card-body --}}
            <script>
                window.addEventListener('DOMContentLoaded', event => {
                    const datatablesSimple = document.getElementById('datatablesSimple');
                    if (datatablesSimple) {
                        new simpleDatatables.DataTable(datatablesSimple, {
                            // Menentukan pilihan jumlah baris dan default tampilan pertama (5 baris)
                            perPageSelect: [5, 10, 15, 20, 25],
                            perPage: 5,
                            labels: {
                                placeholder: "Cari...",
                                perPage: "baris per halaman",
                                noRows: "Tidak ada data ditemukan",
                                info: "Menampilkan {start} sampai {end} dari {rows} baris",
                            }
                        });
                    }
                });
            </script>
        </div>


        {{-- <div class="d-flex justify-content-center mt-5">
            {{ $data->links() }}
        </div> --}}

    </div>
@endsection
