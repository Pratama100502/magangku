<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Peserta Magang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .container {
            max-width: 950px;
            margin-top: 50px;
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-section label {
            font-weight: 600;
        }

        .btn-dark {
            background-color: #343a40;
            border: none;
        }

        .btn-dark:hover {
            background-color: #23272b;
        }

        .anggota-item {
            padding: 15px;
            background: #f1f1f1;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .bi {
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">Form Registrasi Peserta Magang</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">

                    @foreach ([
                        'nama' => 'Nama',
                        'email' => 'Email',
                        'asal_sekolah' => 'Asal Sekolah/Kampus',
                        'jurusan' => 'Jurusan',
                        'nim' => 'NIM',
                        'no_hp' => 'No HP',
                    ] as $name => $label)
                        <div class="form-section">
                            <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                            <input type="{{ $name === 'email' ? 'email' : 'text' }}" class="form-control"
                                name="{{ $name }}" value="{{ old($name) }}" required>
                        </div>
                    @endforeach

                    <div class="form-section">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-section">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>

                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">

                    <div class="form-section">
                        <label class="form-label">Anggota</label>
                        <div id="anggota-container">
                            <div class="anggota-item">
                                <input type="text" class="form-control mb-2" name="nama_anggota[]" placeholder="Nama Anggota" required>
                                <input type="text" class="form-control" name="no_hp_anggota[]" placeholder="No HP Anggota" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm mt-2" id="add-anggota">
                            <i class="bi bi-plus-circle"></i> Tambah Anggota
                        </button>
                    </div>

                    <div class="form-section">
                        <label for="surat_permohonan" class="form-label">Upload Surat Permohonan</label>
                        <input type="file" class="form-control" name="surat_permohonan" required>
                    </div>

                    <div class="form-section">
                        <label for="proposal_proyek" class="form-label">Upload Rencana Proyek</label>
                        <input type="file" class="form-control" name="proposal_proyek" required>
                    </div>

                    <div class="form-section">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                    </div>

                    <div class="form-section">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                    </div>

                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-dark px-5">Daftar</button>
            </div>

            <div class="text-center mt-3">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-dark">Login di sini</a></p>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-anggota').addEventListener('click', function () {
            const container = document.getElementById('anggota-container');
            const group = document.createElement('div');
            group.classList.add('anggota-item');
            group.innerHTML = `
                <input type="text" class="form-control mb-2 mt-2" name="nama_anggota[]" placeholder="Nama Anggota" required>
                <input type="text" class="form-control" name="no_hp_anggota[]" placeholder="No HP Anggota" required>
            `;
            container.appendChild(group);
        });
    </script>

</body>

</html>
