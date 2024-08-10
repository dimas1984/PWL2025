<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form-Pendaftaran</title>
</head>
<body>
    <h1> Pendaftaran Anggota</h1>
    {{-- <form action="{{url('/proses-form')}}" method="get"> --}}
        <form action="{{url('/proses-form')}}" method="post">
            @csrf
        <div class="mb3">
            <label for="nip">nip</label>
            <input type="text" id="nip" name="nip">
        </div>
        <div class="mb3">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama">
        </div>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>
