<div>
    <a class="btn btn-primary mb-3" wire:click="openCreateModal">Create</a>
    <dialog id="modal" class="modal modal-vertical modal-sm" @if($open) open @endif>
        <div class="w-screen h-screen relative  bg-base-content opacity-40">
        </div>
        <form wire:submit="save" method="dialog" class="modal-box absolute top-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-100">
            <div class="font-extrabold text-xl flex justify-center">
                {{ trans('pages.admin.categories.create') }}
            </div>
            <div class="mt-2 flex justify-center">
                <button type="button" wire:click="closeCreateModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </div>
            <div class="flex justify-center">
                <div>
                    <div>
                        <label class="form-control w-full font-bold">Name</label>
                        <input name="name" type="text" placeholder="Type here" class="input w-full max-w-xs mt-3 border-2 border-slate-300" wire:model="form.name"/>
                    </div>
                    <div class="mt-6">
                        <label class="form-control w-full font-bold">Image</label>
                        <div class="">
                            @if ($form->photo)
                                <img class="rounded-2xl my-6 w-full max-w-xs" src="{{ $form->photo->temporaryUrl() }}">
                            @endif
                        </div>
                        <input type="file" class="file-input file-input-bordered w-full max-w-xs mt-3" wire:model="form.photo"/>
                    </div>
                    @error('form.name')
                    <div class="text-red-800 mt-3">
                        — {{ $message }}
                    </div>
                    @enderror
                    @error('form.photo')
                    <div class="text-red-800 mt-3">
                        — {{ $message }}
                    </div>
                    @enderror
                    <div class="flex justify-center">
                        <button type="submit" class="btn btn-primary mt-6">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </dialog>
</div>
