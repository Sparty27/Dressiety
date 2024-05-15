<div class="flex items-center gap-3">
    <div class="avatar">
        <div class="w-12 h-12 rounded-xl">
            <img
                src="{{ $url ?? App\Models\Photo::IMAGE_NOT_FOUND }}"
                alt="{{ $alt }}" />
        </div>
    </div>
    @if(isset($name))
        <div class="">{{ $name }}</div>
    @endif
</div>
