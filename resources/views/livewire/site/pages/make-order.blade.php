<div class="max-w-[750px] mx-auto rounded max-sm:p-6 p-12 shadow-2xl border-[1px] border-gray-100 mb-12">
    <div wire:loading wire:target.except="name, lastName"
         class="w-full h-full fixed top-0 left-0 bg-white opacity-75 z-50">
        <div class="flex justify-center items-center mt-[50vh]">
            <span class="loading loading-spinner w-[75px] text-neutral"></span>
        </div>
    </div>
    <h2 class="font-semibold max-sm:text-2xl text-[2rem]">Product Order Form</h2>
    <div class="text-[#57647e] max-sm:text-base text-[1em]">
        Please make sure to fill in the required fields and submit this form to complete your order.
    </div>

    <div class="text-[16px] mt-16 font-medium">
        My Products
    </div>
    <div class="sm:grid sm:grid-cols-2 md:grid-cols-3 sm:gap-6 mt-5">
        @foreach($basketProducts as $basketProduct)
            <div class="border-[1px] border-gray-300 rounded-md overflow-hidden max-sm:mb-6">
                <img src="{{ $basketProduct->product->photo->url ?? ''}}" alt="product image" class="object-cover w-full md:w-[200px] h-[200px] border-b-[1px] border-gray-200" onerror="this.src='{{ App\Models\Photo::IMAGE_NOT_FOUND }}';"/>
                <div class="p-3 mt-2">
                    <h2 title="{{ $basketProduct->product->name }}" class="font-medium text-[16px] line-clamp-2">{{ $basketProduct->product->name }}</h2>
                    <div class="font-semibold font-mono text-[16px] text-[#4C71FB] mt-2">{{ number_format($basketProduct->product->formatted_price, 2) }}<span class="ml-1">₴</span></div>
                    <div class="flex flex-wrap gap-x-4 text-[#57647E]">
                        <div>
                            <span class="text-[.75em]">Quantity</span>
                            <div class="border-[1px] border-gray-200 px-3 py-1 rounded flex justify-center">{{ $basketProduct->count }}</div>
                        </div>
                        @if($basketProduct->product->clothing->size)
                            <div>
                                <span class="text-[.75em]">Size</span>
                                <div class="border-[1px] border-gray-200 px-3 py-1 rounded flex justify-center">{{ $basketProduct->product->clothing->size }}</div>
                            </div>
                        @endif
                        @if($basketProduct->product->clothing->color)
                            <div class="text-[#57647E]">
                                <span class="text-[.75em]">Color</span>
                                <div class="border-[1px] border-gray-200 px-3 py-1 rounded flex justify-center">{{ $basketProduct->product->clothing->color }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="border-t-[1px] border-gray-200 mt-8"></div>
    <div class="flex justify-end my-12 text-xl font-mono">
        <div class="font-semibold">Total<span class="tracking-tight ml-12">{{ number_format(basket()->formattedTotal(), 2, '.', ' ').' ₴' }}</span></div>
    </div>
    <div class="border-t-[1px] border-gray-200"></div>
    <form wire:submit="makeOrder">
        <div class="mt-8">
            <div class="font-medium">
                Full Name
            </div>
            <div class="sm:grid sm:grid-cols-2 gap-3 mt-4">
                <div>
                    @include('parts.form.input', [
                        'model' => 'name',
                        'placeholder' => '',
                    ])
                    <div class="text-[#57647E] text-[12px] mt-2 ml-0.5">First Name</div>
                </div>
                <div class="max-sm:mt-6">
                    @include('parts.form.input', [
                        'model' => 'lastName',
                        'placeholder' => '',
                    ])
                    <div class="text-[#57647E] text-[12px] mt-2 ml-0.5">Last Name</div>
                </div>
            </div>
        </div>
        <div class="mt-8">
            <div class="font-medium">
                E-mail
            </div>
            <div class="sm:grid sm:grid-cols-2 gap-3 mt-4">
                <div class="">
                    <label class="input input-bordered flex items-center gap-2 w-full max-sm:mt-3 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" /><path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" /></svg>
                        <input type="email" class="grow" placeholder="Email" wire:model="email"/>
                        <div class="absolute -bottom-5 bg-rose-400 rounded-lg">
                            @error('email') <span class="error p-1">{{ $message }}</span> @enderror
                        </div>
                    </label>
                    <div class="text-[#57647E] text-[12px] mt-2 ml-0.5">example@example.com</div>
                </div>
            </div>
        </div>
        <div class="mt-8">
            <div class="font-medium">
                Phone
            </div>
            <div class="sm:grid sm:grid-cols-2 gap-3 mt-4">
                <label class="input input-bordered flex items-center gap-2 w-full relative">
                    <i class="ri-phone-line"></i>
                    <input type="text" class="grow" placeholder="Phone" x-mask="+389 99 999 99 99" wire:model="phone"/>
                    <div class="absolute -bottom-5 bg-rose-400 rounded-lg">
                        @error('phone') <span class="error p-1">{{ $message }}</span> @enderror
                    </div>
                </label>
            </div>
        </div>
        <div class="border-t-[1px] border-gray-200 my-8"></div>
        <div class="mt-8">
            <div class="font-medium">
                Delivering
            </div>
            <div class="sm:grid sm:grid-cols-2 gap-3 mt-4">
                <div class="flex justify-center">
                    @include('parts.form.search-select', [
                        'value' => 'id',
                        'name' => 'name',
                        'search' => 'searchCity',
                        'options' => $cities,
                        'selected' => $selectedCity?->name ?? 'Choose City',
                        'select' => 'selectCity',
                        'zIndex' => 'z-[5]',
                        'model' => 'selectedCity'
                    ])
                </div>
                @if($selectedCity)
                    <div class="flex justify-center max-sm:mt-6">
                        @include('parts.form.search-select', [
                            'value' => 'id',
                            'name' => 'name',
                            'search' => 'searchWarehouse',
                            'options' => $warehouses,
                            'selected' => $selectedWarehouse?->name ?? 'Choose Warehouse',
                            'select' => 'selectWarehouse',
                            'zIndex' => 'z-[3]',
                            'model' => 'selectedWarehouse'
                        ])
                    </div>
                @endif
            </div>
        </div>
        <div class="border-t-[1px] border-gray-200 my-8"></div>
        <div class="mt-8">
            <div class="font-medium">
                Payment
            </div>
            <div class="grid grid-cols-2 gap-3 mt-4">
                <button type="button" wire:click="setPaymentMethod('{{ \App\Enums\PaymentMethodEnum::MONOBANK }}')" class="transition duration-200 grid h-20 flex-grow card bg-white border-2 rounded-box place-items-center @if($selectedPaymentMethod == \App\Enums\PaymentMethodEnum::MONOBANK) border-[#4A00FF] @endif">
                    <img src="https://asset.brandfetch.io/id-CBRc8NA/idbiSfkx2x.svg" alt="monobank method" class="w-[100px]">
                </button>
                <button type="button" wire:click="setPaymentMethod('{{ \App\Enums\PaymentMethodEnum::FONDY }}')" class="transition duration-200 grid h-20 flex-grow card bg-white border-2 rounded-box place-items-center @if($selectedPaymentMethod == \App\Enums\PaymentMethodEnum::FONDY) border-[#4A00FF] @endif">
                    <img src="{{ asset('images/fondy-main-light.svg') }}" alt="fondy method" class="w-[100px]">
                </button>
            </div>
        </div>
        <div class="flex justify-center mt-12">
            <button type="submit" class="btn btn-primary bg-[#4A00FF] font-mono text-lg tracking-wider">CONFIRM</button>
        </div>
    </form>
</div>

{{--<div class="container mx-auto max-w-[900px]">--}}
{{--    <div class="border-green-300 border-4 rounded-2xl">--}}
{{--        <table class="table">--}}
{{--            <!-- head -->--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th></th>--}}
{{--                <th>Name</th>--}}
{{--                <th>Count</th>--}}
{{--                <th>Price</th>--}}
{{--                <th></th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach(basket()->get() as $basketProduct)--}}
{{--                @include('livewire.order-product', compact('basketProduct'))--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--        <div class="float-right my-3">--}}
{{--            <p class="text-2xl font-bold">Total: <span class="font-normal">{{ number_format(basket()->formattedTotal(), 2, '.', ' ').' ₴' }}</span></p>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="card w-full bg-base-100 shadow-xl p-4 mx-auto mt-4 border-[1px] border-gray-200">--}}
{{--        <form wire:submit="makeOrder">--}}
{{--            <div class="sm:flex gap-5">--}}
{{--                <label class="input input-bordered flex items-center gap-2 w-full relative">--}}
{{--                    <i class="ri-phone-line"></i>--}}
{{--                    <input type="text" class="grow" placeholder="Phone" x-mask="+389 99 999 99 99" wire:model="phone"/>--}}
{{--                    <div class="absolute -bottom-5 bg-rose-400 rounded-lg">--}}
{{--                        @error('phone') <span class="error p-1">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}
{{--                </label>--}}
{{--                <label class="input input-bordered flex items-center gap-2 w-full max-sm:mt-3 relative">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" /><path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" /></svg>--}}
{{--                    <input type="email" class="grow" placeholder="Email" wire:model="email"/>--}}
{{--                    <div class="absolute -bottom-5 bg-rose-400 rounded-lg">--}}
{{--                        @error('email') <span class="error p-1">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}
{{--                </label>--}}
{{--            </div>--}}
{{--            <div class="sm:flex gap-5 sm:mt-5">--}}
{{--                <label class="input input-bordered flex items-center gap-2 w-full max-sm:mt-3 relative">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" /></svg>--}}
{{--                    <input type="text" class="grow" placeholder="First Name" wire:model="name"/>--}}
{{--                    <div class="absolute -bottom-5 bg-rose-400 rounded-lg">--}}
{{--                        @error('name') <span class="error p-1">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}
{{--                </label>--}}
{{--                <label class="input input-bordered flex items-center gap-2 w-full max-sm:mt-3">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" /></svg>--}}
{{--                    <input type="text" class="grow" placeholder="Last Name" />--}}
{{--                </label>--}}
{{--            </div>--}}
{{--            <div class="flex justify-center mt-5">--}}
{{--                @include('parts.form.search-select', [--}}
{{--                    'value' => 'id',--}}
{{--                    'name' => 'name',--}}
{{--                    'search' => 'searchCity',--}}
{{--                    'options' => $cities,--}}
{{--                    'selected' => $selectedCity?->name ?? 'Choose City',--}}
{{--                    'select' => 'selectCity',--}}
{{--                    'zIndex' => 'z-[5]'--}}
{{--                ])--}}
{{--            </div>--}}
{{--            @if($selectedCity)--}}
{{--                <div class="flex justify-center mt-5">--}}
{{--                    @include('parts.form.search-select', [--}}
{{--                        'value' => 'id',--}}
{{--                        'name' => 'name',--}}
{{--                        'search' => 'searchWarehouse',--}}
{{--                        'options' => $warehouses,--}}
{{--                        'selected' => $selectedWarehouse?->name ?? 'Choose Warehouse',--}}
{{--                        'select' => 'selectWarehouse',--}}
{{--                        'zIndex' => 'z-[3]'--}}
{{--                    ])--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <div class="flex w-full mt-3">--}}
{{--                <button type="button" wire:click="setPaymentMethod('{{ \App\Enums\PaymentMethodEnum::MONOBANK }}')" class="grid h-20 flex-grow card bg-white border-2 rounded-box place-items-center">--}}
{{--                    <img src="https://asset.brandfetch.io/id-CBRc8NA/idbiSfkx2x.svg" alt="monobank method" class="w-[100px]">--}}
{{--                </button>--}}
{{--                <div class="divider divider-horizontal"></div>--}}
{{--                <button type="button" wire:click="setPaymentMethod('{{ \App\Enums\PaymentMethodEnum::FONDY }}')" class="grid h-20 flex-grow card bg-white border-2 rounded-box place-items-center">--}}
{{--                    <img src="{{ asset('images/fondy-main-light.svg') }}" alt="fondy method" class="w-[100px]">--}}
{{--                </button>--}}
{{--            </div>--}}

{{--            <div class="float-right">--}}
{{--                <div class="my-3">--}}
{{--                    <p class="text-2xl font-bold">--}}
{{--                        Your payment method: {{ $selectedPaymentMethod }}--}}
{{--                    </p>--}}
{{--                </div>--}}

{{--                <div class="float-right mt-3">--}}
{{--                    <button type="submit" class="btn btn-primary">Confirm Order</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
