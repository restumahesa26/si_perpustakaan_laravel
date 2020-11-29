@extends('layouts.home')

@section('title')
    <title>Home | Daftar Anggota</title>
@endsection

@section('content')
    <main>
        <div class="container my-4">
            @if ($errors->count() > 0)
                @php
                Alert::error('Gagal Mengubah Data', 'Masih Terdapat Data Belum Valid');
                @endphp
            @endif
            <div class="row justify-content-center">
                <div class="col-md-6 d-none d-md-block">
                    <img src="{{ url('frontend/images/ilustrasi-3.png') }}" alt="" class="img-illustration-3">
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('daftar-anggota') }}" class="form">
                                @csrf
                                @method('GET')
                                <div class="text-center mb-3 login-text">
                                    <h5>Daftar sebagai Anggota</h5>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group=">
                                    <label for="no_idt" class="col-form-label">Nomor Identitas <sup>* KTP, KTM, KTS, dll</sup></label>
                                    <input id="no_idt" type="text" class="form-control @error('no_idt') is-invalid @enderror" name="no_idt" placeholder="Nomor Identitas" value="{{ old('no_idt') }}">
                                    @error('no_idt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password <sup>* min 8</sup></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ old('password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jk" class="col-form-label">Jenis Kelamin</label>
                                    <select id="jk" name="jk" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="l" @if ( old('jk') == 'l' )
                                            selected
                                        @endif >Laki-Laki</option>
                                        <option value="p" @if ( old('jk') == 'p' )
                                            selected
                                        @endif >Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group=">
                                    <label for="no_hp" class="col-form-label">No Handphone <sup>* No.WA / No.Telepon</sup> </label>
                                    <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="No Telepon" value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="col-form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" rows="3" name="alamat" placeholder="Alamat Lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-daftar">
                                    Daftar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection