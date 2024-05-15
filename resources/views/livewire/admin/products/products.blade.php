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
                'small' => true,
                'placeholder' => 'All'
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
                    <div class="flex items-center gap-1">
                        ID
                        @if($sortColumn == 'id')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-0.5"></i>
                            @else
                                <i class="ri-arrow-down-line mt-0.5"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-0.5"></i>
                        @endif
                    </div>
                </th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('name')">
                    <div class="flex items-center gap-1">
                        Name
                        @if($sortColumn == 'name')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-0.5"></i>
                            @else
                                <i class="ri-arrow-down-line mt-0.5"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-0.5"></i>
                        @endif
                    </div>
                </th>
                <th>Category</th>
                <th>Image</th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('count')">
                    <div class="flex items-center gap-1">
                        Count
                        @if($sortColumn == 'count')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-0.5"></i>
                            @else
                                <i class="ri-arrow-down-line mt-0.5"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-0.5"></i>
                        @endif
                    </div>
                </th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('price')">
                    <div class="flex items-center gap-1">
                        Price
                        @if($sortColumn == 'price')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-0.5"></i>
                            @else
                                <i class="ri-arrow-down-line mt-0.5"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-0.5"></i>
                        @endif
                    </div>
                </th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('status')">
                    <div class="flex items-center gap-1">
                        Visible
                        @if($sortColumn == 'status')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-0.5"></i>
                            @else
                                <i class="ri-arrow-down-line mt-0.5"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-0.5"></i>
                        @endif
                    </div>
                </th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('created_at')">
                    <div class="flex items-center gap-1">
                        Created at
                        @if($sortColumn == 'created_at')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-0.5"></i>
                            @else
                                <i class="ri-arrow-down-line mt-0.5"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-0.5"></i>
                        @endif
                    </div>
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
                        @include('parts.table.photo', [
                            'url' => $product->category?->photo?->url,
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

                            <button type="button" class="btn btn-sm btn-danger bg-red-600 hover:bg-red-700 text-white" wire:click="toggleDeleteModal('{{ $product->id }}')">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex gap-3 justify-end my-5">
        @if(isset($deleteProduct))
        <dialog id="modal" class="modal modal-vertical modal-sm" @if($open) open @endif>
            <div class="w-screen h-screen relative  bg-base-content opacity-40">
            </div>
            <form wire:submit="delete" method="dialog" class="modal-box absolute top-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-100">
                <div class="mt-2 flex justify-center">
                    <button type="button" wire:click="toggleDeleteModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </div>
                <div class="flex flex-wrap justify-center gap-5">
                    <div class="font-extrabold text-xl flex justify-center">
                        {{ trans('pages.admin.products.delete') }}
                    </div>
                </div>
                <div class="mt-3 text-center text-lg">
                    Are you sure you want to delete
                    <span class="font-bold">{{ $deleteProduct->name }}</span>
                    ?
                </div>
                <div class="flex gap-3 justify-center mt-6">
                    <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white">Delete</button>
                    <button type="button" wire:click="toggleDeleteModal" class="btn">Cancel</button>
                </div>
            </form>
        </dialog>
        @endif
    </div>

    {{ $products->links() }}
</div>
