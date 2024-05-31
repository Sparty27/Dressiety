<div class="mx-auto p-6 container mt-5 gap-4 flex flex-wrap">
{{--    @foreach(App\Models\Product::with('photo')->take(25)->get() as $product)--}}
    @foreach($products as $product)
        <div class="card w-[250px] bg-base-100 shadow-xl mx-auto">
            <figure class="cursor-pointer" wire:click="redirectToProduct('{{ $product->id }}')">
                <img src="{{ $product->firstPhoto()->url }}" alt="Shoes" class="object-cover w-[250px] h-[250px]"/>
            </figure>
            <div class="card-body">
                <h2 class="card-title cursor-pointer" wire:click="redirectToProduct('{{ $product->id }}')">{{ $product->name }}</h2>
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
