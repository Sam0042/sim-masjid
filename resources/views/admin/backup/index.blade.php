@extends('admin.layouts.app') {{-- Sesuaikan layout Anda --}}

@section('konten')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Backup Database</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Backup Database</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-database me-1"></i>
                Aksi Backup
            </div>
            <div class="card-body">
                <form action="{{ route('backup.run') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-cloud-upload-alt me-1"></i> Jalankan Backup Sekarang
                    </button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-file-archive me-1"></i>
                Daftar File Backup
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Tanggal Backup</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th>Tanggal Backup</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ basename($file) }}</td>
                                <td>{{ date('d-m-Y H:i:s', filemtime($file)) }}</td>
                                <td>
                                    <a href="{{ route('backup.download', basename($file)) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                    {{-- Jika Anda punya fitur hapus backup, tambahkan di sini --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
