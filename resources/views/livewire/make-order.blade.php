<div class="container mx-auto max-w-[900px]">
    <div class="border-green-300 border-4 rounded-2xl">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Count</th>
                <th>Price</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach(basket()->get() as $basketProduct)
                @include('livewire.order-product', compact('basketProduct'))
            @endforeach
            </tbody>
        </table>
        <div class="float-right my-3">
            <p class="text-2xl font-bold">Total: <span class="font-normal">{{ number_format(basket()->total(), 2, '.', ' ').' ₴' }}</span></p>
        </div>
    </div>

    <div class="card w-full bg-base-100 shadow-xl p-4 mx-auto mt-4 border-[1px] border-gray-200">
        <form wire:submit="makeOrder">
            <div class="sm:flex gap-5">
                <label class="input input-bordered flex items-center gap-2 w-full relative">
                    <i class="ri-phone-line"></i>
                    <input type="text" class="grow" placeholder="Phone" x-mask="+389 99 999 99 99" wire:model="phone"/>
                    <div class="absolute -bottom-5 bg-rose-400 rounded-lg">
                        @error('phone') <span class="error p-1">{{ $message }}</span> @enderror
                    </div>
                </label>
                <label class="input input-bordered flex items-center gap-2 w-full max-sm:mt-3 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" /><path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" /></svg>
                    <input type="email" class="grow" placeholder="Email" wire:model="email"/>
                    <div class="absolute -bottom-5 bg-rose-400 rounded-lg">
                        @error('email') <span class="error p-1">{{ $message }}</span> @enderror
                    </div>
                </label>
            </div>
            <div class="sm:flex gap-5 sm:mt-5">
                <label class="input input-bordered flex items-center gap-2 w-full max-sm:mt-3 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" /></svg>
                    <input type="text" class="grow" placeholder="First Name" wire:model="name"/>
                    <div class="absolute -bottom-5 bg-rose-400 rounded-lg">
                        @error('name') <span class="error p-1">{{ $message }}</span> @enderror
                    </div>
                </label>
                <label class="input input-bordered flex items-center gap-2 w-full max-sm:mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" /></svg>
                    <input type="text" class="grow" placeholder="Last Name" />
                </label>
            </div>
            <div class="flex justify-center mt-5">
                @include('parts.form.search-select', [
                    'value' => 'id',
                    'name' => 'name',
                    'search' => 'searchCity',
                    'options' => $cities,
                    'selected' => $selectedCity?->name ?? 'Choose City',
                    'select' => 'selectCity',
                    'zIndex' => 'z-[5]'
                ])
            </div>
            @if($selectedCity)
                <div class="flex justify-center mt-5">
                    @include('parts.form.search-select', [
                        'value' => 'id',
                        'name' => 'name',
                        'search' => 'searchWarehouse',
                        'options' => $warehouses,
                        'selected' => $selectedWarehouse?->name ?? 'Choose Warehouse',
                        'select' => 'selectWarehouse',
                        'zIndex' => 'z-[3]'
                    ])
                </div>
            @endif
            <div class="float-right mt-3">
                <button type="submit" class="btn btn-primary">Confirm Order</button>
            </div>
        </form>
    </div>
</div>
