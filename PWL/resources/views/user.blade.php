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
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
        </tr>
        @foreach ($dat as $d)
        <tr>
            <td> {{$d->user_id}}</td>
            <td> {{$d->username}}</td>
            <td> {{$d->nama}}</td>
            <td> {{$d->level_id}}</td>
        </tr>

        @endforeach
    </table>
</body>
</html>
