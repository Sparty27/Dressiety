<tr>
    <td>
        <div class="avatar">
            <div class="w-12 rounded-xl">
                <img src="{{ $basketProduct->product->photo->url ?? ''}}" alt="product image" />
            </div>
        </div>
    </td>
    <td>
    <span class="font-medium">
        {{ $basketProduct->product->name ?? '' }}
    </span>
    </td>
    <td>
        <div class="flex items-center justify-between gap-1">
            <div>
                {{ $basketProduct->count ?? '' }}
            </div>
        </div>

    </td>
    <td>
        {{ number_format($basketProduct->total ?? 0, 2, '.', ' ').' ₴' ?? '' }}
    </td>
</tr>
