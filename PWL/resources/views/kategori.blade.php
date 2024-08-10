<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>menampilkan data Level</title>
</head>
<body>
    <h1> Data Level Pengguna</h1>
    <table border="1" cellpadding="2" cellspacing="2">
        <tr>
            <th>ID</th>
            <th>Kategori kode</th>
            <th>Kategori Nama</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td> {{$d->kategori_id}}</td>
            <td> {{$d->kategori_kode}}</td>
            <td> {{$d->kategori_nama}}</td>
        </tr>

        @endforeach
    </table>
</body>
</html>
