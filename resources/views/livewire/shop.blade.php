<div class="mx-auto mt-5 gap-4 grid max-[830px]:grid-cols-1 min-[830px]:grid-cols-2 xl:grid-cols-3">
    @foreach($products as $product)
        <div class="card max-sm:w-full sm:w-96 bg-base-100 shadow-xl mx-auto">
            <figure class=""><img src="{{ $product->photo->url }}" alt="Shoes" class="object-cover"/></figure>
            <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
                <div class="card-actions justify-content-between">
                    <p class="font-bold">{{ $product->price }} грн</p>
                    <button class="btn btn-primary" wire:click="addToBasket('{{ $product->id }}')">Add to Basket</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
