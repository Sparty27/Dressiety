<div>
    <div class="overflow-x-auto">
        <a href="{{ route('admin.tags.create')}}" class="btn btn-primary mb-8">Create</a>
        <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" wire:model.live="searchText"/>

        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th wire:click="toggleSortColumn('id')">ID
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
                <th wire:click="toggleSortColumn('name')">Name
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
                <th wire:click="toggleSortColumn('status')">Status
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
                <th wire:click="toggleSortColumn('created_at')">Created At
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
                <th wire:click="toggleSortColumn('updated_at')">Updated At
                    @if($sortColumn == 'updated_at')
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

            @foreach($tags as $tag)
                <tr class="hover">
                    <td class="font-black">{{$tag->id}}</td>
                    <td>{{$tag->name}}</td>
                    <td>
                        @if ($tag->status)
                            True
                        @else
                            False
                        @endif
                    </td>
                    <td>{{$tag->created_at}}</td>
                    <td>{{$tag->updated_at}}</td>
                    <td>
                        <a class="btn border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="{{ route('admin.tags.show', compact('tag')) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $tags->links() }}
    </div>
</div>
