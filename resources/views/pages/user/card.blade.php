<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kartu Anggota</title>
    <link rel="stylesheet" href="{{ url('frontend/libraries/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/style/main.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Crimson+Text:ital@1&family=Fira+Sans:wght@300;400&family=Merienda:wght@700&display=swap" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container my-5">
            <div class="card card-width">
                <div class="card-body">
                    <img src="{{ url('frontend/images/logo.png') }}" alt="" class="logo-card">
                    <h5 class="text-center mt-1">KARTU ANGGOTA PERPUSTAKAAN</h5>
                    <h5 class="text-center pemprov">PEMPROV BENGKULU</h5>
                    <hr style="border: 1px solid #000;">
                    <img src="{{ url('frontend/images/user.png') }}" alt="" class="img-card">
                    <div class="clear-2"></div>
                    <div class="desc">
                        <span class="text-primary">ID Anggota&emsp;&ensp;&nbsp;</span>
                        <span class="text-primary">{{ $item->idPengunjung }}</span><br>
                        <span>Nama&emsp;&emsp;&emsp;&emsp;</span>
                        <span>{{ $item->nama }}</span><br>
                        <span>No Identitas&emsp;</span>
                        <span>{{ $item->no_idt }}</span><br>
                        <span>Jenis Kelamin&ensp;</span>
                        <span>@if ($item->jk == 'l')
                            Laki-Laki
                        @else
                            Perempuan
                        @endif</span><br>
                        <span>No. Telepon &emsp;</span>
                        <span>{{ $item->no_hp }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
<script src="{{ url('frontend/libraries/jquery/jquery-3.4.1.min.js') }}"></script>
<script src="{{ url('frontend/libraries/bootstrap/js/bootstrap.js') }}"></script>
</html>