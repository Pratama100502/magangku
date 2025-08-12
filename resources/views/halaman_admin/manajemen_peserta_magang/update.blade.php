@extends('layouts.admin.app')

@section('title', 'Edit Peserta Magang')

@section('content')

    <body>
        <div class="container-xl">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Peserta Magang</h3>
                                </div>
                                <!-- /.card-header -->
                                <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama">Nama Lengkap</label>
                                                    <input type="text"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        id="nama" name="nama" placeholder="Masukkan nama lengkap"
                                                        value="{{ old('nama', $peserta->nama) }}" required>
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="nim">NIM</label>
                                                    <input type="text"
                                                        class="form-control @error('nim') is-invalid @enderror"
                                                        id="nim" name="nim" placeholder="Masukkan NIM"
                                                        value="{{ old('nim', $peserta->nim) }}" required>
                                                    @error('nim')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" name="email" placeholder="Masukkan email"
                                                        value="{{ old('email', $peserta->email) }}" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password" name="password"
                                                        placeholder="Kosongkan jika tidak ingin mengubah">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="no_hp">Nomor HP</label>
                                                    <input type="text"
                                                        class="form-control @error('no_hp') is-invalid @enderror"
                                                        id="no_hp" name="no_hp" placeholder="Masukkan nomor HP"
                                                        value="{{ old('no_hp', $peserta->no_hp) }}" required>
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="asal_sekolah">Asal Sekolah/Universitas</label>
                                                    <input type="text"
                                                        class="form-control @error('asal_sekolah') is-invalid @enderror"
                                                        id="asal_sekolah" name="asal_sekolah"
                                                        placeholder="Masukkan asal sekolah/universitas"
                                                        value="{{ old('asal_sekolah', $peserta->asal_sekolah) }}" required>
                                                    @error('asal_sekolah')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="jurusan">Jurusan</label>
                                                    <input type="text"
                                                        class="form-control @error('jurusan') is-invalid @enderror"
                                                        id="jurusan" name="jurusan" placeholder="Masukkan jurusan"
                                                        value="{{ old('jurusan', $peserta->jurusan) }}" required>
                                                    @error('jurusan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control @error('status') is-invalid @enderror"
                                                        id="status" name="status" required>
                                                        <option value="">Pilih Status</option>
                                                        <option value="mengajukan"
                                                            {{ old('status', $peserta->status) == 'mengajukan' ? 'selected' : '' }}>
                                                            Mengajukan</option>
                                                        <option value="diterima"
                                                            {{ old('status', $peserta->status) == 'diterima' ? 'selected' : '' }}>
                                                            Diterima</option>
                                                        <option value="diterima_dan_loa_dapat_di_ambil"
                                                            {{ old('status', $peserta->status) == 'diterima_dan_loa_dapat_di_ambil' ? 'selected' : '' }}>
                                                            Diterima dan LOA dapat diambil</option>
                                                        <option value="aktif"
                                                            {{ old('status', $peserta->status) == 'aktif' ? 'selected' : '' }}>
                                                            Aktif</option>
                                                        <option value="selesai"
                                                            {{ old('status', $peserta->status) == 'selesai' ? 'selected' : '' }}>
                                                            Selesai</option>
                                                        <option value="ditolak"
                                                            {{ old('status', $peserta->status) == 'ditolak' ? 'selected' : '' }}>
                                                            Ditolak</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="mentor_id">Mentor</label>
                                                    <select class="form-control @error('mentor_id') is-invalid @enderror"
                                                        id="mentor_id" name="mentor_id">
                                                        <option value="">Pilih Mentor (Opsional)</option>
                                                        @foreach ($mentors as $mentor)
                                                            <option value="{{ $mentor->id }}"
                                                                {{ old('mentor_id', $peserta->mentor_id) == $mentor->id ? 'selected' : '' }}>
                                                                {{ $mentor->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('mentor_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="catatan">Catatan</label>
                                                    <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan"
                                                        placeholder="Masukkan catatan (opsional)">{{ old('catatan', $peserta->catatan) }}</textarea>
                                                    @error('catatan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                                    <input type="date"
                                                        class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                        id="tanggal_mulai" name="tanggal_mulai"
                                                        value="{{ old('tanggal_mulai', $peserta->tanggal_mulai) }}"
                                                        required>
                                                    @error('tanggal_mulai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                                    <input type="date"
                                                        class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                                        id="tanggal_selesai" name="tanggal_selesai"
                                                        value="{{ old('tanggal_selesai', $peserta->tanggal_selesai) }}"
                                                        required>
                                                    @error('tanggal_selesai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <h4>Anggota Magang (Jika Berkelompok)</h4>
                                        <div id="anggota-container">
                                            @foreach ($peserta->anggota as $index => $anggota)
                                                <div class="anggota-item row mb-3">
                                                    <div class="col-md-5">
                                                        <input type="hidden" name="anggota[{{ $index }}][id]"
                                                            value="{{ $anggota->id }}">
                                                        <input type="text" class="form-control"
                                                            name="anggota[{{ $index }}][nama]"
                                                            placeholder="Nama Anggota"
                                                            value="{{ old('anggota.' . $index . '.nama', $anggota->nama) }}">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            name="anggota[{{ $index }}][no_hp]"
                                                            placeholder="Nomor HP Anggota"
                                                            value="{{ old('anggota.' . $index . '.no_hp', $anggota->no_hp) }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger hapus-anggota">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" id="tambah-anggota" class="btn btn-sm btn-primary mt-2">
                                            <i class="fas fa-plus"></i> Tambah Anggota
                                        </button>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Simpan Perubahan
                                        </button>
                                        <a href="{{ route('peserta.index') }}" class="btn btn-secondary float-right">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
 HEAD
                        <!-- /.col -->

                        <!-- /.card-header -->
                        <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                id="nama" name="nama" placeholder="Masukkan nama lengkap"
                                                value="{{ old('nama', $peserta->nama) }}" required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nim">NIM</label>
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                                id="nim" name="nim" placeholder="Masukkan NIM"
                                                value="{{ old('nim', $peserta->nim) }}" required>
                                            @error('nim')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" placeholder="Masukkan email"
                                                value="{{ old('email', $peserta->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="no_hp">Nomor HP</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                id="no_hp" name="no_hp" placeholder="Masukkan nomor HP"
                                                value="{{ old('no_hp', $peserta->no_hp) }}" required>
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="asal_sekolah">Asal Sekolah/Universitas</label>
                                            <input type="text"
                                                class="form-control @error('asal_sekolah') is-invalid @enderror"
                                                id="asal_sekolah" name="asal_sekolah"
                                                placeholder="Masukkan asal sekolah/universitas"
                                                value="{{ old('asal_sekolah', $peserta->asal_sekolah) }}" required>
                                            @error('asal_sekolah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="jurusan">Jurusan</label>
                                            <input type="text"
                                                class="form-control @error('jurusan') is-invalid @enderror" id="jurusan"
                                                name="jurusan" placeholder="Masukkan jurusan"
                                                value="{{ old('jurusan', $peserta->jurusan) }}" required>
                                            @error('jurusan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="mengajukan"
                                                    {{ old('status', $peserta->status) == 'mengajukan' ? 'selected' : '' }}>
                                                    Mengajukan</option>
                                                <option value="diterima"
                                                    {{ old('status', $peserta->status) == 'diterima' ? 'selected' : '' }}>
                                                    Diterima</option>
                                                <option value="diterima_dan_loa_dapat_di_ambil"
                                                    {{ old('status', $peserta->status) == 'diterima_dan_loa_dapat_di_ambil' ? 'selected' : '' }}>
                                                    Diterima dan LOA dapat diambil</option>
                                                <option value="aktif"
                                                    {{ old('status', $peserta->status) == 'aktif' ? 'selected' : '' }}>
                                                    Aktif</option>
                                                <option value="selesai"
                                                    {{ old('status', $peserta->status) == 'selesai' ? 'selected' : '' }}>
                                                    Selesai</option>
                                                <option value="ditolak"
                                                    {{ old('status', $peserta->status) == 'ditolak' ? 'selected' : '' }}>
                                                    Ditolak</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mentor_id">Mentor</label>
                                            <select class="form-control @error('mentor_id') is-invalid @enderror"
                                                id="mentor_id" name="mentor_id">
                                                <option value="">Pilih Mentor (Opsional)</option>
                                                @foreach ($mentors as $mentor)
                                                    <option value="{{ $mentor->id }}"
                                                        {{ old('mentor_id', $peserta->mentor_id) == $mentor->id ? 'selected' : '' }}>
                                                        {{ $mentor->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('mentor_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="catatan">Catatan</label>
                                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan"
                                                placeholder="Masukkan catatan (opsional)">{{ old('catatan', $peserta->catatan) }}</textarea>
                                            @error('catatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_mulai">Tanggal Mulai</label>
                                            <input type="date"
                                                class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                                id="tanggal_mulai" name="tanggal_mulai"
                                                value="{{ old('tanggal_mulai', $peserta->tanggal_mulai) }}" required>
                                            @error('tanggal_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai">Tanggal Selesai</label>
                                            <input type="date"
                                                class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                                id="tanggal_selesai" name="tanggal_selesai"
                                                value="{{ old('tanggal_selesai', $peserta->tanggal_selesai) }}" required>
                                            @error('tanggal_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h4>Anggota Magang (Jika Berkelompok)</h4>
                                <div id="anggota-container">
                                    @foreach ($peserta->anggota as $index => $anggota)
                                        <div class="anggota-item row mb-3">
                                            <div class="col-md-5">
                                                <input type="hidden" name="anggota[{{ $index }}][id]"
                                                    value="{{ $anggota->id }}">
                                                <input type="text" class="form-control"
                                                    name="anggota[{{ $index }}][nama_anggota]"
                                                    placeholder="Nama Anggota"
                                                    value="{{ old('anggota.' . $index . '.nama_anggota', $anggota->nama_anggota) }}">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control"
                                                    name="anggota[{{ $index }}][no_hp_anggota]"
                                                    placeholder="Nomor HP Anggota"
                                                    value="{{ old('anggota.' . $index . '.no_hp_anggota', $anggota->no_hp_anggota) }}">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-sm btn-danger hapus-anggota">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="tambah-anggota" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus"></i> Tambah Anggota
                                </button>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('peserta.index') }}" class="btn btn-secondary float-right">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
>>>>>>> e98bfb4426354dbac02822d3731d483fcd36c4ae
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Anggota dinamis
            const anggotaContainer = document.getElementById('anggota-container');
            const tambahAnggotaBtn = document.getElementById('tambah-anggota');
            let anggotaCount = {{ $peserta->anggota->count() }};

            // Template untuk anggota baru
            function createAnggotaField() {
                anggotaCount++;
                const div = document.createElement('div');
                div.className = 'anggota-item row mb-3';
                div.innerHTML = `
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="anggota[${anggotaCount}][nama]" placeholder="Nama Anggota">
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="anggota[${anggotaCount}][no_hp]" placeholder="Nomor HP Anggota">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-sm btn-danger hapus-anggota">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                `;
                return div;
            }

            // Tambah anggota baru
            tambahAnggotaBtn.addEventListener('click', function() {
                anggotaContainer.appendChild(createAnggotaField());
            });

            anggotaContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('hapus-anggota') || e.target.closest('.hapus-anggota')) {
                    const item = e.target.closest('.anggota-item');
                    if (item) {
                        item.remove();
                    }
                }
<<<<<<< HEAD

                // Tambah anggota baru
                tambahAnggotaBtn.addEventListener('click', function() {
                    anggotaContainer.appendChild(createAnggotaField());
                });
=======
            });
        });

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        @endif

        @if ($errors->any())
            let errorMessages = "";
            @foreach ($errors->all() as $error)
                errorMessages += "{{ $error }}\n";
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessages,
                confirmButtonColor: '#d33'
            });
        @endif
    </script>
    {{-- =======
>>>>>>> e98bfb4426354dbac02822d3731d483fcd36c4ae

                // Hapus anggota
                anggotaContainer.addEventListener('click', function(e) {
                    if (e.target.classList.contains('hapus-anggota') || e.target.closest('.hapus-anggota')) {
                        const item = e.target.closest('.anggota-item');
                        if (item) {
                            item.remove();
                        }
                    }
                });

                // Notifikasi
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        window.location.href = "{{ route('peserta.index') }}";
                    });
                @endif

                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Terdapat Kesalahan...',
                        text: '{{ session('error') }}',
                        confirmButtonColor: '#d33'
                    });
                @endif

                @if ($errors->any())
                    let errorMessages = "";
                    @foreach ($errors->all() as $error)
                        errorMessages += "{{ $error }}\n";
                    @endforeach

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessages,
                        confirmButtonColor: '#d33'
                    });
                @endif
            });
        </script>
    </body>
<<<<<<< HEAD
=======
>>>>>>> dac0b1e91c0534eb34b86f66032a77d5ab1ca621 --}}
>>>>>>> e98bfb4426354dbac02822d3731d483fcd36c4ae
@endsection
