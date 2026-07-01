@extends('admin.layouts.app')

@section('konten')
    <div class="container-fluid px-4">

        <h1 class="mt-4">
            Data Saldo Awal
        </h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
                <a href="dashboard">Dashboard</a>
            </li>

            <li class="breadcrumb-item active">
                Saldo Awal
            </li>
        </ol>

        @auth


            <form action="{{ route('saldo-awal.update', $data->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- ================= VISI ================= --}}
                <div class="card border mb-4">

                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            Saldo Awal
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <input type="number" name="nominal" class="form-control" value="{{ $data->nominal }}" required
                                placeholder="Masukkan nominal">
                            {{-- <p>halo</p> --}}
                        </div>
                        {{-- <i>Terakhir diubah:
                            {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('\T\a\n\g\g\a\l d F Y, \J\a\m H:i:s') }}
                        </i> --}}

                    </div>

                </div>



                {{-- ================= BUTTON ================= --}}
                <div class="text-end">

                    <button type="submit" class="btn btn-success px-4">

                        <i class="fa-solid fa-floppy-disk me-1"></i>

                        SIMPAN DATA

                    </button>

                </div>

            </form>

        @endauth

    </div>
@endsection
