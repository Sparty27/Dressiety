@push('meta-data')
    {{ seo()->getMeta($page) }}
@endpush

<div class="flex flex-col sm:flex-row w-full">
    <div wire:loading wire:target="addToBasket"
        class="w-full h-full fixed top-0 left-0 bg-white opacity-75 z-50">
        <div class="flex justify-center items-center mt-[50vh]">
            <span class="loading loading-spinner w-[75px] text-neutral"></span>
        </div>
    </div>
    <div class="max-w-60 w-full mx-auto">
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
{{--            <div class="collapse collapse-arrow join-item border-base-300 border">--}}
{{--                <input type="checkbox" name="my-accordion-4" />--}}
{{--                <div class="collapse-title text-base font-medium">Матеріал</div>--}}
{{--                <div class="collapse-content">--}}
{{--                    <p>hello</p>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
    <div class="sm:ml-6 lg:w-full">
        <div class="flex flex-col md:flex-row gap-3 md:gap-8 w-full items-center sm:items-start">
            @include('parts.form.input', [
                'model' => 'searchText',
                'class' => '!w-[238px] lg:!w-[400px] mt-3 sm:mt-0 mx-auto sm:mx-0',
                'placeholder' => 'Search'
            ])
            @include('parts.form.select-enum', [
                'model' => 'selectedSort',
                'options' => \App\Enums\SortProductEnum::cases(),
                'value' => 'value',
                'name' => 'name',
                'placeholder' => 'Оберіть сортування',
                'showPlaceholder' => true,
                'class' => 'font-mono font-bold tracking-wider',
                'classLabel' => '!max-w-[238px]'
            ])
        </div>
        <div class="">
            <div wire:loading wire:target.except="addToBasket" class="h-screen w-full bg-white">
                <div class="flex justify-center items-center mt-[50vh]">
                    <span class="loading loading-spinner w-[75px] text-neutral"></span>
                </div>
            </div>
            @if($products->isEmpty())
                <div class="h-screen flex items-center justify-center">
                    <h2 class="text-2xl font-bold font-mono">Not Found</h2>
                </div>
            @endif
            <div wire:loading.remove wire:target.except="addToBasket" class="mx-auto lg:container mt-5
             gap-4 flex flex-wrap justify-center sm:justify-between
{{--             grid gap-4 grid-cols-5--}}
             relative">
                @foreach($products as $product)
                    <div class="card w-[220px] bg-base-100 shadow-xl">
                        <figure class="cursor-pointer" wire:click="redirectToProduct('{{ $product->id }}')">
                            <img src="{{ $product->firstPhoto->url ?? '' }}" alt="Clothes" class="object-cover w-[220px] h-[220px]" onerror="this.src='{{ App\Models\Photo::IMAGE_NOT_FOUND }}';"/>
                        </figure>
                        <div class="card-body p-4 flex flex-column justify-between">
                            <div>
                                <h2 title="{{ $product->full_title }}" class="card-title cursor-pointer text-base line-clamp-2" wire:click="redirectToProduct('{{ $product->id }}')">{{ $product->full_title }}</h2>
                                <div class="mt-2">
                                    @foreach($product->availableSizes as $availableSize)
                                        <a href="/products/{{ $availableSize->product_id }}" class="badge badge-primary badge-outline text-xs hover:bg-[#4A00FF] hover:text-[#D1DBFF] transition duration-200">
                                            {{ $availableSize->size }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-actions justify-between items-center mt-2">
                                <p class="font-bold my-auto">{{ $product->money_price }} грн</p>
                                <div class="justify-end">
                                    @if(basket()->contains($product))
                                        <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay btn">Added</label>
                                    @elseif($product->count == 0)
                                        <label class="font-semibold mr-5">Out of stock</label>
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
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
</div>

