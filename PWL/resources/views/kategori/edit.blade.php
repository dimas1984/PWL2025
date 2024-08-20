@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Kategori</h3>
        </div>
        <div class="card-body">
        @if(empty($kategori)) {{-- jika data tidak ditemukan --}}
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                Data yang anda cari tidak ditemukan</div>
            <a href="{{ url('/kategori') }}" class="btn btn-warning">Kembali</a>
        @else
            <form action="{{ url('/kategori/' . $kategori->kategori_id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Kode Kategori</label>
                    <input value="{{ old('kategori_kode', $kategori->kategori_kode) }}" type="text" name="kategori_kode" id="kategori_kode" class="form-control" required>
                    @error('kategori_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input value="{{ old('kategori_nama', $kategori->kategori_nama) }}" type="text" name="kategori_nama" id="kategori_nama" class="form-control" required>
                    @error('kategori_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/kategori') }}" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        @endif
        </div>
    </div>
@endsection

@push('js')
@endpush
