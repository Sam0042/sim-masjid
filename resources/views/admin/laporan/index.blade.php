@extends('admin.layouts.app')
@section('konten')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Foto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="bulan" class="form-label">Pilih Bulan</label>
                        <select name="bulan" required>
                            <option value="" disabled>-- Pilih Bulan --</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                        <br>
                        <label for="tahun" class="form-label">Pilih Tahun</label>
                        <select name="tahun" required>
                            <option value="">-- Pilih Tahun --</option>
                            @for ($i = date('Y'); $i >= 2010; $i--)
                                <option value="{{ $i }}" {{ old('tahun') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor

                        </select>
                        <br>
                        <label for="pdf" class="form-label">File PDF</label>
                        <input type="file" name="file_pdf" accept="application/pdf" required><br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ini batas modal -->

    {{-- modal edit --}}
    @foreach ($data as $d)
        <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('laporan.update', $d->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="bulan" class="form-label">Pilih Bulan</label>
                            <select name="bulan" required>
                                <option value="Januari" {{ $d->bulan == 'Januari' ? 'selected' : '' }}>Januari</option>
                                <option value="Februari" {{ $d->bulan == 'Februari' ? 'selected' : '' }}>Februari</option>
                                <option value="Maret" {{ $d->bulan == 'Maret' ? 'selected' : '' }}>Maret</option>
                                <option value="April" {{ $d->bulan == 'April' ? 'selected' : '' }}>April</option>
                                <option value="Mei" {{ $d->bulan == 'Mei' ? 'selected' : '' }}>Mei</option>
                                <option value="Juni" {{ $d->bulan == 'Juni' ? 'selected' : '' }}>Juni</option>
                                <option value="Juli" {{ $d->bulan == 'Juli' ? 'selected' : '' }}>Juli</option>
                                <option value="Agustus" {{ $d->bulan == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                                <option value="September" {{ $d->bulan == 'September' ? 'selected' : '' }}>September
                                </option>
                                <option value="Oktober" {{ $d->bulan == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                                <option value="November" {{ $d->bulan == 'November' ? 'selected' : '' }}>November</option>
                                <option value="Desember" {{ $d->bulan == 'Desember' ? 'selected' : '' }}>Desember</option>
                            </select>
                            <br>
                            <label for="tahun" class="form-label">Pilih Tahun</label>
                            <select name="tahun" required>
                                <option value="">-- Pilih Tahun --</option>
                                @for ($i = date('Y'); $i >= 2010; $i--)
                                    <option value="{{ $i }}"
                                        {{ old('tahun', $d->tahun ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor

                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal edit --}}

    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Laporan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">

        </div>
        @auth
            <div class="card mb-4">
                <div class="card-header">
                    @auth
                        <a href="" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-square-plus"></i>
                        </a>
                    @endauth
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>

                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>PDF</th>


                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <th>No</th>

                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>PDF</th>


                            <th>Action</th>
                        </tfoot>
                        <tbody>

                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $d->bulan }}</td>
                                    <td>{{ $d->tahun }}</td>
                                    <td>


                                        <a href="/admin/assets/pdf/laporankas/{{ $d->file_pdf }}" target="blank">Lihat</a>
                                    </td>




                                    <td>
                                        {{-- <a href="{{ route('imam.edit', $d->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i></a> --}}
                                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $d->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i></a>

                                        <!-- ini untuk modal hapus -->
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $d->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade apus" id="exampleModal{{ $d->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin akan menghapus data {{ $d->bulan }}
                                                        {{ $d->tahun }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <form action="{{ route('laporan.destroy', $d->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ini batas modal hapus -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endauth
    </div>
@endsection
