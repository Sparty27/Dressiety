<div>
    <div class="card w-96 bg-base-100 shadow-xl border-2">
        <div class="card-body">
            <div class="flex justify-between">
                <h2 class="card-title">ID: {{$tag->id}}</h2>
                <a class="btn" href="{{route('admin.tags.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
            </div>
            <p>Name: {{$tag->name}}</p>
            <p>Status: {{$tag->status==1?'True':'False'}}</p>
            <div class="card-actions justify-end">
                <a href="{{route('admin.tags.edit', $tag)}}" class="btn btn-primary">Edit</a>
                <button type="button" class="btn bg-red-600" wire:click="toggleDeleteModal">Delete</button>
            </div>
        </div>
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
                    {{ trans('pages.admin.tags.delete') }}
                </div>
            </div>
            <div class="mt-3">
                <div>
                    ID: <span class="font-bold">{{ $tag->id }}</span>
                </div>
                <div>
                    Name: <span class="font-bold">{{ $tag->name }}</span>
                </div>
            </div>
            <div class="flex gap-3 justify-center mt-6">
                <button type="submit" class="btn bg-red-700 hover:bg-red-800">Delete</button>
                <button type="button" wire:click="toggleDeleteModal" class="btn">Cancel</button>
            </div>
        </form>
    </dialog>
</div>
