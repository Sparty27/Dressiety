<div class="mx-auto p-6 container mt-5 gap-4 grid max-[830px]:grid-cols-1 min-[830px]:grid-cols-3 xl:grid-cols-4">
    @foreach(App\Models\Product::with('photo')->take(25)->get() as $product)
        <div class="card max-sm:w-full sm:w-[295x] bg-base-100 shadow-xl mx-auto">
            <figure class=""><img src="{{ $product->photo->url }}" alt="Shoes" class="object-cover"/></figure>
            <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                <p>If a dog chews shoes whose shoes does he choose?</p>
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
