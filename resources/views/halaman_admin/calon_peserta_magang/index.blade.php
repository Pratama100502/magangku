@extends('layouts.admin.app')

@section('title', 'Manajemen Pengajuan Peserta Magang')

@section('content')

    <body>
        <div class="container-fluid">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('calon.index') }}" method="GET" class="flex-grow-1 mr-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" name="nama" class="form-control" placeholder="Cari nama peserta..."
                                    value="{{ request('nama') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                </div>
                                @if (request('nama') || request('asal_sekolah') || request('jurusan'))
                                    <div class="input-group-append">
                                        <a href="{{ route('calon.index') }}" class="btn btn-outline-danger"
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
                                <th>Asal Sekolah</th>
                                <th>Jurusan</th>
                                <th>Total Anggota</th>
                                <th>Permohonan Magang</th>
                                <th>Proposal Proyek</th>
                                <th>Tanggal Magang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesertas as $index => $peserta)
                                <tr>
                                    <td>{{ $peserta->nama }}</td>
                                    <td>{{ $peserta->asal_sekolah }}</td>
                                    <td>{{ $peserta->jurusan }}</td>
                                    <td class="text-center">{{ $peserta->total_anggota }}</td>

                                    <td class="text-center">
                                        @if ($peserta->has_permohonan)
                                            @php
                                                $dokumen = $peserta->dokumen()->where(
                                                    'jenis_dokumen',
                                                    'permohonan_magang',
                                                )->first();
                                            @endphp
                                            <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank"
                                                class="btn btn-sm btn-link" title="Lihat Dokumen">
                                                <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                            </a>
                                        @else
                                            <span>Belum Upload</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($peserta->has_proposal)
                                            @php
                                                $dokumen = $peserta->dokumen()->where(
                                                    'jenis_dokumen',
                                                    'proposal_proyek',
                                                )->first();
                                            @endphp
                                            <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank"
                                                class="btn btn-sm btn-link" title="Lihat Dokumen">
                                                <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                            </a>
                                        @else
                                            <span>Belum Upload</span>
                                        @endif
                                    </td>
                                    <td>{{ $peserta->tanggal_mulai ? date('d F Y', strtotime($peserta->tanggal_mulai)) : '-' }}
                                        -
                                        {{ $peserta->tanggal_selesai ? date('d F Y', strtotime($peserta->tanggal_selesai)) : '-' }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('peserta.show', $peserta->id) }}" class="btn btn-info btn-sm"
                                                title="Show">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('peserta.edit', $peserta->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>


                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data pengajuan peserta magang</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <div class="d-flex justify-content-center">
                        {{ $pesertas->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // SweetAlert untuk konfirmasi perubahan status
                document.querySelectorAll('form[action*="update-status"]').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const action = this.getAttribute('action');
                        const status = this.querySelector('input[name="status"]').value;
                        const actionText = status === 'diterima' ? 'menerima' : 'menolak';

                        Swal.fire({
                            title: `Apakah Anda yakin ingin ${actionText} pengajuan ini?`,
                            text: "Perubahan status tidak dapat dibatalkan!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: `Ya, ${actionText}`,
                            cancelButtonText: 'Batal',
                            background: "#283a5ae6",
                            color: "#fff"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
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

                @if ($pesertas->isEmpty())
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data Kosong!',
                        text: 'Tidak ada data pengajuan yang tersedia.',
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
