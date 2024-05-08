<div class="relative">
    <a class="btn absolute top-0 right-0" href="{{route('admin.categories.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
    </a>
    <div>
        <div class="text-xl">
            <span class="font-semibold">ID: </span>{{$category->id}}
        </div>
        <div class="text-xl mt-3">
            <span class="font-semibold">Name: </span>{{$category->name}}
        </div>
        <div>
            <img class="rounded-2xl my-6 w-full max-w-xs" src="{{ asset($category->photos()->value('url')) != asset('') ? asset($category->photos()->value('url')) : 'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=' }}" alt="Category Image">
        </div>
    </div>
    <div class="flex gap-3 w-full max-w-xs justify-center">
        <a class="btn" href="{{route('admin.categories.edit', $category)}}">Edit</a>

        <button type="button" class="btn btn-danger bg-red-600 hover:bg-red-700" wire:click="toggleDeleteModal">Delete</button>
    </div>


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
            <div class="mt-3">
                <div>
                    ID: <span class="font-bold">{{ $category->id }}</span>
                </div>
                <div>
                    Name: <span class="font-bold">{{ $category->name }}</span>
                </div>
            </div>
            <div class="flex gap-3 justify-center mt-6">
                <button type="submit" class="btn bg-red-600 hover:bg-red-700">Delete</button>
                <button type="button" wire:click="toggleDeleteModal" class="btn">Cancel</button>
            </div>
        </form>
    </dialog>

{{--    <form action="{{ route('admin.categories.destroy', $category)}}" method="post">--}}
{{--        @csrf--}}
{{--        @method('DELETE')--}}
{{--        <button type="submit" class="btn">Delete</button>--}}
{{--    </form>--}}
</div>
