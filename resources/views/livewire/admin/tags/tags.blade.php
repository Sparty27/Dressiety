<div>
    <div class="flex justify-between items-end mb-8">
        <div class="flex gap-8 w-full">
            @include('parts.form.input', [
                'title' => 'Search',
                'model' => 'searchText',
                'small' => true
            ])
        </div>

        <a href="{{ route('admin.tags.create')}}" class="btn btn-primary btn-sm">
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
                <th class="cursor-pointer" wire:click="toggleSortColumn('status')">
                    <div class="flex items-center gap-1">
                    Status
                    @if($sortColumn == 'status')
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

            @foreach($tags as $tag)
                <tr class="hover">
                    <td class="font-black">{{$tag->id}}</td>
                    <td>{{$tag->name}}</td>
                    <td>
                        <input type="checkbox" class="toggle" wire:click="toggleVisible('{{ $tag->id }}')" @if($tag->status) checked @endif/>
                    </td>
                    <td>{{$tag->created_at}}</td>
                    <td>{{$tag->updated_at}}</td>
                    <td>
                        <div class="flex gap-3 items-center">
                            <a class="btn btn-sm border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="{{route('admin.tags.edit', $tag)}}">
                                <i class="ri-pencil-line"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-danger bg-red-600 hover:bg-red-700 text-white" wire:click="toggleDeleteModal('{{ $tag->id }}')">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @include('parts.delete-modal', [
            'model' => $deleteTag,
            'open' => $open,
            'deleteMethod' => 'delete',
            'toggleMethod' => 'toggleDeleteModal',
            'transPath' => 'pages.admin.tags.delete',
        ])

        {{ $tags->links() }}
    </div>
</div>
