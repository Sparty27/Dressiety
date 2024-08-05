<div class="drawer-side z-10">
    <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="menu p-4 min-h-full bg-base-200 max-sm:w-screen w-[590px]">
        <label for="my-drawer-3" aria-label="open sidebar" class="cursor-pointer flex flex-row-reverse">
            <i class="ri-close-line cursor-pointer text-2xl"></i>
        </label>
        <div class="overflow-auto">
            @if(!basket()->isEmpty())
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
                    @foreach($basketProducts as $basketProduct)
                        @include('livewire.basket-product', [
                            'basketProduct' => $basketProduct
                        ])
                    @endforeach
                    </tbody>
                </table>
                <div class="float-right mt-3">
                    <p class="text-2xl font-bold">Total: <span class="font-normal">{{ basket()->moneyTotal() }}</span></p>
                    <div class="">
                        <a class="btn btn-primary mt-3 w-full font-mono text-lg" href="{{ route('order.make') }}">Make Order</a>
                    </div>
                </div>
            @else
                <div class="flex justify-center font-bold text-2xl">
                    Пусто
                </div>
            @endif
        </div>
    </div>
</div>

