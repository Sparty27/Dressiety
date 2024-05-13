<label class="form-control">
    @if(isset($title))
    <div class="label">
        <span class="label-text">{{ $title }}</span>
    </div>
    @endif
    <textarea class="textarea textarea-bordered h-24 @error($model) textarea-error @enderror"
              placeholder="{{ $title ?? 'Type here' }}"
              wire:model.live="{{ $model }}"></textarea>
    @error($model)
    <div class="label">
        <span class="label-text-alt text-red-500">{{ $message }}</span>
    </div>
    @enderror
</label>
