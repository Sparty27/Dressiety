<div>
    {{--    <a href="{{route('products.create')}}" class="btn btn-primary my-4">Create</a>--}}
    {{--    <div class="border-teal-500 border-2 p-3 rounded-md flex-wrap flex gap-2">--}}
    {{--        @foreach($products as $product)--}}
    {{--            <a class="mb-2 rounded-md border-gray-200 border-2 p-2 hover:shadow-md cursor-pointer ease-linear duration-200"--}}
    {{--               href="{{ route('products.show', compact('product')) }}">--}}
    {{--                {{$product->name}}--}}
    {{--            </a>--}}
    {{--        @endforeach--}}
    {{--    </div>--}}
    <div class="overflow-x-auto">
        <a href="{{ route('admin.products.create')}}" class="btn btn-primary mb-8">Create</a>
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Image</th>
                <th>Count</th>
                <th>Price</th>
                <th>Created at</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($products as $product)
                <tr class="hover">
                    <td class="font-black">{{$product->id}}</td>
                    <td class="font-"><a href="{{ route('admin.products.show', compact('product')) }}">{{$product->name}}</a></td>
                    <td>
                        @include('parts.table.photo', ['url' => $product->category?->photo?->url,
    'alt' => $product->name,
    'name' => $product->category->name
    ])
                    </td>
                    <td>
                        <div class="avatar-group -space-x-6 rtl:space-x-reverse">
                            @foreach($product->photos as $photo)
                                <div class="avatar">
                                    <div class="w-12">
                                        <img src="{{ $photo->url }}" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td>{{ $product->count }}</td>
                    <td class="font-bold">{{ $product->formatted_price }} ₴</td>
                    <td>{{ $product->created_at }}</td>
                    <td><a class="btn border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="{{ route('admin.products.show', compact('product')) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
