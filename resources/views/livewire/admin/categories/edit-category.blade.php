<div>
    <form wire:submit="save">
        <input type="text" wire:model="form.name">
        <div>
            @error('form.name') <span class="error">{{ $message }}</span> @enderror
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
