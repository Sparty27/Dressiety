<div class="drawer-side">
    <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="menu p-4 w-[600px] min-h-full bg-base-200">
        <div class="overflow-x-auto">
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
            <h3>TOTAL: {{ basket()->total() }}</h3>
            <a href="{{ route('order.make') }}">Make order</a>
        </div>
    </div>
</div>

