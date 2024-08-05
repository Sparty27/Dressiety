<tr>
    <td>
        <div class="avatar">
            <div class="w-12 rounded-xl">
                @include('parts.ui.image', [
                    'src' => $basketProduct->product?->photo?->url,
                    'alt' => 'Product image'
                ])
            </div>
        </div>
    </td>
    <td class="max-w-[200px] whitespace-normal break-words">
        <span class="font-medium" title="{{ $basketProduct->product?->name }}">
            {{ $basketProduct->description }}
        </span>
    </td>
    <td>
        <div class="flex items-center justify-between gap-2">
            <div>
                <button class="w-6 h-6 shadow-mg rounded-full m-auto hover:bg-gray-300" wire:click="decrement('{{ $basketProduct->id }}')" wire:loading.attr="disabled">
                    <i class="ri-subtract-line"></i>
                </button>
            </div>
            <div>
                {{ $basketProduct->count ?? '' }}
            </div>
            <div>
                <button class="w-6 h-6 shadow-mg rounded-full m-auto hover:bg-gray-300" wire:click="increment('{{ $basketProduct->id }}')" wire:loading.attr="disabled">
                    <i class="ri-add-line"></i>
                </button>
            </div>
        </div>
    </td>
    <td>
        <div class="min-w-max w-max">
            {{ $basketProduct->formatted_money_total }}
        </div>
    </td>
    <td>
        <button class="btn btn-ghost max-sm:w-5 max-sm:h-5" wire:click="remove('{{ $basketProduct->id }}')" wire:loading.attr="disabled">
            <i class="ri-delete-bin-line"></i>
        </button>
    </td>
</tr>
