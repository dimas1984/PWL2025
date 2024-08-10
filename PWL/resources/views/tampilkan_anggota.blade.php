<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Ini cdn css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Data Anggota</title>
</head>

<body>
    <div class="container text-center p-4">
        <h1 class="mb-3">Data anggota</h1>
        <div class="row">
            <div class="m-auto">
                <ol class="list-group">
                    @forelse ($anggotas as $anggota)
                        <li class="list-group-item">
                            {{ $anggota->nama }} ({{ $anggota->nip }}),
                            Tanggal Lahir: {{ $anggota->tanggal_lahir }},
                            Nilai: {{ $anggota->nilai }}
                        </li>
                    @empty
                        <div class="alert alert-dark d-inline-block">Tidak ada data...</div>
                    @endforelse
                </ol>
            </div>
        </div>
    </div>
</body>

</html>
