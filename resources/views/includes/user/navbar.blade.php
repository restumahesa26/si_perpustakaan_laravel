<div class="container">
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand" href="#">
            <img src="{{ url('frontend/images/logo.png') }}">
        </a>
        <h5>Pemerintah Provinsi Bengkulu</h5>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse font-weight-light" id="navb">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a href="{{ route('buku') }}" class="nav-link" id="pengurus_a">Daftar Buku</a>
                </li>
                <li class="nav-item mr-4 ml-2">
                    <a href="{{ route('about-us') }}" class="nav-link" id="divisi_a">About Us</a>
                </li>
            </ul>
            @guest
            <form class="form-inline d-sm-block d-md-none" action="{{ route('dashboard') }}">
                <button class="btn btn-login my-2 my-sm-0">
                    Login
                </button>
            </form>

            <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{ route('dashboard') }}">
                <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
                    Login
                </button>
            </form>
            @endguest

            @auth
            <form class="form-inline d-sm-block d-md-none" action="{{ route('logout') }}" method="POST">
            @csrf
                <button class="btn btn-login my-2 my-sm-0">
                    Logout
                </button>
            </form>

            <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{ route('logout') }}" method="POST">
            @csrf
                <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
                    Logout
                </button>
            </form>
            @endauth
        </div>
    </nav>
</div>