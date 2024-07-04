@push('meta-data')
    {{ seo()->getMeta($page) }}
@endpush

<div class="flex w-full">
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
                        ])
                        <span class="">
                            -
                        </span>
                        @include('parts.form.input', [
                            'model' => 'maxPrice',
                            'placeholder' => '3 000',
                            'class' => '!w-[70px] h-8 text-sm',
                            'range' => 'true',
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
                                    <input type="checkbox" class="checkbox" />
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
                            <label class="label cursor-pointer">
                                <span class="label-text">Чорний</span>
                                <input type="checkbox" class="checkbox" />
                            </label>
                            <label class="label cursor-pointer">
                                <span class="label-text">Білий</span>
                                <input type="checkbox" class="checkbox" />
                            </label>
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
    <div class="p-6 pt-0">
        <div class="flex gap-8 w-full">
            @include('parts.form.input', [
                'model' => 'searchText',
                'class' => '!w-[500px]',
                'placeholder' => 'Search'
            ])
        </div>
        <div class="mx-auto container mt-5 gap-4 flex flex-wrap justify-between">
            @foreach($products as $product)
                <div class="card w-[220px] bg-base-100 shadow-xl">
                    <figure class="cursor-pointer" wire:click="redirectToProduct('{{ $product->id }}')">
                        <img src="{{ $product->firstPhoto->url ?? '' }}" alt="Shoes" class="object-cover w-[220px] h-[220px]"/>
                    </figure>
                    <div class="card-body p-4 flex flex-column justify-between">
                        <h2 title="{{ $product->name }}" data-full-text="test" class="card-title cursor-pointer text-base line-clamp-2" wire:click="redirectToProduct('{{ $product->id }}')">{{ $product->name }}</h2>
                        <div class="card-actions justify-between items-center mt-2">
                            <p class="font-bold my-auto">{{ number_format($product->formatted_price, 2, '.', ' ') }} грн</p>
                            <div class="justify-end">
                                @if($basketProducts->contains('product_id', $product->id))
                                    <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay btn">Added</label>
                                @else
                                    <button class="btn btn-primary" wire:click="addToBasket('{{ $product->id }}')">Add to Basket</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>

