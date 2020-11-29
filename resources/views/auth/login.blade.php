@extends('layouts.home')

@section('title')
    <title>Login Admin</title>
@endsection

@section('content')
    <main>
        <div class="container my-4">
        
            <div class="row justify-content-center">
                <div class="col-md-8 d-none d-md-block">
                    <img src="{{ url('frontend/images/ilustrasi.png') }}" alt="" class="img-illustration">
                </div>
                <div class="col-md-4 login-card-1">
                    <div class="card">
                        <div class="card-body body-card">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="text-center mb-3 login-text">
                                    <h5>LOGIN</h5>
                                </div>
                                <div class="form-group">
                                    <label for="username">{{ __('NIP / Username') }}</label>
                                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group ml-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection