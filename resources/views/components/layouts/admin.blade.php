<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('parts.layouts.favicon')

    <title>Dressiety</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <livewire:popup />
    <div>
        <div class="bg-base-100 drawer lg:drawer-open">
            <input id="drawer" type="checkbox" class="drawer-toggle">
            <div class="drawer-content bg-gray-200">
                @livewire('admin.parts.header')

                <div class="">
                    @yield('breadcrumbs')
                </div>

                <div class="p-4 grid gap-5 pt-5">
                    @component('parts.layouts.card')
                        {{ $slot }}
                    @endcomponent
                </div>
            </div>

            @livewire('admin.parts.sidebar')
        </div>
    </div>
@vite(['resources/js/app.js'])
</body>
</html>
