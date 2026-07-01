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
                    <form action="{{ route('imamJumat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="imam_id" class="form-label">Nama Imam</label>
                        <select required name="imam_id" id="select" class="form-control">
                            <option value="" disabled selected>Pilih Imam</option>
                            @foreach ($imam as $i)
                                <option value="{{ $i->id }}">{{ $i->nama }}</option>
                            @endforeach
                        </select>
                        <br>
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input required type="date" class="form-control" name="tanggal" id="tanggalInput"
                            aria-describedby="dateHelp" placeholder="Pilih Tanggal Jumat"
                            min="{{ \Carbon\Carbon::now()->toDateString() }}">

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
                                    alert("Tanggal ini sudah dipilih oleh imam lain. Silakan pilih tanggal lain.");
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
    {{-- VALIDASI TANGGAL BELUM FIXED --}}
    @foreach ($data as $d)
        <!-- Modal -->
        <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Jadwal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('imamJumat.update', $d->id) }}" method="POST">
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
        <h1 class="mt-4">Data Imam Jumat</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active">Jadwal</li>
        </ol>
        <div class="card mb-4">

        </div>
        <div class="card mb-4">
            <div class="card-header">


                <h5>Jadwal Imam Jumat</h5>

            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                    </tfoot>
                    <tbody>

                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->nama }}</td>

                                <td>{{ $d->tanggal }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
