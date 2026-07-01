@extends('admin.layouts.app')
@section('konten')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Zakat Fitrah</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>

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


        <div class="card mb-4">

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


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
