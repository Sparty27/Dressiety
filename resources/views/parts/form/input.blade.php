<label class="form-control w-full @if(isset($small)) max-w-xs @endif">
    @if(isset($title))
    <div class="label">
        <span class="label-text">{{ $title }}</span>
    </div>
    @endif
    <input type="text" placeholder="{{ $title ?? 'Type here' }}" class="{{ $class ?? '' }} input input-bordered w-full
            @if(isset($small)) input-sm max-w-xs @endif
            @error($model) input-error @enderror"
            @if(isset($type) && $type == 'money')
                x-mask:dynamic="$money($input, '.', ' ')"
            @endif
            wire:model.live="{{ $model }}"/>
    @error($model)
    <div class="label">
        <span class="label-text-alt text-red-500">{{ $message }}</span>
    </div>
    @enderror
</label>
