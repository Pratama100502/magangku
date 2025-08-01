@extends('layouts.admin.app')

@section('title', 'Manajemen Peserta Magang')

@section('content')

    <body>
        <div class="container-xl">
            <section class="content">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Filter dan Pencarian</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('peserta.index') }}" method="GET">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nama">Nama Peserta</label>
                                                    <input type="text" name="nama" id="nama" class="form-control"
                                                        placeholder="Cari nama..." value="{{ request('nama') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="aktif"
                                                            {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif
                                                        </option>
                                                        <option value="semua"
                                                            {{ request('status') == 'semua' ? 'selected' : '' }}>Semua
                                                            Status</option>
                                                        <option value="mengajukan"
                                                            {{ request('status') == 'mengajukan' ? 'selected' : '' }}>
                                                            Mengajukan</option>
                                                        <option value="diterima"
                                                            {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima
                                                        </option>
                                                        <option value="diterima_dan_loa_dapat_di_ambil"
                                                            {{ request('status') == 'diterima_dan_loa_dapat_di_ambil' ? 'selected' : '' }}>
                                                            Diterima dan LOA dapat di ambil</option>
                                                        <option value="selesai"
                                                            {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                                        </option>
                                                        <option value="ditolak"
                                                            {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                                        class="form-control" value="{{ request('tanggal_mulai') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                                    <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                                        class="form-control" value="{{ request('tanggal_selesai') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3 d-flex align-items-end">
                                                <div class="form-group mb-0 w-100">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fas fa-filter mr-1"></i> Filter
                                                    </button>
                                                    <a href="{{ route('peserta.index') }}"
                                                        class="btn btn-danger btn-block mt-2">
                                                        <i class="fas fa-sync-alt mr-1"></i> Reset
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col-md-6">
                                        <a href="{{ route('peserta.create') }}" class="btn btn-custom mr-3"
                                            title="Tambah Peserta Magang">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Sekolah</th>
                                                    <th>Jurusan</th>
                                                    <th>Mentor</th>
                                                    <th>Status</th>
                                                    <th>Anggota</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pesertas as $peserta)
                                                    <tr>
                                                        <td>{{ $peserta->nama }}</td>
                                                        <td>{{ $peserta->asal_sekolah }}</td>
                                                        <td>{{ $peserta->jurusan }}</td>
                                                        <td>{{ $peserta->mentor->nama ?? '-' }}</td>
                                                        <td>{{ ucwords(str_replace('_', ' ', $peserta->status)) }}</td>
                                                        <td>{{ $peserta->anggota->count() }}</td>
                                                        <td>
                                                            <a href="{{ route('peserta.show', $peserta->id) }}"
                                                                class="btn btn-info btn-sm" title="Show">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('peserta.edit', $peserta->id) }}"
                                                                class="btn btn-warning btn-sm" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('peserta.destroy', $peserta->id) }}"
                                                                method="POST" class="d-inline delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger delete-btn" title="Delete"
                                                                    data-id="{{ $peserta->id }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">Tidak ada data peserta
                                                            magang.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer clearfix">
                                    <div class="float-right">
                                        {{ $pesertas->onEachSide(1)->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // SweetAlert untuk konfirmasi penghapusan data
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        let form = this.closest('.delete-form');
                        Swal.fire({
                            title: "Apakah Anda yakin?",
                            text: "Anda akan menghapus data peserta, anggota, dokumen, dan data yang dihapus tidak dapat dikembalikan!",
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
            @if ($pesertas->isEmpty())
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Kosong!',
                    text: 'Tidak ada data peserta magang yang tersedia.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    color: "#fff",
                    background: "#283a5ae6"
                });
            @endif
        </script>
    </body>
@endsection
