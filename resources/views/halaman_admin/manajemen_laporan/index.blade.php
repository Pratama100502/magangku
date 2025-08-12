@extends('layouts.admin.app')

@section('title', 'Manajemen Dokumen Peserta Magang')

@section('content')

    <body>
        <div class="container-fluid">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('dokumen.create') }}" class="btn btn-custom mr-3" title="Tambah Dokumen Peserta">
                            <i class="fa-solid fa-user-plus"></i>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('dokumen.index') }}" method="GET" class="flex-grow-1 mr-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" name="nama" class="form-control" placeholder="Cari nama peserta..."
                                    value="{{ request('nama') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                </div>
                                @if (request('nama'))
                                    <div class="input-group-append">
                                        <a href="{{ route('dokumen.index') }}" class="btn btn-outline-danger"
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
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Peserta</th>
                                <th>Permohonan Magang</th>
                                <th>Proposal Proyek</th>
                                <th>Laporan Bulanan</th>
                                <th>Laporan Akhir</th>
                                <th>Dokumen Lainnya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesertaMagang as $peserta)
                                <tr>
                                    <td>{{ $peserta->nama }}</td>

                                    <td class="text-center">
                                        @php
                                            $dok = $peserta->dokumen()->where('jenis_dokumen', 'permohonan_magang')->first();
                                        @endphp
                                        @if ($dok)
                                            <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank"
                                                class="btn btn-sm btn-link">
                                                <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @php
                                            $dok = $peserta->dokumen()->where('jenis_dokumen', 'proposal_proyek')->first();
                                        @endphp
                                        @if ($dok)
                                            <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank"
                                                class="btn btn-sm btn-link">
                                                <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @php
                                            $laporanBulanan = $peserta->dokumen()->whereIn('jenis_dokumen', [
                                                'laporan_bulan_1',
                                                'laporan_bulan_2',
                                                'laporan_bulan_3',
                                                'laporan_bulan_4',
                                                'laporan_bulan_5',
                                            ]);
                                        @endphp

                                        @if ($laporanBulanan->count() > 0)
                                            @foreach ($laporanBulanan as $dok)
                                                <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank"
                                                    class="btn btn-sm btn-link">
                                                    <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                                </a>
                                            @endforeach
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @php
                                            $dok = $peserta->dokumen()->where(
                                                'jenis_dokumen',
                                                'laporan_bulan_akhir',
                                            )->first();
                                        @endphp
                                        @if ($dok)
                                            <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank"
                                                class="btn btn-sm btn-link">
                                                <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @php
                                            $dokumensLainnya = $peserta->dokumen()->where('jenis_dokumen', 'lainnya');
                                        @endphp

                                        @if ($dokumensLainnya->count() > 0)
                                            @foreach ($dokumensLainnya as $dok)
                                                <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank"
                                                    class="btn btn-sm btn-link">
                                                    <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                                </a>
                                            @endforeach
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        <form action="{{ route('dokumen.destroy.all') }}" method="POST" class="d-inline delete-all-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-all-btn"
                                                title="Hapus Semua Dokumen">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <div class="d-flex justify-content-center">
                        {{ $pesertaMagang->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // SweetAlert untuk konfirmasi penghapusan semua dokumen
                document.querySelectorAll('.delete-all-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        let form = this.closest('.delete-all-form');
                        Swal.fire({
                            title: "Apakah Anda yakin?",
                            text: "SEMUA dokumen akan dihapus dan tidak dapat dikembalikan!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Ya, hapus semua!",
                            background: "#283a5ae6",
                            color: "#fff"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
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

                @if ($pesertaMagang->isEmpty())
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Kosong!',
                        text: 'Tidak ada data peserta yang tersedia.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        color: "#fff",
                        background: "#283a5ae6"
                    });
                @endif
            });
        </script>
    </body>
@endsection
