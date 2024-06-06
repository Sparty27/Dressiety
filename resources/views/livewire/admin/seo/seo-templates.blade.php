<div class="">
    <div class="flex justify-center">
        <h2 class="font-bold text-2xl">
            SEO Templates
        </h2>
    </div>
    <div class="flex justify-center">
        <table class="table mt-7 max-w-[500px]">
            <!-- head -->
            <thead>
            {{--        <tr>--}}
            {{--            <th></th>--}}
            {{--            <th>Name</th>--}}
            {{--            <th>Job</th>--}}
            {{--            <th>Favorite Color</th>--}}
            {{--        </tr>--}}
            </thead>
            <tbody>
            <tr>
                <td class="text-lg">Product Template</td>
                <td class="flex justify-end">
                    <a class="btn btn-primary btn-sm" href="{{route('admin.seo.edit', ['type' => 'products'])}}">
                        <i class="ri-pencil-fill"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td class="text-lg">Page Template</td>
                <td class="flex justify-end">
                    <a class="btn btn-primary btn-sm" href="{{route('admin.seo.edit', ['type' => 'pages'])}}">
                        <i class="ri-pencil-fill"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
