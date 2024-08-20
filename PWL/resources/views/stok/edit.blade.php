@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah User</h3>
        </div>
        <div class="card-body">
        @empty($user)
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                Data yang anda cari tidak ditemukan</div>
            <a href="{{ url('/kategori') }}" class="btn btn-warning">Kembali</a>
        @else
            <form action="{{ url('/user/' . $user->user_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Level Pengguna</label>
                    <select name="level_id" id="level_id" class="form-control" required>
                        <option value="">- Pilih Level -</option>
                        @foreach($level as $l)
                            <option {{ ($l->level_id == $user->level_id)? 'selected' : '' }} value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                        @endforeach
                    </select>
                    @error('level_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input value="{{ old('username', $user->username) }}" type="text" name="username" id="username" class="form-control" required>
                    @error('username')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input value="{{ old('nama', $user->nama) }}" type="text" name="nama" id="nama" class="form-control" required>
                    @error('nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        @endempty
        </div>
    </div>
@endsection

@push('js')
@endpush
