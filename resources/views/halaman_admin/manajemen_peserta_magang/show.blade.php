@extends('layouts.admin.app')

@section('title', 'Detail Peserta Magang')

@section('content')
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detail Peserta Magang</h3>
                            <div class="card-tools">
                                <a href="{{ route('peserta.edit', $peserta->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Informasi Utama</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Nama</th>
                                            <td>{{ $peserta->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIM</th>
                                            <td>{{ $peserta->nim ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $peserta->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor HP</th>
                                            <td>{{ $peserta->no_hp ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Asal Sekolah/Universitas</th>
                                            <td>{{ $peserta->asal_sekolah ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jurusan</th>
                                            <td>{{ $peserta->jurusan ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h4>Informasi Magang</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Status</th>
                                            <td>
                                                @switch($peserta->status)
                                                    @case('mengajukan')
                                                        <span class="badge badge-warning">Mengajukan</span>
                                                    @break

                                                    @case('diterima')
                                                        <span class="badge badge-primary">Diterima</span>
                                                    @break

                                                    @case('diterima_dan_loa_dapat_di_ambil')
                                                        <span class="badge badge-info">Diterima & LOA siap diambil</span>
                                                    @break

                                                    @case('aktif')
                                                        <span class="badge badge-success">Aktif</span>
                                                    @break

                                                    @case('selesai')
                                                        <span class="badge badge-secondary">Selesai</span>
                                                    @break

                                                    @case('ditolak')
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    @break
                                                @endswitch
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mentor</th>
                                            <td>{{ $peserta->mentor->nama ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Mulai</th>
                                            <td>{{ $peserta->tanggal_mulai ? date('d F Y', strtotime($peserta->tanggal_mulai)) : '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Selesai</th>
                                            <td>{{ $peserta->tanggal_selesai ? date('d F Y', strtotime($peserta->tanggal_selesai)) : '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Catatan</th>
                                            <td>{{ $peserta->catatan ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            @if ($peserta->anggota->isNotEmpty())
                                <hr>
                                <h4>Anggota Magang</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anggota</th>
                                                <th>Nomor HP</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($peserta->anggota as $index => $anggota)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $anggota->nama_anggota }}</td>
                                                    <td>{{ $anggota->no_hp_anggota ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('peserta.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
