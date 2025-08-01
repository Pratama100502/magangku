@extends('layouts.admin.app')

@section('title', 'Upload Dokumen')

@section('content')

    <body>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Upload Dokumen Peserta Magang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="peserta_id">Nama Peserta</label>
                        <select name="peserta_id" class="form-control" required>
                            <option value="">-- Pilih Peserta --</option>
                            @foreach ($pesertaMagang as $peserta)
                                <option value="{{ $peserta->id }}">{{ $peserta->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jenis_dokumen">Jenis Dokumen</label>
                        <select name="jenis_dokumen" class="form-control" required>
                            <option value="">-- Pilih Jenis Dokumen --</option>
                            @foreach ($jenisDokumen as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file">Upload File (PDF)</label>
                        <input type="file" name="file" class="form-control-file" accept="application/pdf" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        window.location.href = "{{ route('dokumen.index') }}";
                    });
                @endif

                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Peringatan',
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
    </body>
@endsection
