<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Thi Trắc Nghiệm</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/propeller.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylecustom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.toast.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbar-inverse pmd-navbar pmd-z-depth">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="pmd-ripple-effect navbar-toggle pmd-navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand navbar-brand-custome" href="{{ url('/') }}">
                        Thi Trắc Nghiệm
                    </a>
                </div>

                <div class="collapse navbar-collapse pmd-navbar-sidebar" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="dropdown pmd-dropdown liright">
                            <a data-toggle="dropdown" class="pmd-ripple-effect dropdown-toggle" data-sidebar="true" href="#">Đề thi các môn <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <?php
                                use App\Categories;
                                $categories = Categories::all();
                            ?>
                            @foreach($categories as $cat)
                                <li class="liright">
                                    <a href="{{ route('cat.show', $cat->id) }}" class="pmd-ripple-effect">{{ $cat->name }}</a>
                                </li>
                            @endforeach
                            </ul>
                        </li>

                        @if (Auth::user())
                        <li class="liright"><a href="{{ route('er.index') }}" class="pmd-ripple-effect"><i class="glyphicon glyphicon-repeat"></i> Lịch sử làm bài</a></li>
                        @endif

                        <li class="liright"><a href="{{ route('er.userscore') }}" class="pmd-ripple-effect"><i class="glyphicon glyphicon-education"></i> Bảng xếp hạng</a></li>

                        @if (Auth::user() && Auth::user()->role() == 'admin')
                        <li class="liright"><a href="{{ route('posts.create') }}" class="pmd-ripple-effect"><i class="glyphicon glyphicon glyphicon-cloud-upload"></i> Upload đề</a></li>

                        <li class="liright"><a href="{{ route('admin.index') }}" class="pmd-ripple-effect"><i class="glyphicon glyphicon glyphicon-king"></i> Quản trị</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="lileft"><a href="{{ route('login') }}">Login</a></li>
                            <li class="lileft"><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown pmd-dropdown pmd-user-info pull-right">
                                <a href="#" class="btn-user dropdown-toggle media" data-toggle="dropdown" data-sidebar="true" aria-expanded="false">
                                    <div class="media-left">
                                      <img src="{{ asset('/avatars') }}/{{ Auth::user()->avatar }}" width="40" height="40" alt="avatar" class="avatar">
                                    </div>
                                  <div class="media-body media-middle">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                    </div>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li>
                                        <a class="pmd-ripple-effect" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="pmd-sidebar-overlay"></div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('js/propeller.js') }}"></script>
</body>
</html>
