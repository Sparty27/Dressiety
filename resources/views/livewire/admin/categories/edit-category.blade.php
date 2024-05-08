<div>

    <form wire:submit="save">
        <div class="max-w-xs">
            <h3 class="font-bold text-2xl text-center mb-3">ID {{ $category->id }}</h3>
            <label class="input input-bordered flex items-center gap-2">
                Name
                <input type="text" placeholder="Type here" class="grow" wire:model="name">
            </label>
            <div class="mt-6">
                <label class="form-control w-full font-bold">Image</label>
                <div class="">
                    @if ($photo)
                        <img class="rounded-2xl my-6 w-full max-w-xs" src="{{ $photo->temporaryUrl() }}">
                    @elseif($category->photo != null)
                        <img class="rounded-2xl my-6 w-full max-w-xs" src="{{ asset($category->photo->url) }}">
                    @endif
                </div>
                <input type="file" class="file-input file-input-bordered w-full max-w-xs mt-3" wire:model="photo"/>
            </div>
        </div>
        <div>
            @error('name')
            <div class="text-red-800 mt-3">
                — {{ $message }}
            </div>
            @enderror
            @error('photo')
            <div class="text-red-800 mt-3">
                — {{ $message }}
            </div>
            @enderror
        </div>
        <button class="btn btn-primary mt-3">Save</button>
    </form>
</div>


{{--<div>--}}
{{--    <button class="btn" onclick="edit_category.showModal()">Edit</button>--}}

{{--    <dialog id="edit_category" class="modal">--}}
{{--        <div class="modal-box">--}}
{{--            <form method="dialog">--}}
{{--                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>--}}
{{--            </form>--}}
{{--            <h3 class="font-bold text-lg">Edit Category</h3>--}}
{{--            <form wire:submit="save">--}}
{{--                <input type="text" wire:model="form.name">--}}
{{--                <div>--}}
{{--                    @error('form.name') <span class="error">{{ $message }}</span> @enderror--}}
{{--                </div>--}}
{{--                <button class="btn btn-primary mt-3">Save</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </dialog>--}}
{{--</div>--}}
