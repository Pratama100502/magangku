<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMAMKOM - Sistem Informasi Anak Magang Kominfo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('{{ asset('images/sunset.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: white;
      height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.5);
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      z-index: 1;
    }

    .hero {
      position: relative;
      z-index: 2;
      text-align: center;
      padding: 100px 20px;
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: bold;
    }

    .hero p {
      font-size: 1.2rem;
      margin-top: 10px;
    }

    .navbar-custom {
      position: relative;
      z-index: 2;
      padding: 20px 30px;
    }

    .footer {
      text-align: center;
      position: relative;
      z-index: 2;
      padding: 20px;
      font-size: 0.9rem;
      color: #ccc;
    }

    .btn-outline-light {
      border-color: #fff;
      color: #fff;
      border-radius: 25px;
      padding: 8px 20px;
    }

    .btn-outline-light:hover {
      background-color: #fff;
      color: #333;
    }
  </style>
</head>
<body>

  <div class="overlay"></div>

  <nav class="navbar-custom d-flex justify-content-between align-items-center">
    <div class="text-white fw-bold fs-4">MAGANGYUK</div>
    <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
  </nav>

  <div class="hero">
    <h1>Sistem Informasi Manajemen<br>Anak Magang KOMINFO</h1>
    <p>Kelola data anak magang secara efektif dan efisien</p>
    <a href="{{ route('login') }}" class="btn btn-outline-light mt-4">Masuk Sekarang</a>
  </div>

  <footer class="footer">
    © {{ date('Y') }} MAGANGYUK – Kominfo Indonesia
  </footer>

</body>
</html>
