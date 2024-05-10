<div class="relative">
    <a class="btn absolute top-0 right-0" href="{{route('admin.products.index')}}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
    </a>

    <div class="p-3 border-2 border-gray-200 max-w-4xl w-full rounded-xl shadow">
        <div class="flex">
            <div class="max-w-36 w-full ">
                <span class="">Name: </span>

            </div>
            <div>
                {{ $product->name }}
            </div>
        </div>
        <div class="flex mt-5">
            <div class="max-w-36 w-full ">
                <span class="">Price: </span>

            </div>
            <div>
                {{ $product->formatted_price }} ₴
            </div>
        </div>
        <div class="flex mt-5">
            <div class="max-w-36 w-full ">
                <span class="">Quantity: </span>

            </div>
            <div>
                {{ $product->count }} pcs.
            </div>
        </div>
        <div class="flex mt-5 items-center">
            <div class="max-w-36 w-full ">
                <span class="">Category: </span>

            </div>
            <div class="flex items-center">
                <div class="avatar">
                    <div class="w-8 rounded-xl">
                        <img src="{{ $product->category->photo?->getUrl() ?? App\Models\Photo::IMAGE_NOT_FOUND }}" />
                    </div>
                </div>
            </div>
            <div class="ml-5">
                {{ $product->category->name }}
            </div>
        </div>
        <div class="flex mt-5">
            <div class="max-w-36 w-full ">
                <span class="">Visible in store: </span>

            </div>
            <div>
                <div class="form-control">
                    <input id="visible" type="checkbox" class="checkbox" wire:model="visible" disabled/>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <span class="">Images:</span>
            <div class="grid grid-cols-3 gap-8 border-2 p-3 rounded-xl mt-3">
                @foreach($product->photos as $photo)
                    <div class="flex justify-center items-center">
                        <img class="w-full max-w-56 rounded-lg" src="{{ $photo?->getUrl() ?? App\Models\Photo::IMAGE_NOT_FOUND }}">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex mt-5">
            <div class="max-w-36 w-full ">
                <span class="">Created at: </span>

            </div>
            <div>
                {{ $product->created_at }}
            </div>
        </div>
        <div class="flex mt-5">
            <div class="max-w-36 w-full ">
                <span class="">Updated at: </span>

            </div>
            <div>
                {{ $product->updated_at }}
            </div>
        </div>

        <div class="flex gap-3 justify-end my-5">
            <a class="btn" href="{{route('admin.products.edit', $product)}}">
                <i class="ri-pencil-line text-xl"></i>
            </a>

            <button type="button" class="btn btn-danger bg-red-600 hover:bg-red-700 text-white" wire:click="toggleDeleteModal">
                <i class="ri-delete-bin-line text-xl"></i>
            </button>

            <dialog id="modal" class="modal modal-vertical modal-sm" @if($open) open @endif>
                <div class="w-screen h-screen relative  bg-base-content opacity-40">
                </div>
                <form wire:submit="delete" method="dialog" class="modal-box absolute top-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-100">
                    <div class="mt-2 flex justify-center">
                        <button type="button" wire:click="toggleDeleteModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </div>
                    <div class="flex flex-wrap justify-center gap-5">
                        <div class="font-extrabold text-xl flex justify-center">
                            {{ trans('pages.admin.products.delete') }}
                        </div>
                    </div>
                    <div class="mt-3">
                        <div>
                            ID: <span class="font-bold">{{ $product->id }}</span>
                        </div>
                        <div>
                            Name: <span class="font-bold">{{ $product->name }}</span>
                        </div>
                    </div>
                    <div class="flex gap-3 justify-center mt-6">
                        <button type="submit" class="btn bg-red-600 hover:bg-red-700">Delete</button>
                        <button type="button" wire:click="toggleDeleteModal" class="btn">Cancel</button>
                    </div>
                </form>
            </dialog>
        </div>
    </div>
{{--    <div class="flex gap-3 absolute -bottom-20 right-0 pb-10">--}}
{{--        <a class="btn" href="{{route('admin.products.edit', $product)}}">--}}
{{--            <i class="ri-pencil-line text-xl"></i>--}}
{{--        </a>--}}

{{--        <button type="button" class="btn btn-danger bg-red-600 hover:bg-red-700 text-white" wire:click="toggleDeleteModal">--}}
{{--            <i class="ri-delete-bin-line text-xl"></i>--}}
{{--        </button>--}}

{{--        <dialog id="modal" class="modal modal-vertical modal-sm" @if($open) open @endif>--}}
{{--            <div class="w-screen h-screen relative  bg-base-content opacity-40">--}}
{{--            </div>--}}
{{--            <form wire:submit="delete" method="dialog" class="modal-box absolute top-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-100">--}}
{{--                <div class="mt-2 flex justify-center">--}}
{{--                    <button type="button" wire:click="toggleDeleteModal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>--}}
{{--                </div>--}}
{{--                <div class="flex flex-wrap justify-center gap-5">--}}
{{--                    <div class="font-extrabold text-xl flex justify-center">--}}
{{--                        {{ trans('pages.admin.products.delete') }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="mt-3">--}}
{{--                    <div>--}}
{{--                        ID: <span class="font-bold">{{ $product->id }}</span>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        Name: <span class="font-bold">{{ $product->name }}</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="flex gap-3 justify-center mt-6">--}}
{{--                    <button type="submit" class="btn bg-red-600 hover:bg-red-700">Delete</button>--}}
{{--                    <button type="button" wire:click="toggleDeleteModal" class="btn">Cancel</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </dialog>--}}
{{--    </div>--}}
</div>
