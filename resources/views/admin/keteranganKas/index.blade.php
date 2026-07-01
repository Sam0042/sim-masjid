@extends('admin.layouts.app')
@section('konten')
    <!-- Modal -->
    <div style="height:90%; margin-top: 3.5rem;"class="modal fade" id="exampleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Keterangan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="keterangan_id" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Keterangan" required>

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
        <div style="height:90%; margin-top: 3.5rem;"class="modal fade" id="editModal{{ $d->id }}" tabindex="-1"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('keterangan_kas.update', $d->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="imam_id" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Keterangan" value="{{ $d->keterangan }}">
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
        <h1 class="mt-4">Data Keterangan Kas</h1>
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

                            <th>Keterangan</th>

                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <th>No</th>

                        <th>Keterangan</th>

                        <th>Action</th>
                    </tfoot>
                    <tbody>

                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $d->keterangan }}</td>


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
                                                    Apakah anda yakin akan menghapus data {{ $d->keterangan }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>

                                                    <form action="{{ route('keterangan_kas.destroy', $d->id) }}"
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
