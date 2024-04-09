<tr>
    <th>
        <div class="avatar">
            <div class="w-12 rounded-xl">
                <img src="{{ $basketProduct->product->photo->url }}" />
            </div>
        </div>
    </th>
    <td>
        {{ $basketProduct->product->name }}
    </td>
    <td>
        <div class="flex align-items-center">
            <button class="btn btn-circle" wire:click="decrement">
                -
            </button>
            <div>
                {{ $basketProduct->count }}
            </div>
            <button class="btn btn-circle" wire:click="increment">
                +
            </button>
        </div>

    </td>
    <td>
        {{ number_format($basketProduct->total, 2, '.', ' ') }}
    </td>
    <th>
        <button class="btn btn-ghost btn-xs" wire:click="remove" wire:loading.attr="disabled">
            <i class="ri-delete-bin-line"></i>
        </button>
    </th>
</tr>
