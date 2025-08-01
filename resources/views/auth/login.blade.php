<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Magang Kominfo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #ffffff;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
    }

    .login-box {
      background-color: white;
      display: flex;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0px 0px 15px rgba(0,0,0,0.3);
      max-width: 900px;
      width: 100%;
    }

    .login-form {
      padding: 40px 30px;
      flex: 1;
    }

    .login-form h5 {
      font-weight: bold;
      margin-bottom: 20px;
    }

    .login-img {
      flex: 1;
      background-size: cover;
      background-position: center;
    }

    .form-label {
      font-weight: bold;
    }

    .login-title {
      color: rgb(0, 0, 0);
      font-weight: bold;
      font-size: 24px;
      text-align: center;
      margin-bottom: 30px;
    }

    .avatar {
      width: 60px;
      margin: 0 auto 20px;
      display: block;
    }
  </style>
</head>
<body>

  <div class="container login-container">
    <div class="w-100">
      <div class="login-title">Sistem Informasi Manajemen Anak Magang Kominfo</div>

      <div class="login-box mx-auto">
        <!-- Left - Form -->
        <div class="login-form">
          <h5 class="text-center mb-4">Login</h5>

          <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="avatar" class="avatar">

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" required autofocus>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>

            <p class="mt-3 text-center text-muted">
              Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </p>
          </form>
        </div>

        <!-- Right - Image -->
        <div class="login-img d-none d-md-block" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e');">
          {{-- Bisa ganti gambar ini dengan asset sendiri --}}
        </div>
      </div>
    </div>
  </div>

</body>
</html>
