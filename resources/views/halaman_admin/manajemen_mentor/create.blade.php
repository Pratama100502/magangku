@extends('layouts.admin.app')

@section('title', 'Tambah Mentor Baru')

@section('content')
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Mentor</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('mentor.store') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="nama">Nama Mentor</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" placeholder="Masukkan nama mentor"
                                        value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Masukkan email mentor"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">Nomor Hp</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" name="no_hp" placeholder="Masukkan nomor hp"
                                        value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="bidang">Bidang</label>
                                    <input type="text" class="form-control @error('bidang') is-invalid @enderror"
                                        id="bidang" name="bidang" placeholder="Masukkan bidang"
                                        value="{{ old('bidang') }}">
                                    @error('bidang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Masukkan password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('mentor.index') }}" class="btn btn-secondary float-right">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = "{{ route('mentor.index') }}";
                });
            @endif

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
        });
    </script>
@endsection
