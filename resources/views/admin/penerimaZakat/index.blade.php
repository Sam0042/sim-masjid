@extends('admin.layouts.app')
@section('konten')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Penerima Zakat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Nama Penerima">
                        <br>
                        <label for="usia" class="form-label">Usia</label>
                        <input type="number" class="form-control" name="usia" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Usia Penerima">
                        <br>
                        <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jeniskelamin">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="l">Laki-laki</option>
                            <option value="p">Perempuan</option>
                        </select>
                        <br>
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Keterangan">
                        <br>
                        <label for="desk" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Masukkan Alamat Penerima" rows="5" required style="white-space: pre-wrap;"></textarea>


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

    <!-- Modal -->
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
                    <form action="{{ route('penerima_zakat.update', $d->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="imam_id" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama Penerima"
                                value="{{ $d->nama }}">
                            <label for="usia" class="form-label">Usia</label>
                            <input type="number" class="form-control" name="usia" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Usia Penerima"
                                value="{{ $d->usia }}">
                            <br>
                            <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jeniskelamin">
                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                <option value="l" @selected($d->jenis_kelamin == 'l')>Laki-laki</option>
                                <option value="p" @selected($d->jenis_kelamin == 'p')>Perempuan</option>

                            </select>
                            <br>
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Keterangan"
                                value="{{ $d->keterangan }}">
                            <br>
                            <label for="desk" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Masukkan Alamat Penerima" rows="5" required style="white-space: pre-wrap;">{{ $d->alamat }}</textarea>
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

    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Penerima Zakat</h1>
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
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Keterangan</th>
                            <th>Alamat</th>

                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <th>No</th>

                        <th>Nama</th>
                        <th>Usia</th>
                        <th>Jenis Kelamin</th>
                        <th>Keterangan</th>
                        <th>Alamat</th>

                        <th>Action</th>
                    </tfoot>
                    <tbody>

                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->usia }}</td>
                                <td>{{ $d->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $d->keterangan }}</td>
                                <td>{{ $d->alamat }}</td>

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

                                                    <form action="{{ route('penerima_zakat.destroy', $d->id) }}"
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
