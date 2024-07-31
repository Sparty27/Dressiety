@push('meta-data')
    {{ seo()->getMeta($product) }}
@endpush

<div class="relative">
    <div wire:loading
         class="w-full h-full fixed top-0 left-0 bg-white opacity-75 z-50">
        <div class="flex justify-center items-center mt-[50vh]">
            <span class="loading loading-spinner w-[75px] text-neutral"></span>
        </div>
    </div>
    <div class="relative h-16">
        <a class="btn float-right" href="#" onclick="javascript:window.history.back(-1);return false;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
    </div>
    <div class="flex gap-4">
        <div class="carousel w-1/2 h-[450px]">
            @foreach($product->orderPhotos as $photo)
                <div id="slide{{ $photo->priority }}" class="carousel-item relative w-full">
                    <img src="{{ $photo->url }}" class="object-cover h-[400px] mx-auto my-auto" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a id="test" href="#slide{{ $photo->priority - 1 }}" class="btn btn-circle">❮</a>
                        <a id="test" href="#slide{{ $photo->priority + 1 }}" class="btn btn-circle">❯</a>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="w-1/2 border-[1px] shadow-lg px-6">
            <h2 class="font-bold text-2xl mt-3">{{ $product->name }}</h2>
            <div class="flex justify-end mt-3">
                Код: {{ $product->vendor_code }}
            </div>
            <div class="mt-3">
                Розмір виробника: <span class="font-bold">{{ $product->clothing->size }}</span>
            </div>
            <div class="mt-3">
                @foreach($product->availableSizes as $size)
                    <a href="/products/{{ $size['product_id'] }}" class="badge badge-primary @if($product->clothing->size != $size['size']) badge-outline @endif badge-lg hover:bg-[#4A00FF] hover:text-[#D1DBFF]">
                        {{ $size['size'] }}
                    </a>
                @endforeach
            </div>
            <div class="flex mt-3">
                <div>
                    <span class="font-mono text-xl font-bold">
                        {{ $product->formatted_price }}₴
                    </span>
                    @if($product->count > 0)
                        <span class="text-green-600">
                            є в наявності
                        </span>
                    @else
                        <span class="text-red-600">
                            немає в наявності
                        </span>
                    @endif
                </div>
            </div>
            <div class="mt-3">
                @if(basket()->get()->contains('product_id', $product->id))
                    <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay btn">
                        Remove from Basket
                    </label>
                @else
                    <button class="btn btn-primary text-lg" wire:click="addToBasket('{{ $product->id }}')">
                        <i class="ri-shopping-cart-line"></i>
                        Add to Basket
                    </button>
                @endif
            </div>
            <div class="mt-6">
                <span class="font-bold font-mono text-lg">
                    Опис:
                </span>
                <p class="">{!! $product->description !!}</p>
            </div>
        </div>
    </div>

{{--    <a class="btn absolute top-0 right-0" href="{{route('shop')}}">--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />--}}
{{--        </svg>--}}
{{--    </a>--}}

{{--    <div class="p-3 border-2 border-gray-200 max-w-4xl w-full rounded-xl shadow">--}}
{{--        <div class="flex">--}}
{{--            <div class="max-w-36 w-full ">--}}
{{--                <span class="">Name: </span>--}}

{{--            </div>--}}
{{--            <div>--}}
{{--                {{ $product->name }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="flex mt-5">--}}
{{--            <div class="max-w-36 w-full ">--}}
{{--                <span class="">Price: </span>--}}

{{--            </div>--}}
{{--            <div>--}}
{{--                {{ $product->formatted_price }} ₴--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="flex mt-5 items-center">--}}
{{--            <div class="max-w-36 w-full ">--}}
{{--                <span class="">Category: </span>--}}

{{--            </div>--}}
{{--            <div class="flex items-center">--}}
{{--                <div class="avatar">--}}
{{--                    <div class="w-8 rounded-xl">--}}
{{--                        <img src="{{ $product->category->photo?->getUrl() ?? App\Models\Photo::IMAGE_NOT_FOUND }}" />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="ml-5">--}}
{{--                {{ $product->category->name }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="mt-5">--}}
{{--            <span class="">Images:</span>--}}
{{--            <div class="grid grid-cols-3 gap-8 border-2 p-3 rounded-xl mt-3">--}}
{{--                @foreach($product->photos as $photo)--}}
{{--                    <div class="flex justify-center items-center">--}}
{{--                        <img class="w-full max-w-56 rounded-lg" src="{{ $photo?->getUrl() ?? App\Models\Photo::IMAGE_NOT_FOUND }}">--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
