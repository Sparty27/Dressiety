<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <livewire:popup />
    <div>
        <div class="bg-base-100 drawer lg:drawer-open">
            <input id="drawer" type="checkbox" class="drawer-toggle">
            <div class="drawer-content bg-gray-200">
                @livewire('admin.parts.header')

                <div class="px-6">
{{--                    @yield('breadcrumbs')--}}
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
