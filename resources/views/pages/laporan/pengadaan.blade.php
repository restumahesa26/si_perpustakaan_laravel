<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Pengadaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        .logo-card {
            width: 90px;
            float: left;
            margin-left: 300px;
            margin-right: -1000px;
        }
        .clear {
            overflow: auto;
        }
        .title {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="title">
            <h4 class="text-center pt-2">DINAS PERPUSTAKAAN DAN KEARSIPAN</h4>
            <h4 class="text-center mb-4">PROVINSI BENGKULU</h4>
        </div>
    
        <div class="clear"></div>

        <hr style="border: 2px solid #000;">

        <h5 class="text-center mt-3">Laporan Pengadaan Buku</h5>

        <div class="row mt-3">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0" style="border: 1px #000 solid;">
                    <thead>
                        <tr class="text-center align-items-center">
                            <th style="border: 1px #000 solid;">No</th>
                            <th style="border: 1px #000 solid;">Tanggal</th>
                            <th style="border: 1px #000 solid;">Buku</th>
                            <th style="border: 1px #000 solid;">Asal Buku</th>
                            <th style="border: 1px #000 solid;">Jumlah Masuk</th>
                            <th style="border: 1px #000 solid;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @php
                        $no = 0;
                        @endphp
                        @forelse ($items as $item)
                        @php
                        $no++;
                        @endphp
                        <tr class="text-center align-items-center">
                            <th style="border: 1px #000 solid;">{{ $no }}</th>
                            <td style="border: 1px #000 solid;">{{ Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td style="border: 1px #000 solid;">{{ $item->buku->judul }}</td>
                            <td style="border: 1px #000 solid;">{{ $item->asal_buku }}</td>
                            <td style="border: 1px #000 solid;">{{ $item->jml_masuk }}</td>
                            <td style="border: 1px #000 solid;">{{ $item->keterangan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Data Kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>