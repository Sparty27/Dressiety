@push('meta-data')
    {{ seo()->getMeta($product) }}
@endpush

<div class="relative">
    <div class="relative h-16">
        <a class="btn float-right" href="{{route('shop')}}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
    </div>
    <div class="flex gap-4">
        <div class="carousel w-1/2">
            @foreach($product->orderPhotos as $photo)
                <div id="slide{{ $photo->priority }}" class="carousel-item relative w-full">
                    <img src="{{ $photo->url }}" class="object-cover h-[400px] mx-auto" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide{{ $photo->priority - 1 }}" class="btn btn-circle">❮</a>
                        <a href="#slide{{ $photo->priority + 1 }}" class="btn btn-circle">❯</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-1/2 border-[1px] shadow-lg px-6">
            <h2 class="font-bold text-2xl mt-3">{{ $product->name }}</h2>
            <p class="mt-3">{!! $product->description !!}</p>
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
