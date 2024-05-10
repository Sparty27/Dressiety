<div class="relative">
    <a class="btn absolute top-0 right-0" href="{{route('admin.products.show', $product)}}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
    </a>

    <div class="p-3 border-2 border-gray-200 max-w-4xl w-full rounded-xl shadow">
        <form wire:submit="save">
            <div class="flex">
                <div class="max-w-36 w-full ">
                    <label for="name" class="">Name: </label>
                </div>
                <div>
                    <input id="name" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" wire:model="name"/>
                    @error('name')
                    <div class="text-red-800 mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="flex mt-5">
                <div class="max-w-36 w-full ">
                    <label for="price" class="">Price: </label>
                </div>
                <div>
                    <div class="flex items-center">
                        <input id="price" x-mask:dynamic="$money($input, '.', ' ')" type="text" placeholder="0.00" class="input input-bordered w-full max-w-xs" wire:model="price">
                        <span class="ml-2">₴</span>
                    </div>
                    @error('price')
                    <div class="text-red-800 mt-3">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="flex mt-5">
                <div class="max-w-36 w-full ">
                    <label for="count" class="">Quantity: </label>
                </div>
                <div>
                    <div class="flex items-center">
                        <input id="count" type="number" min="0" placeholder="0" class="input input-bordered w-full max-w-xs" wire:model="count"/>
                        <span class="ml-2">pcs.</span>
                    </div>
                </div>
            </div>
            <div class="flex mt-5">
                <div class="max-w-36 w-full ">
                    <label for="category" class="">Category: </label>
                </div>
                <select id="category" class="select select-bordered w-full max-w-xs" wire:model="category">
                    <option disabled selected>Choose category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex mt-5">
                <div class="max-w-36 w-full ">
                    <label for="visible" class="">Make visible: </label>
                </div>
                <div class="form-control">
                    <input id="visible" type="checkbox" class="checkbox" wire:model="visible"/>
                </div>
            </div>
            <div class="mt-5">
                <span class="">Images:</span>
                <div class="grid grid-cols-3 gap-8 border-2 p-3 rounded-xl mt-3">
                    @foreach($photos as $photo)
                        <div class="flex justify-center items-center">
                            <img class="w-full max-w-56 rounded-lg" src="{{ asset($photo) ?? App\Models\Photo::IMAGE_NOT_FOUND }}">
                        </div>
                    @endforeach
                    <div class="flex justify-center items-center">
                        <label for="image">
                            <i class="ri-add-circle-fill text-3xl cursor-pointer mr-3">
                                <input id="image" type="file" class="hidden" wire:model.live="loadedPhoto"/>
                            </i>
                        </label>
                    </div>
                </div>
                @error('loadedPhoto')
                <div class="text-red-800 mt-3">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="flex justify-center gap-8 mt-5">
                <button type="submit" class="btn btn-outline btn-primary">Save</button>
                <button type="button" class="btn btn-outline btn-secondary" wire:click="resetForm">Reset</button>
            </div>
        </form>
    </div>
</div>
