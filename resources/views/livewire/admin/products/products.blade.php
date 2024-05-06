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


{{--    <table>--}}
{{--        <thead>--}}
{{--            <tr>--}}
{{--                @foreach($columns as $column)--}}
{{--                    <th @if( $column->sortable) wire:click="toggleSortColumn({{ $column->key }})" @endif>--}}
{{--                        {{ $column->name }}--}}
{{--                        @if($column->sortable)--}}
{{--                            @if($sortColumn == $column->key)--}}
{{--                                @if($sortDirection == 'asc')--}}
{{--                                    <i class="ri-arrow-up-line"></i>--}}
{{--                                @else--}}
{{--                                    <i class="ri-arrow-down-line"></i>--}}
{{--                                @endif--}}
{{--                            @else--}}
{{--                                <i class="ri-arrow-up-down-line"></i>--}}
{{--                            @endif--}}
{{--                        @endif--}}
{{--                    </th>--}}
{{--                @endforeach--}}
{{--            </tr>--}}
{{--        </thead>--}}
{{--    </table>--}}


    <div class="overflow-x-auto">
        <a href="{{ route('admin.products.create')}}" class="btn btn-primary mb-8">Create</a>
        <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" wire:model.live="searchText"/>
        <select class="select select-bordered w-full max-w-xs" wire:model.live="selectedCategory">
            <option value="" selected>All</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th wire:click="toggleSortColumn('id')">
                    ID
                    @if($sortColumn == 'id')
                        @if($sortDirection == 'asc')
                            <i class="ri-arrow-up-line"></i>
                        @else
                            <i class="ri-arrow-down-line"></i>
                        @endif
                    @else
                        <i class="ri-arrow-up-down-line"></i>
                    @endif
                </th>
                <th wire:click="toggleSortColumn('name')">
                    Name
                    @if($sortColumn == 'name')
                        @if($sortDirection == 'asc')
                            <i class="ri-arrow-up-line"></i>
                        @else
                            <i class="ri-arrow-down-line"></i>
                        @endif
                    @else
                        <i class="ri-arrow-up-down-line"></i>
                    @endif
                </th>
                <th>Category</th>
                <th>Image</th>
                <th wire:click="toggleSortColumn('count')">
                    Count
                    @if($sortColumn == 'count')
                        @if($sortDirection == 'asc')
                            <i class="ri-arrow-up-line"></i>
                        @else
                            <i class="ri-arrow-down-line"></i>
                        @endif
                    @else
                        <i class="ri-arrow-up-down-line"></i>
                    @endif
                </th>
                <th wire:click="toggleSortColumn('price')">
                    Price
                    @if($sortColumn == 'price')
                        @if($sortDirection == 'asc')
                            <i class="ri-arrow-up-line"></i>
                        @else
                            <i class="ri-arrow-down-line"></i>
                        @endif
                    @else
                        <i class="ri-arrow-up-down-line"></i>
                    @endif
                </th>
                <th wire:click="toggleSortColumn('created_at')">
                    Created at
                    @if($sortColumn == 'created_at')
                        @if($sortDirection == 'asc')
                            <i class="ri-arrow-up-line"></i>
                        @else
                            <i class="ri-arrow-down-line"></i>
                        @endif
                    @else
                        <i class="ri-arrow-up-down-line"></i>
                    @endif
                </th>
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

    {{ $products->links() }}
</div>
