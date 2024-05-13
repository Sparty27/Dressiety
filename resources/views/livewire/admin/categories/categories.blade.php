<div class="overflow-x-auto">
    <div class="flex justify-between items-end mb-8">
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
                    <div class="flex items-center gap-1 gap-3">
                        <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img src="{{ asset($category->photos()->value('url')) != asset('') ? asset($category->photos()->value('url')) : 'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=' }}" alt="Avatar Tailwind CSS Component" />
                            </div>
                        </div>
                    </div>
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

    <div class="flex gap-3 justify-end my-5">
        @if(isset($deleteCategory))
            <dialog id="modal" class="modal modal-vertical modal-sm" @if($open) open @endif>
                <div class="w-screen h-screen relative  bg-base-content opacity-40">
                </div>
                <form wire:submit="delete" method="dialog" class="modal-box absolute top-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-100">
                    <div class="mt-2 flex justify-center">
                        <button type="button" wire:click="toggleDeleteModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </div>
                    <div class="flex flex-wrap justify-center gap-5">
                        <div class="font-extrabold text-xl flex justify-center">
                            {{ trans('pages.admin.categories.delete') }}
                        </div>
                    </div>
                    <div class="mt-3 text-center text-lg">
                        Are you sure you want to delete
                        <span class="font-bold">{{ $deleteCategory->name }}</span>
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

    {{ $categories->links() }}
</div>
