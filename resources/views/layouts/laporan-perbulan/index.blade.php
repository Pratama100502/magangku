@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Daftar Laporan Perbulan</h1>

    @if (count($files) > 0)
        <ul>
            @foreach ($files as $file)
                <li>{{ $file }}</li>
            @endforeach
        </ul>
    @else
        <p>Tidak ada laporan yang diunggah.</p>
    @endif
</div>
@endsection
