<div>
    <form wire:submit="save">
    @csrf
        <label class="form-control w-full">Name</label>
        <input name="name" type="text" placeholder="Type here" class="input w-full max-w-xs" wire:model="form.name"/>
        <button class="btn">Create</button>
    </form>
    @error('form.name')
    {{ $message }}
    @enderror
</div>


{{--<dialog id="create_category" class="modal">--}}
{{--    <div class="modal-box">--}}
{{--        <form method="dialog">--}}
{{--            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>--}}
{{--        </form>--}}
{{--        <h3 class="font-bold text-lg">Create Category</h3>--}}
{{--        <form wire:submit="save">--}}
{{--            <input type="text" wire:model="form.name">--}}
{{--            <div>--}}
{{--                @error('form.name') <span class="error">{{ $message }}</span> @enderror--}}
{{--            </div>--}}
{{--            <button type="submit" onclick="create_category.close()">Save</button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</dialog>--}}
