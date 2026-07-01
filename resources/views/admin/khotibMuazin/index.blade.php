@extends('admin.layouts.app')
@section('konten')
    <!-- Modal -->
    <div style="height:90%; margin-top: 3.5rem;"class="modal fade" id="exampleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jadwal Khotib dan Muazin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('khotibMuazin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input required type="date" class="form-control" name="tanggal" id="tanggalInput"
                            aria-describedby="dateHelp" placeholder="Pilih Tanggal Jumat"
                            min="{{ \Carbon\Carbon::now()->toDateString() }}">
                        <br>
                        <label for="khotib" class="form-label">Nama Khotib</label>
                        <input type="text" class="form-control" name="khotib" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Nama Khotib" required>
                        <br>
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="number" class="form-control" name="no_hp" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Nomor HP Khotib">
                        <br>
                        <label for="muazin" class="form-label">Nama Muazin</label>
                        <input type="text" class="form-control" name="muazin" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Nama Muazin" required>
                        <br>



                        <script>
                            // Daftar tanggal yang sudah dipilih oleh imam lain (misalnya ini diambil dari database)
                            const takenDates = @json($takenDates); // Mendapatkan tanggal yang sudah terambil dari backend

                            document.getElementById('tanggalInput').addEventListener('change', function() {
                                const inputDate = new Date(this.value);
                                const dayOfWeek = inputDate.getUTCDay();

                                // Validasi agar hanya tanggal Jumat yang bisa dipilih
                                if (dayOfWeek !== 5) {
                                    alert("Silakan pilih tanggal yang jatuh pada hari Jumat.");
                                    this.value = ""; // Mengosongkan input jika bukan Jumat
                                }

                                // Validasi agar hanya tanggal yang lebih besar atau sama dengan hari ini yang bisa dipilih
                                const today = new Date();
                                if (inputDate < today) {
                                    alert("Silakan pilih tanggal yang akan datang.");
                                    this.value = ""; // Mengosongkan input jika tanggal yang dipilih lebih kecil dari hari ini
                                }

                                // Validasi agar tanggal yang dipilih tidak bentrok dengan imam lain
                                if (takenDates.includes(this.value)) {
                                    alert("Tanggal ini sudah dipilih sebelumnya. Silakan pilih tanggal lain.");
                                    this.value = ""; // Mengosongkan input jika tanggal sudah terambil
                                }
                            });
                        </script>


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
                        <h5 class="modal-title" id="editModalLabel">Edit Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('khotibMuazin.update', $d->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input required type="date" class="form-control" name="tanggal"
                                id="tanggalInput{{ $d->id }}" value="{{ $d->tanggal }}"
                                min="{{ \Carbon\Carbon::now()->toDateString() }}">
                            <br>
                            <label for="khotib" class="form-label">Nama Khotib</label>
                            <input type="text" class="form-control" name="khotib" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama Khotib" value="{{ $d->khotib }}">
                            <br>
                            <label for="no_hp" class="form-label">Nomor HP Khotib</label>
                            <input type="number" class="form-control" name="no_hp" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Nomor HP Khotib"
                                value="{{ $d->no_hp }}">
                            <br>
                            <label for="muazin" class="form-label">Nama Muazin</label>
                            <input type="text" class="form-control" name="muazin" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Masukkan Nama Muazin"
                                value="{{ $d->muazin }}">
                            <br>


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
            // const takenDates = @json($takenDates);
            // Menggunakan event listener ketika modal ditampilkan
            document.getElementById('editModal{{ $d->id }}').addEventListener('shown.bs.modal', function() {
                const dateInput = document.getElementById('tanggalInput{{ $d->id }}');

                // Menambahkan event listener pada input date
                dateInput.addEventListener('change', function() {
                    const inputDate = new Date(this.value);
                    const dayOfWeek = inputDate.getUTCDay();

                    if (dayOfWeek !== 5) { // Mengecek apakah hari Jumat
                        alert("Silakan pilih tanggal yang jatuh pada hari Jumat.");
                        this.value = "";
                    }

                    const today = new Date();
                    if (inputDate < today) { // Mengecek apakah tanggal yang dipilih lebih besar dari hari ini
                        alert("Silakan pilih tanggal yang akan datang.");
                        this.value = "";
                    }

                    // Validasi agar tanggal yang dipilih tidak bentrok dengan imam lain
                    if (takenDates.includes(this.value)) {
                        alert("Tanggal ini sudah dipilih oleh imam lain. Silakan pilih tanggal lain.");
                        this.value = ""; // Mengosongkan input jika tanggal sudah terambil
                    }

                });
            });
        </script>
    @endforeach
    <!-- ini batas modal -->

    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Khotib dan Muazin Jumat</h1>
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
                    <h5>Jadwal Imam Jumat</h5>
                @endguest
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Khotib/Imam</th>
                            <th>Nomor Hp</th>
                            <th>Muazin</th>
                            @auth
                                <th>Action</th>
                            @endauth
                        </tr>
                    </thead>
                    <tfoot>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Khotib/Imam</th>
                        <th>Nomor Hp</th>
                        <th>Muazin</th>
                        @auth
                            <th>Action</th>
                        @endauth
                    </tfoot>
                    <tbody>

                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->tanggal }}</td>
                                <td>{{ $d->khotib }}</td>
                                </td>
                                <td>{{ $d->no_hp }}</td>
                                <td>{{ $d->muazin }}</td>
                                </td>

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
                                        <div class="modal fade apus" id="exampleModal{{ $d->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin akan menghapus data {{ $d->tanggal }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                        <form action="{{ route('khotibMuazin.destroy', $d->id) }}"
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
