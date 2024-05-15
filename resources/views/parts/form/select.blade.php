<label class="form-control w-full max-w-xs">
    @if(isset($title))
    <div class="label">
        <span class="label-text">{{ $title }}</span>
    </div>
    @endif
    <select class="{{ $class ?? '' }} select select-bordered w-full max-w-xs
                @error($model) select-error @enderror
                @if(isset($small)) select-sm @endif"
                wire:model.live="{{ $model }}">
        <option value="" selected>{{ $placeholder }}</option>
        @foreach($options as $option)
            <option value="{{ $option->$value }}" style="background-image: url('https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=')">
                {{ $option->$name }}</option>
        @endforeach
    </select>
    @error($model)
    <div class="label">
        <span class="label-text-alt text-red-500">{{ $message }}</span>
    </div>
    @enderror
</label>
