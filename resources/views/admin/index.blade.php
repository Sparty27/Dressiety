<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="mytheme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Coming Soon</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;900&family=Noto+Sans+JP:wght@300;900&family=Noto+Sans:wght@300;900&display=swap"
        rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css'])
</head>
<body>
<div>
    <div class="bg-base-100 drawer lg:drawer-open">
        <input id="drawer" type="checkbox" class="drawer-toggle">
        <div class="drawer-content">
            @include('parts.header')

            <div class="px-6">
                @include('parts.breadcrumbs', ['links' => [
    [
        'url' => 'test',
        'name' => 'first'
]   ,
[
    'url' => 'test2',
    'name' => 'second',
]
]])
            </div>

            <div class="p-6 pb-16 grid gap-5">
                @yield('content')

                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Favorite Color</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        <tr>
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 2 -->
                        <tr class="hover">
                            <th>2</th>
                            <td>Hart Hagerty</td>
                            <td>Desktop Support Technician</td>
                            <td>Purple</td>
                        </tr>
                        <!-- row 3 -->
                        <tr>
                            <th>3</th>
                            <td>Brice Swyre</td>
                            <td>Tax Accountant</td>
                            <td>Red</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="grid gap-5">
                    <div>
                        <button class="btn">Button</button>
                        <button class="btn btn-neutral">Neutral</button>
                        <button class="btn btn-primary">Button</button>
                        <button class="btn btn-secondary">Button</button>
                        <button class="btn btn-accent">Button</button>
                        <button class="btn btn-ghost">Button</button>
                        <button class="btn btn-link">Button</button>
                    </div>

                    <select class="select select-bordered w-full max-w-xs">
                        <option disabled selected>Who shot first?</option>
                        <option>Han Solo</option>
                        <option>Greedo</option>
                    </select>

                    <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs"/>

                    <input type="file" class="file-input file-input-bordered w-full max-w-xs"/>

                    <input type="checkbox" class="toggle" checked/>

                    <input type="checkbox" checked="checked" class="checkbox"/>

                    <div>
                        <input type="radio" name="radio-1" class="radio" checked/>
                        <input type="radio" name="radio-1" class="radio"/>
                    </div>
                </div>

            </div>
        </div>

        @include('parts.sidebar')
    </div>
</div>

@vite(['resources/js/app.js'])
</body>
</html>
