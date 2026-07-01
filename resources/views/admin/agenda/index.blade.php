@extends('admin.layouts.app')
@section('konten')
    <!-- Modal -->
    <div style="height:90%;" class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Agenda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="imam_id" class="form-label">Nama Agenda</label>
                        <input type="text" class="form-control" name="nama" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Nama Agenda" required>
                        <br>
                        <label for="" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Lokasi" required>
                        <br>
                        <label for="desk" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Masukkan Deskripsi" rows="5" required style="white-space: pre-wrap;"></textarea>

                        <br>
                        <label for="tanggal" class="form-label">Tanggal Mulai</label>
                        <input required type="datetime-local" class="form-control" name="tanggal_mulai" id="tanggalInput"
                            aria-describedby="dateHelp" placeholder="Pilih Tanggal dan Jam"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}" required>

                        <br>
                        <label for="tanggal" class="form-label">Tanggal Selesai</label>
                        <input required type="datetime-local" class="form-control" name="tanggal_selesai" id="tanggalInput"
                            aria-describedby="dateHelp" placeholder="Pilih Tanggal dan Jam"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}" required>


                        <br>
                        <label for="tanggal" class="form-label">Foto</label>
                        <input id="text5" name="foto" type="file" class="form-control" required>

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
        <div style="height:90%; margin-top: 3.5rem;" class="modal fade all-modal" id="editModal{{ $d->id }}"
            tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Agenda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('agenda.update', $d->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="imam_id" class="form-label">Nama Agenda</label>
                            <input type="text" class="form-control" name="nama" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama Program"
                                value="{{ $d->nama }}" required>
                            <br>
                            <label for="" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Lokasi" value="{{ $d->lokasi }}"
                                required>
                            <br>
                            <label for="desk" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Masukkan Deskripsi" rows="5" required style="white-space: pre-wrap;">{{ $d->deskripsi }}</textarea>

                            <br>
                            <label for="tanggal" class="form-label">Tanggal Mulai</label>

                            <input required type="datetime-local" class="form-control" name="tanggal_mulai"
                                id="tanggalInput" aria-describedby="dateHelp"
                                min="{{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}"
                                value="{{ \Carbon\Carbon::parse($d->tanggal_mulai)->format('Y-m-d H:i') }}" required>
                            <br>
                            <label for="tanggal" class="form-label">Tanggal Selesai</label>
                            <input required type="datetime-local" class="form-control" name="tanggal_selesai"
                                id="tanggalInput" aria-describedby="dateHelp"
                                min="{{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}"
                                value="{{ \Carbon\Carbon::parse($d->tanggal_selesai)->format('Y-m-d H:i') }}" required>
                            <br>
                            {{-- <label for="foto" class="form-label">Foto</label>
                            <input id="text5" name="foto" type="file" class="form-control"
                                value="{{ $d->foto }}" required> --}}
                            <label for="text5">Foto</label>
                            <input id="text5" name="foto" type="file" class="form-control"
                                value="{{ $d->foto }}">
                            @if (!empty($d->foto))
                                <img src="{{ url('admin/assets/img/agenda') }}/{{ $d->foto }}" alt="project-image"
                                    class=" mt-1" style="width: 250px;height:150px">
                            @endif
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
        <h1 class="mt-4">Data Agenda</h1>
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

                                <th>Nama</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Foto</th>

                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <th>No</th>

                            <th>Nama</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Foto</th>

                            <th>Action</th>
                        </tfoot>
                        <tbody>

                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->tanggal_mulai }}</td>
                                    <td>{{ $d->tanggal_selesai }}</td>
                                    <td>
                                        <img src="/admin/assets/img/agenda/{{ $d->foto }}" alt="{{ $d->nama }}"
                                            class="img-fluid rounded" style="max-width: 80px;">
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
                                                        Apakah anda yakin akan menghapus data {{ $d->nama }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <form action="{{ route('agenda.destroy', $d->id) }}" method="POST"
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
