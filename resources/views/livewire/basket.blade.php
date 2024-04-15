<div class="drawer-side z-10">
    <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="menu p-4 min-h-full bg-base-200 max-sm:w-screen">
        <label for="my-drawer-3" aria-label="open sidebar" class="cursor-pointer flex flex-row-reverse">
            <i class="ri-close-line cursor-pointer text-2xl"></i>
        </label>
        <div class="overflow-auto">
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach(basket()->get() as $basketProduct)
                    @livewire('basket-product', compact('basketProduct'), key($basketProduct->id))
                @endforeach
                </tbody>
            </table>
            <div class="float-right mt-3">
                <p class="text-2xl font-bold">Total: <span class="font-normal">{{ number_format(basket()->formattedTotal(), 2, '.', ' ').' ₴' }}</span></p>
                <div class="">
                    <a class="btn btn-primary mt-3 w-full" href="{{ route('order.make') }}">Make order</a>
                </div>
            </div>
        </div>
    </div>
</div>

