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
        <p class="card-title">Delivery</p>
        <div class="mt-4">
            <div class="flex justify-between items-center gap-3">
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
            <div class="flex justify-between items-center gap-3 mt-5">
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
        <div class="text-center text flex justify-between items-center font-bold gap-3 mt-5">
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

    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Products</p>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Count</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderClass->orderProducts as $orderProduct)
                        <tr>
                            <td>
                                {{ $orderProduct->id }}
                            </td>
                            <td class="max-w-[300px]">
                                <div class="flex mt-1 gap-2 items-center max-w-[300px]">
                                    <div class="avatar">

                                        <div class="rounded overflow-hidden w-[40px] min-w-[40px]">
                                            <img src="{{ $orderProduct->product->firstPhoto->url ?? '' }}" onerror="this.src='{{ App\Models\Photo::IMAGE_NOT_FOUND }}';" width="40" height="40"/>
                                        </div>
                                    </div>
                                    <div class="text-xs text-wrap break-words">
                                        {{ $orderProduct->name }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $orderProduct->count }}
                            </td>
                            <td class="font-mono">
                                {{ $orderProduct->money_price }} ₴
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="flex justify-end font-mono font-semibold tracking-tight mt-8 text-lg">
                    Загалом: {{ number_format($orderClass->formattedTotal(), 2, '.', ' ') }}₴
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
