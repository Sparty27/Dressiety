<div>
{{--    <div class="flex justify-between items-end mb-8">--}}
{{--        <div class="flex gap-8 w-full">--}}
{{--            @include('parts.form.input', [--}}
{{--                'title' => 'Search',--}}
{{--                'model' => 'searchText',--}}
{{--                'small' => true--}}
{{--            ])--}}
{{--        </div>--}}

{{--        <a href="{{ route('admin.tags.create')}}" class="btn btn-primary btn-sm">--}}
{{--            <i class="ri-add-circle-line"></i>--}}
{{--        </a>--}}
{{--    </div>--}}


    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th class="cursor-pointer">
                    <div class="flex items-center gap-1">
                        ID
                    </div>
                </th>
                <th>
                    <div class="flex items-center gap-1">
                        Products
                    </div>
                </th>
                <th>Payment</th>
                <th>Delivery</th>
                <th>Order Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="font-black">
                            {{ $order->id }}
                        </td>
                        <td class="max-w-[200px]">
                            <div>
                                @foreach($order->orderProducts as $orderProduct)
                                    <div class="flex mt-1 gap-2 items-center">
                                        <div class="avatar">

                                            <div class="rounded overflow-hidden w-[40px] min-w-[40px]">
                                                <img src="{{ $orderProduct->product->firstPhoto->url ?? '' }}" onerror="this.src='{{ App\Models\Photo::IMAGE_NOT_FOUND }}';" width="40" height="40"/>
                                            </div>
                                        </div>
                                        <div class="text-xs text-wrap break-words">
                                            {{ $orderProduct->product == null ? $orderProduct->name : $orderProduct?->product?->name.' '.$orderProduct->product?->clothing->size }} x {{ $orderProduct->count }}
                                        </div>
                                    </div>
                                @endforeach
                                <div class="font-mono font-semibold tracking-tight mt-3 border-t-[1px] border-t-gray-200">
                                    {{ number_format($order->formattedTotal(), 2, '.', ' ') }}₴
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-semibold font-mono text-xs uppercase tracking-wider flex flex-col gap-2 items-center">
                                <div class="border-[1px] rounded p-3 shadow">
                                    @switch($order->orderTransaction?->type)
                                        @case(\App\Enums\PaymentMethodEnum::FONDY)
                                            <img src="https://asset.brandfetch.io/id-CBRc8NA/idbiSfkx2x.svg" alt="monobank method" class="w-[60px]">
                                        @break
                                        @case(\App\Enums\PaymentMethodEnum::MONOBANK)
                                            <img src="{{ asset('images/fondy-main-light.svg') }}" alt="fondy method" class="w-[60px]">
                                        @break
                                    @endswitch
                                </div>

                                <div class="text-[10px]
                                    @switch($order->orderTransaction?->status)
                                        @case(\App\Enums\PaymentStatusEnum::SUCCESS)
                                        text-lime-600
                                        @break
                                        @case(\App\Enums\PaymentStatusEnum::PROCESS)
                                        text-blue-500
                                        @break
                                        @case(\App\Enums\PaymentStatusEnum::FAILED)
                                        text-red-700
                                        @break
                                    @endswitch
                                ">
                                    {{ trans('payment.'.$order->orderTransaction?->status->value) }}
                                </div>
                            </div>
                        </td>
                        <td class="max-w-[200px]">
                            <div class="font-semibold text-xs tracking-wider font-mono">
                                <div>
                                    Новою Поштою
                                </div>
                                <div class="font-normal text-[10px] text-gray-500" title="{{ $order->orderDelivery?->warehouse->city->name.', '.$order->orderDelivery?->warehouse->name }}">
                                    <div>
                                        {{ $order->orderDelivery?->warehouse->city->name }}
                                    </div>
                                    <div>
                                        {{ $order->orderDelivery?->warehouse->name }}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    {{ trans('delivery.'.$order->orderDelivery?->status->value) }}
                                </div>

{{--                                @switch($order->orderDelivery->status)--}}
{{--                                    @case(\App\Enums\DeliveryStatusEnum::PROCESS)--}}
{{--                                        process--}}
{{--                                        @break--}}
{{--                                    @case(\App\Enums\DeliveryStatusEnum::DELIVERIED)--}}
{{--                                        del--}}
{{--                                        @break--}}
{{--                                    @case(\App\Enums\DeliveryStatusEnum::CANCELED)--}}
{{--                                        text-red-700--}}
{{--                                        @break--}}
{{--                                    @case(\App\Enums\DeliveryStatusEnum::RETURNED)--}}
{{--                                        text-red-700--}}
{{--                                        @break--}}
{{--                                @endswitch--}}
                            </div>
                        </td>
                        <td></td>
                        <td>
                            <div class="flex gap-1 justify-end items-center">
                                <a class="btn btn-sm border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="#">
                                    <i class="ri-eye-line"></i>
                                </a>
                                <a class="btn btn-sm border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="#">
                                    <i class="ri-pencil-line"></i>
                                </a>

                                <button type="button" class="btn btn-sm btn-danger bg-red-600 hover:bg-red-700 text-white">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
{{--            @foreach($tags as $tag)--}}
{{--                <tr class="hover">--}}
{{--                    <td class="font-black">{{$tag->id}}</td>--}}
{{--                    <td>{{$tag->name}}</td>--}}
{{--                    <td>--}}
{{--                        <input type="checkbox" class="toggle" wire:click="toggleVisible('{{ $tag->id }}')" @if($tag->status) checked @endif/>--}}
{{--                    </td>--}}
{{--                    <td>{{$tag->created_at}}</td>--}}
{{--                    <td>{{$tag->updated_at}}</td>--}}
{{--                    <td>--}}
{{--                        <div class="flex gap-3 items-center">--}}
{{--                            <a class="btn btn-sm border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="{{route('admin.tags.edit', $tag)}}">--}}
{{--                                <i class="ri-pencil-line"></i>--}}
{{--                            </a>--}}

{{--                            <button type="button" class="btn btn-sm btn-danger bg-red-600 hover:bg-red-700 text-white" wire:click="toggleDeleteModal('{{ $tag->id }}')">--}}
{{--                                <i class="ri-delete-bin-line"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
            </tbody>
        </table>

{{--        @include('parts.delete-modal', [--}}
{{--            'model' => $deleteTag,--}}
{{--            'open' => $open,--}}
{{--            'deleteMethod' => 'delete',--}}
{{--            'toggleMethod' => 'toggleDeleteModal',--}}
{{--            'transPath' => 'pages.admin.tags.delete',--}}
{{--        ])--}}

        {{ $orders->links() }}
    </div>
</div>
