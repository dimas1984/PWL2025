@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Kategori</h3>
        </div>
        <div class="card-body">
        @empty($kategori) {{-- jika data tidak ditemukan --}}
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan Method!!!</h5>
                Data yang anda cari tidak ditemukan.</div>
            <a href="{{ url('/kategori') }}" class="btn btn-warning">Kembali</a>
        @else
            <table class="table table-bordered table-sm table-hover table-striped mb-2">
                <tr>
                    <th>ID Kategori</th>
                    <td>{{ $kategori->kategori_id }}</td>
                </tr>
                <tr>
                    <th>Kode Kategori</th>
                    <td>{{ $kategori->kategori_kode }}</td>
                </tr>
                <tr>
                    <th>Nama Kategori</th>
                    <td>{{ $kategori->kategori_nama }}</td>
                </tr>
                <tr>
                    <th>Tanggal dibuat</th>
                    <td>{{ $kategori->created_at }}</td>
                </tr>
                <tr>
                    <th>Tanggal diupdate</th>
                    <td>{{ $kategori->updated_at }}</td>
                </tr>
            </table>
            <a href="{{ url('/kategori') }}" class="btn btn-warning">Kembali</a>
        @endempty
        </div>
    </div>
@endsection

@push('js')
@endpush
