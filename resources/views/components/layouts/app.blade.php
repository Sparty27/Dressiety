<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

{{--        <title>{{ $title ?? 'Page Title' }}</title>--}}

{{--        {{ seo()->getMeta($model) }}--}}


        @stack('meta-data')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @livewire('header')
        <div class="drawer drawer-end">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
            <div class="mx-auto container">
                <div class="drawer-content flex flex-col">
                    <!-- Navbar -->
{{--                    @livewire('header')--}}
                    <div class="p-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            @livewire('basket')
            <footer class="footer footer-center bg-[#5A72A0] text-base-content rounded p-10 text-white">
                <nav class="grid grid-flow-col gap-4">
                    <a class="link link-hover">About me</a>
                    <a class="link link-hover">Contact</a>
                    <a href="https://sparty27.github.io/Nyshchyi_Nazar_IPZ-32_Coursework/" class="link link-hover" target="_blank">Coursework</a>
                </nav>
                <nav>
                    <div class="grid grid-flow-col gap-4">
                        <a href="https://github.com/Sparty27" target=”_blank”>
                            <img src="{{ asset('images/icons/github-fill.svg') }}" class="w-7" alt="Github">
                        </a>
                        <a href="https://t.me/Sparty54" target=”_blank”>
                            <img src="{{ asset('images/icons/telegram-fill.svg') }}" class="w-7" alt="Telegram">
                        </a>
                    </div>
                </nav>
                <aside>
                    <p>Copyright © <script>document.write((new Date()).getFullYear());</script> - All rights reserved by ACME Industries Ltd</p>
                </aside>
            </footer>
        </div>
    </body>
</html>
