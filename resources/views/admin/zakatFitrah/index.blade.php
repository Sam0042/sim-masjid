@extends('admin.layouts.app')
@section('konten')
    <!-- CREATE Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Zakat Fitrah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Nama Penerima">
                        <br>
                        <label for="desk" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Masukkan Alamat" rows="5" required style="white-space: pre-wrap;"></textarea>
                        <br>
                        <label for="total_zakat" class="form-label">Total Zakat</label>
                        <input type="text" class="form-control" name="total_zakat" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Total Zakat">
                        <br>
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input required type="date" class="form-control" name="tanggal" id="tanggalInput"
                            aria-describedby="dateHelp">
                        <br>
                        <label for="penerima_id" class="form-label">Penerima</label>
                        <select required name="penerima_id" id="select" class="form-control">
                            <option value="" disabled selected>Pilih Penerima</option>

                            @foreach ($penerima as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="belum didistribusikan">Belum Didistribusikan</option>
                            <option value="sudah didistribusikan">Sudah Didistribusikan</option>
                        </select>

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

    <!-- EDIT Modal -->
    @foreach ($data as $d)
        <!-- Modal -->
        <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('zakat_fitrah.update', $d->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama" value="{{ $d->nama }}">
                            <br>
                            <label for="desk" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Masukkan Alamat" rows="5" required style="white-space: pre-wrap;">{{ $d->alamat }}</textarea>
                            <br>
                            <label for="total_zakat" class="form-label">Total Zakat</label>
                            <input type="text" class="form-control" name="total_zakat" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Total Zakat"
                                value="{{ $d->total_zakat }}">
                            <br>
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input required type="date" class="form-control" name="tanggal" id="tanggalInput"
                                aria-describedby="dateHelp" value="{{ $d->tanggal }}">
                            <br>
                            <label for="penerima_id" class="form-label">Penerima</label>
                            <select required name="penerima_id" id="select" class="form-control">
                                <option value="" disabled selected>Pilih Penerima</option>
                                @foreach ($penerima as $p)
                                    <option value="{{ $p->id }}" {{ $d->penerima_id == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <br>
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="belum didistribusikan" @selected($d->status == 'belum didistribusikan')>Belum Didistribusikan
                                </option>
                                <option value="sudah didistribusikan" @selected($d->status == 'sudah didistribusikan')>Sudah Didistribusikan
                                </option>
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

        <!-- End of Modal -->
    @endforeach
    <!-- ini batas modal -->

    <!-- DETAIL Modal -->
    @foreach ($data as $d)
        <!-- Modal -->
        <div class="modal fade" id="detailModal{{ $d->id }}" tabindex="-1" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Penerima</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('zakat_fitrah.update', $d->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="imam_id" class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" name="nama" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama Penerima"
                                value="{{ $d->penerima }}" disabled>
                            <br>
                            <label for="usia" class="form-label">Usia Penerima</label>
                            <input type="number" class="form-control" name="usia" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Usia Penerima"
                                value="{{ $d->penerima_usia }}" disabled>
                            <br>
                            <label for="jeniskelamin" class="form-label">Jenis Kelamin Penerima</label>
                            <select class="form-control" name="jenis_kelamin" id="jeniskelamin" disabled>
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="l" @selected($d->penerima_jenis_kelamin == 'l')>Laki-laki</option>
                                <option value="p" @selected($d->penerima_jenis_kelamin == 'p')>Perempuan</option>

                            </select>
                            <br>
                            <label for="keterangan" class="form-label">Keterangan Penerima</label>
                            <input type="text" class="form-control" name="keterangan" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Keterangan"
                                value="{{ $d->penerima_keterangan }}" disabled>
                            <br>
                            <label for="desk" class="form-label">Alamat Penerima</label>
                            <textarea class="form-control" name="alamat" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Masukkan Alamat Penerima" rows="5" required style="white-space: pre-wrap;" disabled>{{ $d->penerima_alamat }}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- End of Modal -->
    @endforeach
    <!-- ini batas modal -->

    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Zakat Fitrah</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">

        </div>
        <div class="card mb-4">
            <div class="card-header">
                <a href="" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-square-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Total Zakat</th>
                            <th>Tanggal</th>
                            <th>Penerima</th>
                            <th>Status</th>

                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <th>No</th>

                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Total Zakat</th>
                        <th>Tanggal</th>
                        <th>Penerima</th>
                        <th>Status</th>

                        <th>Action</th>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->alamat }}</td>
                                <td>{{ $d->total_zakat }}</td>
                                <td>{{ $d->tanggal }}</td>
                                <td>
                                    {{ $d->penerima }} <br>
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $d->id }}">
                                        Detail
                                    </a>
                                </td>

                                <td>{{ $d->status == 'sudah didistribusikan' ? 'Sudah didistribusikan' : 'Belum didistribusikan' }}
                                </td>

                                <td>

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
                                    <div class="modal fade" id="exampleModal{{ $d->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin akan menghapus data {{ $d->keterangan }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>

                                                    <form action="{{ route('zakat_fitrah.destroy', $d->id) }}"
                                                        method="POST" style="display:inline;">
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
    </div>
@endsection
