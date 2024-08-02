<form wire:submit.prevent="save">
    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Customer</p>
        @include('parts.form.input', [
            'model' => 'order.name',
            'title' => 'Name'
        ])
        @include('parts.form.input', [
            'model' => 'order.email',
            'title' => 'Email'
        ])
        @include('parts.form.input', [
            'model' => 'order.phone',
            'title' => 'Phone'
        ])
{{--        @include('parts.form.textarea', [--}}
{{--            'model' => 'product.description',--}}
{{--            'title' => 'Description',--}}
{{--            'class' => 'max-h-[400px]'--}}
{{--        ])--}}
    @endcomponent

    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Products</p>
            <div class="flex flex-wrap justify-between gap-6 mt-5">
                @foreach($orderClass->orderProducts as $orderProduct)
                    <div class="border-[1px] border-gray-300 rounded-md overflow-hidden max-w-[200px]">
                        <img src="{{ $orderProduct->product->photo->url ?? ''}}" alt="product image" width="200" class="object-cover w-[200px] h-[200px] border-b-[1px] border-gray-200" onerror="this.src='{{ App\Models\Photo::IMAGE_NOT_FOUND }}';"/>
                        <div class="p-3 mt-2">
                            <h2 title="{{ $orderProduct->name }}" class="font-medium text-[16px] line-clamp-2">{{ $orderProduct->name }}</h2>
                            <div class="font-semibold font-mono text-[16px] text-[#4C71FB] mt-2">{{ number_format($orderProduct->formatted_price, 2) }}<span class="ml-1">₴</span></div>
                            <div class="flex flex-wrap gap-x-4 text-[#57647E]">
                                <div>
                                    <span class="text-[.75em]">Quantity</span>
                                    <div class="border-[1px] border-gray-200 px-3 py-1 rounded flex justify-center">{{ $orderProduct->count }}</div>
                                </div>
                                @if($orderProduct->product->clothing->size)
                                    <div>
                                        <span class="text-[.75em]">Size</span>
                                        <div class="border-[1px] border-gray-200 px-3 py-1 rounded flex justify-center">{{ $orderProduct->product->clothing->size }}</div>
                                    </div>
                                @endif
                                @if($orderProduct->product->clothing->color)
                                    <div class="text-[#57647E]">
                                        <span class="text-[.75em]">Color</span>
                                        <div class="border-[1px] border-gray-200 px-3 py-1 rounded flex justify-center">{{ $orderProduct->product->clothing->color }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    @endcomponent

    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Delivery</p>
            <div class="mt-4">
                <div class="flex items-center gap-3">
                    <div class="font-bold text">
                        Місто:
                    </div>
                    @include('parts.form.search-select', [
                        'value' => 'id',
                        'name' => 'name',
                        'search' => 'searchCity',
                        'options' => $cities,
                        'selected' => $selectedCity?->name ?? 'Choose City',
                        'select' => 'selectCity',
                        'zIndex' => 'z-[5]',
                        'model' => 'selectedCity',
//                        'disabled' => (!$orderClass->orderDelivery->status->editable())
                    ])
                </div>
                <div class="flex items-center gap-3 mt-5">
                    <div class="font-bold text">
                        Відділення:
                    </div>
                    @include('parts.form.search-select', [
                        'value' => 'id',
                        'name' => 'name',
                        'search' => 'searchWarehouse',
                        'options' => $warehouses,
                        'selected' => $selectedWarehouse?->name ?? 'Choose Warehouse',
                        'select' => 'selectWarehouse',
                        'zIndex' => 'z-[3]',
                        'model' => 'selectedWarehouse',
//                        'disabled' => (!$orderClass->orderDelivery->status->editable())
                    ])
                </div>
            </div>
            <div class="text-center text flex items-center font-bold gap-3 mt-5">
                <div class="">
                    ТТН:
                </div>
                @include('parts.form.input', [
                    'model' => 'ttn',
                    'small' => true,
                    'placeholder' => '',
                    'attributes' => 'maxLength=17',
                    'mask' => '99 9999 9999 9999',
                ])
            </div>
            <div class="text-center text flex items-center font-bold gap-3 mt-5">
                <div class="">
                    Статус доставки:
                </div>
                <div>
                    {{ trans('delivery.'.$orderClass->orderDelivery?->status->value) }}
                </div>
            </div>
    @endcomponent

    <div class="flex items-center justify-center gap-3">
        <button class="btn btn-primary">Save</button>
        @include('parts.back', [
            'route' => 'admin.orders.index',
        ])
    </div>
</form>
