@extends('admin.layouts.app')
@section('konten')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Khotib dan Muazin Jumat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">

        </div>
        <div class="card mb-4">

            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Khotib/Imam</th>
                            <th>Nomor Hp</th>
                            <th>Muazin</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Khotib/Imam</th>
                        <th>Nomor Hp</th>
                        <th>Muazin</th>
                    </tfoot>
                    <tbody>

                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $d->khotib }}</td>
                                <td>{{ $d->no_hp }}</td>
                                <td>{{ $d->muazin }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
