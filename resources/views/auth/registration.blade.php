<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Magang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #5D636A; /* Abu-abu terang */
      color: #333;
    }

    .container {
      margin-top: 50px;
      background-color: #fff; /* Putih */
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-section {
      background-color: #5D636A; /* Abu-abu muda */
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .btn-light {
      background-color: #5D636A;
      color: #000;
    }

    .btn-light:hover {
      background-color: #d5d5d5;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2 class="text-center mb-4">Form Registrasi Anak Magang</h2>

    <form method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- Kolom Kiri -->
        <div class="col-md-6">
          <div class="form-section">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="form-section">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
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
            <label for="asal_kampus" class="form-label">Asal Kampus</label>
            <input type="text" class="form-control" name="asal_kampus" required>
          </div>
          <div class="form-section">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="jurusan" required>
          </div>
          <div class="form-section">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" name="nim" required>
          </div>
          <div class="form-section">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" class="form-control" name="no_hp" required>
          </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-md-6">
          <div class="form-section" id="anggota-container">
            <label class="form-label">Anggota Kelompok</label>
            <input type="text" class="form-control mb-2" name="anggota[]" placeholder="Nama Anggota">
            <input type="text" class="form-control" name="no_anggota[]" placeholder="No HP Anggota">
          </div>

          <button type="button" class="btn btn-outline-secondary btn-sm mb-3" id="add-anggota">➕ Tambah Anggota</button>

          <div class="form-section">
            <label for="keahlian" class="form-label">Keahlian</label>
            <input type="text" class="form-control" name="keahlian">
          </div>

          <div class="form-section">
            <label for="surat_permohonan" class="form-label">Upload Surat Permohonan</label>
            <input type="file" class="form-control" name="surat_permohonan" required>
          </div>

          <div class="form-section">
            <label for="surat_project" class="form-label">Upload Surat Rencana Project</label>
            <input type="file" class="form-control" name="surat_project" required>
          </div>
        </div>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-light">Register</button>
      </div>

      <div class="text-center mt-3">
        <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-dark">Log in</a></p>
      </div>
    </form>
  </div>

  <script>
    document.getElementById('add-anggota').addEventListener('click', function () {
      const container = document.getElementById('anggota-container');
      const group = document.createElement('div');
      group.classList.add('form-section');
      group.innerHTML = `
        <input type="text" class="form-control mb-2" name="anggota[]" placeholder="Nama Anggota">
        <input type="text" class="form-control" name="no_anggota[]" placeholder="No HP Anggota">
      `;
      container.appendChild(group);
    });
  </script>

</body>
</html>
