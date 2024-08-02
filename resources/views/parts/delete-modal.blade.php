<div class="flex gap-3 justify-end my-5">
    @if(isset($model))
        <dialog id="modal" class="modal modal-vertical modal-sm" @if($open) open @endif>
            <div class="w-screen h-screen relative  bg-base-content opacity-40">
            </div>
            <form wire:submit="{{ $deleteMethod }}" method="dialog" class="modal-box absolute top-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-100">
                <div class="mt-2 flex justify-center">
                    <button type="button" wire:click="{{ $toggleMethod }}" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </div>
                <div class="flex flex-wrap justify-center gap-5">
                    <div class="font-extrabold text-xl flex justify-center">
                        {{ trans( $transPath) }}
                    </div>
                </div>
                <div class="mt-3 text-center text-lg">
                    Are you sure you want to delete
                    @if(isset($name))
                        <span class="font-bold">{{ $model->$name }}</span>
                    @else
                        <span class="font-bold">{{ $model->name }}</span>
                    @endif
                    ?
                </div>
                <div class="flex gap-3 justify-center mt-6">
                    <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white">Delete</button>
                    <button type="button" wire:click="{{ $toggleMethod }}" class="btn">Cancel</button>
                </div>
            </form>
        </dialog>
    @endif
</div>
