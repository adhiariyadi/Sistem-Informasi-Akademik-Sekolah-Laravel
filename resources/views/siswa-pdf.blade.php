<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shrotcut icon" href="{{ asset('img/favicon.ico') }}">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <table class="table table-bordered table-striped table-hover" width="100%">
                <thead>
                    <tr>
                        <th colspan="4" class="text-center">Daftar Murid Kelas {{ $kelas->nama_kelas }}</th>
                    </tr>
                    <tr>
                        <th>No. Induk</th>
                        <th>Nama Siswa</th>
                        <th>L/P</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $data)
                        <tr>
                            <td>{{ $data->no_induk }}</td>
                            <td>{{ $data->nama_siswa }}</td>
                            <td>{{ $data->jk }}</td>
                            <td><img src="{{ asset($data->foto) }}" width="100" alt=""></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-center"><strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> :: <a href="">SMK Negeri 1 Jenangan Ponorogo</a>. </strong></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>
