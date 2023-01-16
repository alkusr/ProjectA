<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    {{ $css ?? '' }}
    @stack('css')


</head>

<body>
    <nav class="navbar bg-white">
        <div class="container d-block">
            <a class="ms-4" href="{{ route('participant.dashboard') }}">

                <img style="width: 50px;" src="assets/images/logo-app.png">
                <span class="fs-3 font-bold">{{ env('APP_NAME') }}</span>

            </a>
        </div>
    </nav>


    <div class="container">
        {{ $slot }}
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/mazer.js"></script>
        {{ $js ?? '' }}
        @stack('js')
    </div>

</body>

</html>
