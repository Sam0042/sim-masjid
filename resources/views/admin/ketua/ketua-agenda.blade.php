@extends('admin.layouts.app')
@section('konten')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Agenda</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">

        </div>
        @auth
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>

                                <th>Nama</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>No</th>

                            <th>Nama</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Foto</th>
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



                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endauth
    </div>
@endsection
