<tr>
    <td>
        <div class="avatar">
            <div class="w-12 rounded-xl">
                <img src="{{ $basketProduct->product->photo->url ?? ''}}" alt="product image" />
            </div>
        </div>
    </td>
    <td class="max-w-[200px] whitespace-normal break-words">
    <span class="font-medium">
        {{ $basketProduct->product->name ?? '' }}
    </span>
    </td>
    <td>
        <div class="flex items-center justify-between gap-2">
            <div>
                <button class="w-6 h-6 shadow-mg rounded-full m-auto hover:bg-gray-300" wire:click="decrement" wire:loading.attr="disabled">
                    <i class="ri-subtract-line"></i>
                </button>
            </div>
            <div>
                {{ $basketProduct->count ?? '' }}
            </div>
            <div>
                <button class="w-6 h-6 shadow-mg rounded-full m-auto hover:bg-gray-300" wire:click="increment" wire:loading.attr="disabled">
                    <i class="ri-add-line"></i>
                </button>
            </div>
        </div>

    </td>
    <td>
        {{ number_format($basketProduct->formatted_total ?? 0, 2, '.', ' ').' ₴' ?? '' }}
    </td>
    <td>
        <button class="btn btn-ghost max-sm:w-5 max-sm:h-5" wire:click="remove" wire:loading.attr="disabled">
            <i class="ri-delete-bin-line"></i>
        </button>
    </td>
</tr>
