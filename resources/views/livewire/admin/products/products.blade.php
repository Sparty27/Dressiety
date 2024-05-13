<div>
    <div class="flex justify-between items-end mb-8">
        <div class="flex gap-8 w-full">
            @include('parts.form.input', [
                'title' => 'Search',
                'model' => 'searchText',
                'small' => true
            ])
            @include('parts.form.select', [
                'title' => 'Categories',
                'model' => 'selectedCategory',
                'options' => $categories,
                'value' => 'id',
                'name' => 'name',
                'small' => true
            ])
        </div>

        <a href="{{ route('admin.products.create')}}" class="btn btn-primary btn-sm">
            <i class="ri-add-circle-line"></i>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th class="cursor-pointer" wire:click="toggleSortColumn('id')">
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
                <th class="cursor-pointer" wire:click="toggleSortColumn('name')">
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
                <th class="cursor-pointer" wire:click="toggleSortColumn('count')">
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
                <th class="cursor-pointer" wire:click="toggleSortColumn('price')">
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
                <th class="cursor-pointer" wire:click="toggleSortColumn('status')">
                    Visible
                    @if($sortColumn == 'status')
                        @if($sortDirection == 'asc')
                            <i class="ri-arrow-up-line"></i>
                        @else
                            <i class="ri-arrow-down-line"></i>
                        @endif
                    @else
                        <i class="ri-arrow-up-down-line"></i>
                    @endif
                </th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('created_at')">
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
    'alt' => $product->category->name,
    'name' => $product->category->name
    ])
                    </td>
                    <td>
                        <div class="avatar">
                            <div class="w-12 rounded-xl">
                                <img src="{{ $product->photo?->getUrl() ?? \App\Models\Photo::IMAGE_NOT_FOUND }}" />
                            </div>
                        </div>
                    </td>
                    <td>{{ $product->count }}</td>
                    <td class="font-bold">{{ $product->formatted_price }} ₴</td>
                    <td>{{ $product->status ? 'Yes' : 'No' }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <div class="flex gap-3 items-center">
                            <a class="btn btn-sm border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="{{ route('admin.products.show', compact('product')) }}">
                                <i class="ri-eye-line"></i>
                            </a>
                            <a class="btn btn-sm border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="{{route('admin.products.edit', $product)}}">
                                <i class="ri-pencil-line"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-danger bg-red-600 hover:bg-red-700 text-white" wire:click="toggleDeleteModal">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $products->links() }}
</div>
