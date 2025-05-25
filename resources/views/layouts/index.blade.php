<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="module" src="{{ asset('js/script.js') }}" defer></script>

    {{-- <a rel="stylesheet" href="{{ asset('css/animate.min.css') }}"> --}}

    {{-- <a rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script> --}}
    {{-- <script src="{{ asset('assets/js/wow.min.js') }}" defer></script> --}}
    {{-- <script type="module" src="{{ asset('assets/js/script.js') }}" defer></script> --}}

    <title>ФЕНЕК</title>
</head>

<body>
    <div class="wrapper">
        @yield('layouts')
    </div>
</body>

</html>
