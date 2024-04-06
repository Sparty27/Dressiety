<div class="flex flex-wrap w-[1248px] mx-auto mt-5 gap-4">
    @foreach($products as $product)
        <div class="card w-96 bg-base-100 shadow-xl">
            <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
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
