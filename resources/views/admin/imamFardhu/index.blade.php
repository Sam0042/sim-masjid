@extends('admin.layouts.app')
@section('konten')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jadwal Imam</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('imamFardhu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="imam_id" class="form-label">Nama Imam</label>
                        <select required name="imam_id" id="select" class="form-control">
                            <option value="" disabled selected>Pilih Imam</option>
                            @foreach ($imam as $i)
                                <option value="{{ $i->id }}">{{ $i->nama }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="waktu" class="form-label">Waktu Shalat</label>
                        <select required name="waktu" id="waktuInput" class="form-control">
                            <option value="" disabled selected>Pilih Waktu Shalat</option>
                            <option value="Subuh">Subuh</option>
                            <option value="Dzuhur">Dzuhur</option>
                            <option value="Ashar">Ashar</option>
                            <option value="Maghrib">Maghrib</option>
                            <option value="Isya">Isya</option>
                        </select>
                        <br>
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input required type="date" class="form-control" name="tanggal" id="tanggalInput"
                            aria-describedby="dateHelp" placeholder="Pilih Tanggal Jumat"
                            min="{{ \Carbon\Carbon::now()->toDateString() }}">




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Mendapatkan data jadwal yang sudah ada dari backend
        const takenSchedules = @json($takenSchedules); // Format [{"tanggal": "2024-11-15", "waktu": "10:00"}, ...]

        document.getElementById('tanggalInput').addEventListener('change', validateDateAndTime);
        document.getElementById('waktuInput').addEventListener('change', validateDateAndTime);

        function validateDateAndTime() {
            const dateInput = document.getElementById('tanggalInput');
            const timeInput = document.getElementById('waktuInput');
            const inputDate = dateInput.value;
            const inputTime = timeInput.value;

            if (!inputDate || !inputTime) return; // Pastikan kedua input terisi sebelum validasi

            // Cek apakah kombinasi tanggal dan waktu sudah ada di takenSchedules
            const conflict = takenSchedules.some(schedule => schedule.tanggal === inputDate && schedule.waktu ===
                inputTime);

            if (conflict) {
                alert("Jadwal untuk tanggal dan waktu ini sudah ada. Silakan pilih waktu lain.");
                timeInput.value = ""; // Kosongkan input waktu jika bentrok
            }
        }
    </script>
    <!-- ini batas modal -->

    <!-- Modal -->
    {{-- VALIDASI WAKTU BELUM SOLVED --}}
    @foreach ($data as $d)
        <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('imamFardhu.update', $d->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="imam_id" class="form-label">Nama Imam</label>
                            <select required name="imam_id" id="select" class="form-control">
                                <option value="" disabled selected>Pilih Imam</option>
                                @foreach ($imam as $i)
                                    <option value="{{ $i->id }}" {{ $d->imam_id == $i->id ? 'selected' : '' }}>
                                        {{ $i->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <br>
                            <label for="waktu" class="form-label">Waktu Shalat</label>
                            <select required name="waktu" id="waktuInput" class="form-control">
                                {{-- <option value="" disabled selected>Pilih Waktu Shalat</option> --}}
                                @foreach ($waktu as $w)
                                    @php
                                    $cek = $w == $d->waktu ? 'selected' : ''; @endphp
                                    <option value="{{ $w }}" {{ $cek }}>{{ $w }}</option>
                                @endforeach
                            </select>
                            <br>
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input required type="date" class="form-control" name="tanggal"
                                id="tanggalInput{{ $d->id }}" value="{{ $d->tanggal }}"
                                min="{{ \Carbon\Carbon::now()->toDateString() }}">
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

        <script>
            // Mendapatkan data jadwal yang sudah ada dari backend
            const takenSchedules = @json($takenSchedules); // Format [{"tanggal": "2024-11-15", "waktu": "10:00"}, ...]

            document.getElementById('tanggalInput').addEventListener('change', validateDateAndTime);
            document.getElementById('waktuInput').addEventListener('change', validateDateAndTime);

            function validateDateAndTime() {
                const dateInput = document.getElementById('tanggalInput');
                const timeInput = document.getElementById('waktuInput');
                const inputDate = dateInput.value;
                const inputTime = timeInput.value;

                if (!inputDate || !inputTime) return; // Pastikan kedua input terisi sebelum validasi

                // Cek apakah kombinasi tanggal dan waktu sudah ada di takenSchedules
                const conflict = takenSchedules.some(schedule => schedule.tanggal === inputDate && schedule.waktu ===
                    inputTime);

                if (conflict) {
                    alert("Jadwal untuk tanggal dan waktu ini sudah ada. Silakan pilih waktu lain.");
                    timeInput.value = ""; // Kosongkan input waktu jika bentrok
                }
            }
        </script>
    @endforeach
    <!-- ini batas modal -->

    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Imam Fardhu</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Tables</li>
        </ol>
        <div class="card mb-4">

        </div>
        <div class="card mb-4">
            <div class="card-header">
                @auth
                    <a href="" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-square-plus"></i>
                    </a>
                @endauth
                @guest
                    <h5>Jadwal Imam Fardhu</h5>
                @endguest
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Waktu</th>
                            <th>Tanggal</th>
                            @auth
                                <th>Action</th>
                            @endauth
                        </tr>
                    </thead>
                    <tfoot>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Tanggal</th>
                        @auth
                            <th>Action</th>
                        @endauth
                    </tfoot>
                    <tbody>

                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->waktu }}</td>
                                <td>{{ $d->tanggal }}</td>

                                @auth
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
                                                        Apakah anda yakin akan menghapus data {{ $d->nama }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <form action="{{ route('imamFardhu.destroy', $d->id) }}"
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
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
