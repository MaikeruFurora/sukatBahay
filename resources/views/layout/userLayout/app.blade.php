<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SukatBahay</title>
    <link rel="stylesheet" href="{{ asset('userstyle/css/bootstrap.min.css') }}">
    <script src="{{ asset('userstyle/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('userstyle/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        @include('layout.userLayout.navbar')
        <!-- end navbar -->
        <section class="py-5">
            @yield('content')
        </section>
    </main>
    {{-- @include('layout.userLayout.footer') --}}
    <script src="{{ asset("userstyle/js/script.js") }}"></script>
    <script src="{{ asset("userstyle/js/jquery-3.6.0.min.js") }}"></script>
    @yield('js')
</body>

</html>