@push('meta-data')
    {{ seo()->getMeta($page) }}
@endpush

<div class="flex w-full">
    <div wire:loading wire:target="addToBasket"
        class="w-full h-full fixed top-0 left-0 bg-white opacity-75 z-50">
        <div class="flex justify-center items-center mt-[50vh]">
            <span class="loading loading-spinner w-[75px] text-neutral"></span>
        </div>
    </div>
    <div class="max-w-60 w-full">
        <div class="join join-vertical w-full">
            <div class="collapse collapse-arrow join-item border-base-300 border">
                <input type="checkbox" name="my-accordion-1" checked="checked" />
                <div class="collapse-title text-base font-medium">Ціна</div>
                <div class="collapse-content">
                    <div class="flex justify-between">
                        @include('parts.form.input', [
                            'model' => 'minPrice',
                            'placeholder' => '0',
                            'class' => '!w-[70px] h-8 text-sm',
                            'range' => 'true',
                            'static' => 'true',
                            'customModel' => '.live.debounce.999ms'
                        ])
                        <span class="">
                            -
                        </span>
                        @include('parts.form.input', [
                            'model' => 'maxPrice',
                            'placeholder' => '3 000',
                            'class' => '!w-[70px] h-8 text-sm',
                            'range' => 'true',
                            'static' => 'true',
                            'customModel' => '.live.debounce.999ms'
                        ])
                        <button class="btn btn-primary !min-h-8 !h-8 w-8" wire:click="products">OK</button>
                    </div>
                </div>
            </div>
            <div class="collapse collapse-arrow join-item border-base-300 border">
                <input type="checkbox" name="my-accordion-2" />
                <div class="collapse-title text-base font-medium">Розмір</div>
                <div class="collapse-content">
                    <div>
                        <div class="form-control">
                            @foreach($sizes as $size)
                                <label class="label cursor-pointer">
                                    <span class="label-text">{{ $size }}</span>
                                    <input type="checkbox" class="checkbox" value="{{ $size }}" wire:model.live="shopSizes"/>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse collapse-arrow join-item border-base-300 border">
                <input type="checkbox" name="my-accordion-3" />
                <div class="collapse-title text-base font-medium">Колір</div>
                <div class="collapse-content">
                    <div>
                        <div class="form-control">
                            @foreach($colors as $color)
                                <label class="label cursor-pointer">
                                    <span class="label-text">{{ $color }}</span>
                                    <input type="checkbox" class="checkbox" value="{{ $color }}" wire:model.live="shopColors"/>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse collapse-arrow join-item border-base-300 border">
                <input type="checkbox" name="my-accordion-4" />
                <div class="collapse-title text-base font-medium">Матеріал</div>
                <div class="collapse-content">
                    <p>hello</p>
                </div>
            </div>
        </div>

{{--        <div class="collapse collapse-arrow bg-base-200">--}}
{{--            <input type="checkbox" name="my-accordion-1" checked="checked" />--}}
{{--            <div class="collapse-title text-base font-medium">Click to open this one and close others</div>--}}
{{--            <div class="collapse-content">--}}
{{--                <p>hello</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="collapse collapse-arrow bg-base-200">--}}
{{--            <input type="checkbox" name="my-accordion-2" />--}}
{{--            <div class="collapse-title text-base font-medium collapse-close">Click to open this one and close others</div>--}}
{{--            <div class="collapse-content">--}}
{{--                <p>hello</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="collapse collapse-arrow bg-base-200">--}}
{{--            <input type="checkbox" name="my-accordion-3" />--}}
{{--            <div class="collapse-title text-base font-medium">Click to open this one and close others</div>--}}
{{--            <div class="collapse-content">--}}
{{--                <p>hello</p>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="ml-6 w-full">
        <div class="flex gap-8 w-full justify-between">
            @include('parts.form.input', [
                'model' => 'searchText',
                'class' => '!w-[500px]',
                'placeholder' => 'Search'
            ])

            @include('parts.form.select', [
                'model' => 'selectedSort',
                'options' => $sortOptions,
                'value' => 'value',
                'name' => 'name',
                'placeholder' => '',
                'class' => 'font-mono font-bold tracking-wider'
            ])
{{--            <div class="relative">--}}
{{--                За популярністю--}}
{{--                <button wire:click="toggleSortPopup" class="btn btn-primary">aboba</button>--}}
{{--                <dialog id="my_modal_2" class="modal absolute top-0 left-0" @if($openSortPopup) open @endif>--}}
{{--                    <div class="modal-box">--}}
{{--                        <h3 class="text-sm font-bold">Hello!</h3>--}}
{{--                        <p class="text-sm">Press ESC key or click outside to close</p>--}}
{{--                    </div>--}}
{{--                    <form method="dialog" class="modal-backdrop">--}}
{{--                        <button wire:click="toggleSortPopup">close</button>--}}
{{--                    </form>--}}
{{--                </dialog>--}}
{{--            </div>--}}
        </div>
        <div class="">
            <div wire:loading class="h-screen w-full bg-white">
                <div class="flex justify-center items-center mt-[50vh]">
                    <span class="loading loading-spinner w-[75px] text-neutral"></span>
                </div>
            </div>
            @if($products->isEmpty())
                <div class="h-screen flex items-center justify-center">
                    <h2 class="text-2xl font-bold font-mono">Not Found</h2>
                </div>
            @endif
            <div wire:loading.remove class="mx-auto container mt-5 gap-4 flex flex-wrap justify-between relative">
                @foreach($products as $product)
                    <div class="card w-[220px] bg-base-100 shadow-xl">
                        <figure class="cursor-pointer" wire:click="redirectToProduct('{{ $product->id }}')">
                            <img src="{{ $product->firstPhoto->url ?? '' }}" alt="Clothes" class="object-cover w-[220px] h-[220px]" onerror="this.src='{{ App\Models\Photo::IMAGE_NOT_FOUND }}';"/>
                        </figure>
                        <div class="card-body p-4 flex flex-column justify-between">
                            <div>
                                <h2 title="{{ $product->name.' '.$product->clothing->size }}" class="card-title cursor-pointer text-base line-clamp-2" wire:click="redirectToProduct('{{ $product->id }}')">{{ $product->name.' '.$product->clothing->size }}</h2>
                                <div class="mt-2">
                                    @foreach($product->sizes as $size)
                                        <a href="/products/{{ $size['product_id'] }}" class="badge badge-primary badge-outline text-xs">
                                            {{ $size['size'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-actions justify-between items-center mt-2">
                                <p class="font-bold my-auto">{{ number_format($product->formatted_price, 2, '.', ' ') }} грн</p>
                                <div class="justify-end">
                                    @if($basketProducts->contains('product_id', $product->id))
                                        <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay btn">Added</label>
                                    @else
                                        <button class="btn btn-primary"
                                                wire:click="addToBasket('{{ $product->id }}')"
                                                wire:loading.attr="disabled"
                                                wire:target="addToBasket">
                                            Add to Basket
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>

