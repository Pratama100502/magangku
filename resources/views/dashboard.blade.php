<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Magang Kominfo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
      body {
        background-color: #f2f4f7;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      .dashboard-header {
        background-color: #0b5ed7;
        color: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
      }

      .card-info {
        border-left: 5px solid #0b5ed7;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
      }

      .card-info:hover {
        transform: scale(1.02);
      }

      .logout-link {
        color: white;
        text-decoration: underline;
        font-size: 0.9rem;
      }
    </style>
  </head>
<body>

<main>
  <div class="container py-4">

    <!-- Header -->
    <div class="dashboard-header d-flex justify-content-between align-items-center">
      <div>
        <h2>Sistem Informasi Magang Kominfo</h2>
        <p class="mb-0">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
      </div>
      <div>
        <a class="logout-link" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </div>
    </div>

    <!-- Session Flash -->
    @if(session('success'))
      <div class="alert alert-success mt-3">
        {{ session('success') }}
      </div>
    @endif

    <!-- Info Cards -->
    <div class="row g-4 mt-2">
      <div class="col-md-4">
        <div class="card card-info p-3">
          <h5>Data Pendaftar</h5>
          <p>Lihat dan kelola data pendaftar magang Kominfo.</p>
          <a href="#" class="btn btn-sm btn-outline-primary">Lihat Data</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-info p-3">
          <h5>Upload Dokumen</h5>
          <p>Unggah surat permohonan dan rencana project magang.</p>
          <a href="#" class="btn btn-sm btn-outline-primary">Upload</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-info p-3">
          <h5>Rekap Magang</h5>
          <p>Monitoring status dan hasil kegiatan magang peserta.</p>
          <a href="#" class="btn btn-sm btn-outline-primary">Lihat Rekap</a>
        </div>
      </div>
    </div>

    <!-- Hero Section -->
    <div class="p-5 mt-4 bg-white rounded shadow">
      <h3 class="fw-bold">Kenali Sistem Ini Lebih Dekat</h3>
      <p>Sistem ini membantu Kominfo mengelola data peserta magang dengan mudah dan efisien. Dari pendaftaran hingga pelaporan akhir, semua bisa dilakukan secara digital.</p>
      <a href="#" class="btn btn-primary btn-lg">Pelajari Lebih Lanjut</a>
    </div>

  </div>
</main>

</body>
</html>
