<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('parts.layouts.favicon')

    {{--        <title>{{ $title ?? 'Page Title' }}</title>--}}

    {{--        {{ seo()->getMeta($model) }}--}}

    @stack('meta-data')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}

    {{--        <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}

    {{--        <script src="{{ asset('js/app.js') }}" defer></script>--}}
</head>
<body>
@livewire('site.components.header')
@livewire('popup')
<div class="drawer drawer-end">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div class="mx-auto container">
        <div class="drawer-content flex flex-col p-4">
            @yield('content')
        </div>
    </div>
    @livewire('basket')
</div>
@livewire('site.components.footer')
</body>
</html>
