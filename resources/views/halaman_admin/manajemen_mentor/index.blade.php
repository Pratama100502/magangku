@extends('layouts.admin.app')

@section('title', 'Manajemen mentor')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Mentor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Mentor</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('mentor.create') }}" class="btn btn-custom mr-3"
                                        title="Tambah Mentor">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('mentor.index') }}" method="GET" class="flex-grow-1 mr-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Cari nama mentor..." value="{{ request('nama') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                            </div>
                                            @if (request('nama'))
                                                <div class="input-group-append">
                                                    <a href="{{ route('mentor.index') }}" class="btn btn-outline-danger"
                                                        title="Reset pencarian">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Mentor</th>
                                        <th>No HP</th>
                                        <th>Email</th>
                                        <th>Bidang</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mentors as $mentor)
                                        <tr>
                                            <td>{{ $mentor->nama }}</td>
                                            <td>{{ $mentor->no_hp }}</td>
                                            <td>{{ $mentor->email }}</td>
                                            <td>{{ $mentor->bidang }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('mentor.edit', $mentor->id) }}"
                                                    class="btn btn-sm btn-warning text-white" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('mentor.destroy', $mentor->id) }}" method="POST"
                                                    class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                        title="Delete" data-id="{{ $mentor->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <div class="alert alert-info">
                                                    <i class="icon fas fa-info"></i> Tidak ada data mentor yang tersedia.
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div class="float-right">
                                {{ $mentors->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert untuk konfirmasi penghapusan data
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let form = this.closest('.delete-form');
                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, hapus!",
                        background: "#283a5ae6", // Warna background
                        color: "#fff" // Warna teks agar tetap terbaca
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit form jika dikonfirmasi
                        }
                    });
                });

                // SweetAlert jika data pencarian tidak ditemukan
                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR',
                        text: "{{ session('error') }}",
                        background: "#283a5ae6",
                        color: "#fff"
                    });
                @endif
            });
            @if ($mentors->isEmpty())
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Kosong!',
                    text: 'Tidak ada data mentor yang tersedia.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    color: "#fff",
                    background: "#283a5ae6"
                });
            @endif
        });
    </script>
@endsection
