<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name='user-id' content="{{ auth()->user()->level}}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" id="theme" href="/style/css/theme-default.css"/>
    <script src="{{ asset('sweetalert/sweetalert.min.js') }}" defer></script>
    <style>
        .panel{
            background:#fff;
        }
        .x-navigation.x-navigation-horizontal {
            height: 50px;
            background: #1c8baf;
        }
        .x-navigation > li.xn-logo > a:first-child {
            font-size: 25px;
            border-bottom: 0px;
            color: #FFF;
            height: 50px;
            text-align: center;
            background: #1c8baf;
        }
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            background: #dad8d8;
        }
        .page-container .page-content {
            min-height: 100%;
            margin-left: 220px;
            background: #dad8d8 ;
            position: relative;
            zoom: 1;
        }
        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            color: #ad9c24;
            padding: 0px;
            margin: 0px;
                margin-bottom: 0px;
        }
        .page-container .page-sidebar {
            width: 220px;
            float: left;
            position: relative;
            z-index: 3;
            height: 100vh;
        }
        .html, body {
            min-height: 100%;
            padding: 0px;
            margin: 0px;
            background: #dad8d8;
            position: relative;
            font-family: 'Open Sans', sans-serif;
            font-size: 12px;
            color: #22262e;
            overflow-x: hidden;
        }
        .tulisanhidden{
            color:#dad8d8;
        }
    </style>
</head>
<body>
    <div id="app">
    <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="#">SIPERPUS</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>                                                                   
                    <li class="xn-title">Home</li>
                    <li>
                        <router-link to="/"><span class="fa fa-dashboard"></span> <span class="xn-text">Dashboard</span></router-link>
                    </li>
                    @php($level = auth()->user()->level)
                    @if($level == 'petugas' )
                    <li class="xn-title">Entry data</li>
                    <li>
                        <router-link to="/entry/user"><span class="fa fa-users"></span> <span class="xn-text">User</span></router-link>
                    </li>
                    <li>
                        <router-link to="/entry/penerbit"><span class="fa fa-building-o"></span> <span class="xn-text">Penerbit</span></router-link>
                    </li>
                    <li>
                        <router-link to="/entry/kategori"><span class="fa fa-tag"></span> <span class="xn-text">Kategory</span></router-link>
                    </li>
                    <li>
                        <router-link to="/entry/buku"><span class="fa fa-book"></span> <span class="xn-text">Buku</span></router-link>
                    </li>
                    <li class="xn-title">Pengolahan data</li>
                    <li>
                        <router-link to="/peminjaman/buku"><span class="fa fa-arrow-left"></span> <span class="xn-text">Peminjaman Buku</span></router-link>
                    </li>
                    <li>
                        <router-link to="/pengembalian/buku"><span class="fa fa-arrow-right"></span> <span class="xn-text">Pengembalian Buku</span></router-link>
                    </li> 
                    @endif  
                    @if($level == 'siswa') 
                    <li class="xn-title">Pengolahan data</li>
                    <li>
                        <router-link to="/peminjaman/buku/siswa"><span class="fa fa-arrow-left"></span> <span class="xn-text">Peminjaman Buku</span></router-link>
                    </li>
                    <li>
                        <router-link to="/riwayat/buku/siswa"><span class="fa fa-arrow-right"></span> <span class="xn-text">Riwayat Peminjaman Buku</span></router-link>
                    </li> 
                    @endif
                    @if($level != 'siswa')
                    <li class="xn-title">Laporan</li>
                    <li>
                        <router-link to="/laporan/penerbit"><span class="fa fa-files-o"></span> <span class="xn-text">Data Penerbit</span></router-link>
                    </li> 
                    <li>
                        <router-link to="/laporan/user"><span class="fa fa-files-o"></span> <span class="xn-text">Data user</span></router-link>
                    </li> 
                    <li>
                        <router-link to="/laporan/siswa"><span class="fa fa-files-o"></span> <span class="xn-text">Data Siswa</span></router-link>
                    </li>
                    <li>
                        <router-link to="/laporan/buku"><span class="fa fa-files-o"></span> <span class="xn-text">Data Buku</span></router-link>
                    </li>  
                    <li>
                        <router-link to="/laporan/peminjaman"><span class="fa fa-files-o"></span> <span class="xn-text">Data peminjaman</span></router-link>
                    </li> 
                     @endif 
                     <li class="xn-title">Setting</li>
                    <li>
                        <router-link to="/setting/akun"><span class="fa fa-user"></span> <span class="xn-text">Akun</span></router-link>
                    </li>                             
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->                <li class="nav-item dropdown float-right">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><span class="fa fa-user"></span>
                            {{ auth()->user()->name}}
                        </a>
                        <div class="dropdown-menu">
                            <!-- <a class="dropdown-item" href="#"> <span class="fa fa-cog"></span> AKUN</a> -->
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <span class="fa fa-sign-out"></span>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </div>
                        </li>    
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
                
                <!-- START BREADCRUMB -->
               
                <!-- END BREADCRUMB -->                
                @yield('main')             
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
   
    </div>
    
</body>
</html>
