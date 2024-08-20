@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah User</h3>
        </div>
        <div class="card-body">
        <form action="{{ url('/user') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Level Pengguna</label>
                <select name="level_id" id="level_id" class="form-control" required>
                    <option value="">- Pilih Level -</option>
                    @foreach($level as $l)
                        <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                    @endforeach
                </select>
                @error('kategori_kode')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Username</label>
                <input value="{{ old('username') }}" type="text" name="username" id="username" class="form-control" required>
                @error('username')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input value="{{ old('nama') }}" type="text" name="nama" id="nama" class="form-control" required>
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input value="{{ old('password') }}" type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
            </div>
        </form>
        </div>
    </div>
@endsection

@push('js')
@endpush
    