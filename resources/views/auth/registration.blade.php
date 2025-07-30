<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi Peserta Magang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #5D636A;
    }
    .container {
      margin-top: 50px;
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-section {
      background-color: #e9ecef;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
    }
    .btn-dark {
      background-color: #5D636A;
      border: none;
    }
    .btn-dark:hover {
      background-color: #495057;
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

          <div class="form-section">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
          </div>

          <div class="form-section">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
          </div>

          <div class="form-section">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>

          <div class="form-section">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
          </div>

          <div class="form-section">
            <label for="asal_sekolah" class="form-label">Asal Sekolah/Kampus</label>
            <input type="text" class="form-control" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required>
          </div>

          <div class="form-section">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="jurusan" value="{{ old('jurusan') }}" required>
          </div>

          <div class="form-section">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" name="nim" value="{{ old('nim') }}" required>
          </div>

          <div class="form-section">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp') }}" required>
          </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
          <div class="form-section" id="anggota-container">
            <label class="form-label">Anggota</label>
            <div class="anggota-item">
              <input type="text" class="form-control mb-2" name="nama_anggota[]" placeholder="Nama Anggota" required>
              <input type="text" class="form-control" name="no_hp_anggota[]" placeholder="No HP Anggota" required>
            </div>
          </div>

          <button type="button" class="btn btn-outline-secondary btn-sm mb-3" id="add-anggota">➕ Tambah Anggota</button>

          <div class="form-section">
            <label for="surat_permohonan" class="form-label">Upload Surat Permohonan</label>
            <input type="file" class="form-control" name="surat_permohonan" required>
          </div>

          <div class="form-section">
            <label for="proposal_proyek" class="form-label">Upload Rencana Proyek</label>
            <input type="file" class="form-control" name="proposal_proyek" required>
          </div>
        </div>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-dark">Daftar</button>
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
