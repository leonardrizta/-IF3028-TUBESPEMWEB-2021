<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lapor</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">    

    <link rel="stylesheet" href="{{ asset('asset/css/Mainstyle.css') }}">
    @yield('css')

    <script src="{{ asset('asset/js/search.js') }}"></script>
</head>
<body>
    {{-- Search Template --}}
    @include('Lapor.layout.search')

    {{-- navbar Template --}}
    <section id="navbar">
        <div class="container">
            <div class="d-flex space-bettwen">
                <div class="left d-flex">
                    <a href="{{ route('landing') }}">
                        <div class="logo">
                            <img src=" {{ asset('asset/images/logo.png') }} " width="190px" height="60px" alt="Logos">
                        </div>
                    </a>
                    
                    {{-- Menu --}}
                    <ul class="d-flex menus-nav">
                        <li><a href="">Tentang Lapor!</a></li>
                        <li class="active"><a href="{{ route('listView') }}">Laporan</a></li>
                        <li><a href="#" onclick="showSearch()">Cari Aduan</a></li>
                    </ul>
                </div>

                <div class="profile">
                    <img src=" {{ asset('asset/images/user-icon.png') }} " width="50px" height="50px" alt="profile">
                    <span> {{ Auth::user()->name  }}</span>
                    <span><img class="icon-down" src="{{ asset('asset/images/icons/caret-down.svg') }}" width="15px" height="15px" alt=""></span>
                    <a href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </section>

    @yield('content')

    {{-- Footer Template --}}
    @include('Lapor.layout.footer')

</body>
</html>