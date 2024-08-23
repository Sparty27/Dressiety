<div class="">
    <div class="flex max-sm:gap-4 justify-between items-end mb-8">
        <div class="flex gap-8 w-full">
            @include('parts.form.input', [
                'title' => 'Search',
                'model' => 'searchText',
                'small' => true
            ])
        </div>

        <a href="{{ route('admin.categories.create')}}" class="btn btn-primary btn-sm">
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
                                <i class="ri-arrow-up-line mt-[2px]"></i>
                            @else
                                <i class="ri-arrow-down-line mt-[2px]"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-[2px]"></i>
                        @endif
                    </div>
                </th>
                <th>Image</th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('name')">
                    <div class="flex items-center gap-1">
                        Name
                        @if($sortColumn == 'name')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-[2px]"></i>
                            @else
                                <i class="ri-arrow-down-line mt-[2px]"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-[2px]"></i>
                        @endif
                    </div>
                </th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('created_at')">
                    <div class="flex items-center gap-1">
                        Created At
                        @if($sortColumn == 'created_at')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-[2px]"></i>
                            @else
                                <i class="ri-arrow-down-line mt-[2px]"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-[2px]"></i>
                        @endif
                    </div>
                </th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('updated_at')">
                    <div class="flex items-center gap-1">
                        Updated At
                        @if($sortColumn == 'updated_at')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-[2px]"></i>
                            @else
                                <i class="ri-arrow-down-line mt-[2px]"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-[2px]"></i>
                        @endif
                    </div>
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($categories as $category)
                <tr class="hover">
                    <td class="font-black">{{$category->id}}</td>
                    <td>
                        {{--                    <div class="flex items-center gap-3">--}}
                        {{--                        <div class="avatar">--}}
                        {{--                            <div class="w-12 h-12 rounded-xl">--}}
                        {{--                                <img src="{{ asset($category->photos()->value('url')) != asset('') ? asset($category->photos()->value('url')) : 'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=' }}" alt="Avatar Tailwind CSS Component" />--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        @include('parts.table.photo', [
                            'url' => $category->photo?->url,
                            'alt' => $category->name
                        ])
                    </td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                    <td>
                        <div class="flex gap-3 items-center">
                            <a class="btn btn-sm border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="{{route('admin.categories.edit', $category)}}">
                                <i class="ri-pencil-line"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-danger bg-red-600 hover:bg-red-700 text-white" wire:click="toggleDeleteModal('{{ $category->id }}')">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    @include('parts.delete-modal', [
        'model' => $deleteCategory,
        'open' => $open,
        'deleteMethod' => 'delete',
        'toggleMethod' => 'toggleDeleteModal',
        'transPath' => 'pages.admin.categories.delete',
    ])

    {{ $categories->links() }}
</div>
