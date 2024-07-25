<label class="form-control w-full max-w-xs">
    @if(isset($title))
    <div class="label">
        <span class="label-text">{{ $title }}</span>
    </div>
    @endif
    <select class="select select-bordered w-full max-w-xs
                @error($model) select-error @enderror
                @if(isset($small)) select-sm @endif
                {{ $class ?? '' }} "
                wire:model.live="{{ $model }}">
        @if(isset($showPlaceholder))
            <option value="" selected>{{ $placeholder }}</option>
        @endif
        @foreach($options as $option)
            <option value="{{ $option[$value] }}">
                {{ $option[$name] }}
            </option>
        @endforeach
    </select>
    @error($model)
    <div class="label">
        <span class="label-text-alt text-red-500">{{ $message }}</span>
    </div>
    @enderror
</label>
