<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ page()->getTitle() }}</title>

        @include('parts.layouts.favicon')

        @stack('meta-data')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        @livewire('site.components.header')
        @livewire('popup')
        <div class="drawer drawer-end">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
            <div class="mx-auto container">
                <div class="drawer-content flex flex-col p-4">
                    {{ $slot }}
                </div>
            </div>
            @livewire('basket')
        </div>
        @livewire('site.components.footer')
    </body>
</html>
