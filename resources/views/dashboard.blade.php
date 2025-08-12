<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Referensi Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        background-color: #c1c5c7;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      .sidebar {
        height: 100vh;
        background-color: #545d5f;
        color: white;
        padding-top: 20px;
        position: fixed;
        width: 220px;
      }

      .sidebar a {
        color: white;
        display: block;
        padding: 10px 20px;
        text-decoration: none;
      }

      .sidebar a:hover {
        background-color: #3d4344;
        text-decoration: none;
      }

      .content {
        margin-left: 220px;
        padding: 20px;
      }

      .logout-bar {
        background-color: #fff;
        padding: 10px 20px;
        border-bottom: 1px solid #ccc;
      }

      .card-upload {
        background-color: #707c7e;
        color: white;
        text-align: center;
        padding: 30px 20px;
        border-radius: 8px;
      }

      .card-upload:hover {
        background-color: #5c6768;
      }

      .table thead {
        background-color: #dee2e6;
      }
    </style>
  </head>
  <body>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="text-center mb-4">
        <img src="https://img.icons8.com/ios-filled/50/ffffff/user-male-circle.png"/>
        <div class="mt-2">User</div>
      </div>
      <a href="#">🏠 Dashboard</a>
      <a href="#">📄 Referensi Project</a>
      <a href="{{ route('laporan.index') }}">📁 Laporan Perbulan</a>
      <a href="#">📝 Laporan Akhir</a>
    </div>

    <!-- Content -->
    <div class="content">
      <div class="logout-bar d-flex justify-content-between align-items-center">
        <button class="btn btn-outline-secondary">&#9776;</button>
        <a href="#" class="btn btn-outline-danger btn-sm">Logout</a>
      </div>

      <!-- Upload Card -->
      <div class="mt-4">
        <div class="card-upload">
          <img src="https://img.icons8.com/ios-filled/50/ffffff/upload.png"/>
          <p class="mt-2 mb-0">Upload Referensi Project</p>
        </div>
      </div>

      <!-- Upload Form -->
      <div class="mt-4 bg-white p-4 rounded shadow">
        <h5 class="mb-3">Upload Referensi Project</h5>

        <form action="{{ route('referensi.upload') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="file" class="form-label">Pilih File (PDF)</label>
            <input type="file" name="file" class="form-control" accept="application/pdf" required>
          </div>
          <button type="submit" class="btn btn-success">Upload</button>
        </form>
      </div>

      <!-- Table -->
      <div class="mt-4 bg-white p-4 rounded shadow">
        <h5 class="mb-3">Daftar Referensi Project</h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama File</th>
              <th>Tanggal Upload</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>referensi_1.pdf</td>
              <td>01-08-2025</td>
              <td>
                <a href="#" class="btn btn-sm btn-primary">Download</a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>referensi_2.pdf</td>
              <td>03-08-2025</td>
              <td>
                <a href="#" class="btn btn-sm btn-primary">Download</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Tombol ke halaman Laporan Perbulan -->
      <div class="mt-4">
        <a href="{{ route('laporan.index') }}" class="btn btn-success">
            📁 Lihat Laporan Perbulan
        </a>
      </div>
    </div> <!-- end content -->

  </body>
</html>
