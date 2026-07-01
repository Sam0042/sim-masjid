@extends('admin.layouts.app')

@section('konten')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Log Aktivitas Sistem</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Log Aktivitas</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Riwayat Aktivitas User
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Aksi</th>
                            <th>Tabel</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Aksi</th>
                            <th>Model</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                                <td>{{ $activity->causer ? $activity->causer->name : 'System' }}</td>
                                <td>
                                    {{ $activity->description }}

                                    @php
                                        $namaData =
                                            $activity->properties['old']['keterangan'] ??
                                            ($activity->properties['attributes']['keterangan'] ?? null);
                                    @endphp

                                    @if ($namaData)
                                        : <strong>{{ $namaData }}</strong>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ class_basename($activity->subject_type) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
