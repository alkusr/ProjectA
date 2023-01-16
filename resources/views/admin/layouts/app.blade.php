<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dark.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    @yield('css')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="index.html"><img style="width: 30px;height:30px;"
                                    src="{{ asset('assets/images/logo-app.png') }}">
                                <span class="fs-6 font-bold">{{ env('APP_NAME') }}</span></a>
                        </div>
                        <div class="toggler">
                            <img src="{{ asset('assets/images/moon-solid.svg') }}" class="dark">
                            <img src="{{ asset('assets/images/sun-solid.svg') }}" class="light">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item  {{ request()->routeIs('admin.test.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.test.index') }}" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Diagnostic Test</span>
                            </a>
                        </li>
                        <li class="sidebar-item  {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.index') }}" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>User</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item  has-sub {{ request()->routeIs('admin.question.*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link '>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Soal</span>
                            </a>
                            <ul class="submenu {{ request()->routeIs('admin.question.*') ? 'active' : '' }}">
                                <li
                                    class="submenu-item {{ request()->routeIs('admin.question.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.question.index') }}">List Soal</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm float-right w-100">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; {{ env('APP_NAME') }}</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/dark.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/mazer.js') }}"></script>
    @yield('js')
</body>

</html>
