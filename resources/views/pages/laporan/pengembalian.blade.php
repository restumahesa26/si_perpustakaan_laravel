<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Pengembalian</title>
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

        <h5 class="text-center mt-3">Laporan Pengembalian</h5>

        <div class="row mt-3">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center align-items-center">
                            <th>No</th>
                            <th>Nama</th>
                            <td>Buku</td>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Perpanjang</th>
                            <th>Tgl Pengembalian</th>
                            <th>Tgl Kembali</th>
                            <th>Denda</th>
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
                        <tr class="align-items-center">
                            <th class="text-center">{{ $no }}</th>
                            <td class="text-center">{{ $item->pengunjung->nama }}</td>
                            <td><ul>
                                @foreach ($item->buku as $itemx)
                                    <li>{{ $itemx->judul }}</li>
                                @endforeach
                            </ul></td>
                            <td class="text-center">{{ Carbon\Carbon::parse($item->tgl_pinjam)->format('d-m-Y') }}</td>
                            <td class="text-center">@if ($item->tgl_panjang == NULL)
                                    -
                                @else
                                {{ Carbon\Carbon::parse($item->tgl_panjang)->format('d-m-Y') }}
                                @endif</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($item->tgl_pengembalian)->format('d-m-Y') }}</td>
                            <td class="text-center">{{ Carbon\Carbon::parse($item->tgl_kembali)->format('d-m-Y') }}</td>
                            <td class="text-center">@if (rupiahFormat($item->denda) == 'Rp. 0,-')
                                -
                            @else
                                {{ rupiahFormat($item->denda) }}
                            @endif</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
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