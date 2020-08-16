<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- <title>Tino Zhabinskiy</title> --}}

    <link rel="stylesheet" href="{{ url('/css/main.css') }}" />
    @livewireStyles
</head>
<body class="bg-gray-100">
    @yield('content')

    @livewireScripts
</body>
</html>
