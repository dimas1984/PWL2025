@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Kategori</h3>
        </div>
        <div class="card-body">
        <form action="{{ url('/kategori') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kode Kategori</label>
                <input value="{{ old('kategori_kode') }}" type="text" name="kategori_kode" id="kategori_kode" class="form-control" required>
                @error('kategori_kode')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Nama Kategori</label>
                <input value="{{ old('kategori_nama') }}" type="text" name="kategori_nama" id="kategori_nama" class="form-control" required>
                @error('kategori_nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('/kategori') }}" class="btn btn-warning">Kembali</a>
            </div>
        </form>
        </div>
    </div>
@endsection

@push('js')
@endpush
