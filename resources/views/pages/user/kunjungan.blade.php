@extends('layouts.home')

@section('title')
    <title>Home | Absen Kunjungan</title>
@endsection

@section('content')
    <main>
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-8 d-none d-md-block">
                    <img src="{{ url('frontend/images/ilustrasi-2.png') }}" alt="" class="img-illustration-2">
                </div>
                <div class="col-md-4 login-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('absen') }}">
                                @csrf
                                <div class="text-center mb-3 login-text">
                                    <h5>Isi Daftar Kunjungan</h5>
                                </div>
                                <div class="form-group">
                                    <label for="pengunjung_id" class="col-form-label">ID Anggota : </label>
                                    <select id="pengunjung_id" name="pengunjung_id" class="form-control" required>
                                        <option value="">Pilih ID Anggota</option>
                                        @foreach ($pengunjungs as $pengunjung)
                                        <option value="{{ $pengunjung->idPengunjung }}">
                                            {{ $pengunjung->idPengunjung }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group=">
                                    <label for="pass" class="col-form-label">Password : </label>
                                    <input type="password" class="form-control" id="pass" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="tujuan" class="col-form-label">Tujuan : </label>
                                    <select id="tujuan" class="form-control" name="tujuan">
                                        <option value="pinjam">Meminjam Buku</option>
                                        <option value="kembali">Mengembalikan Buku</option>
                                        <option value="baca">Membaca Buku</option>
                                        <option value="rekreasi">Rekreasi</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-daftar">
                                    Isi Absen
                                </button>
                                <a class="btn btn-link" href="{{ route('daftar') }}">
                                    Belum Jadi Anggota?
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('addon-script')

    @if (Session::get('success-daftar'))
        <script>
            swal("Berhasil Daftar Anggota", "Silakan ke Bagian Staf untuk Pembuatan Kartu", "success");
        </script>
    @endif

    @if (Session::get('error-absen-1'))
        <script>
            swal("Gagal Absen", "Hanya Boleh Maksimal 1x Absen", "error");
        </script>
    @endif

    @if (Session::get('error-absen-2'))
        <script>
            swal("Gagal Absen", "ID Anggota dan Password Tidak Cocok", "error");
        </script>
    @endif
@endpush