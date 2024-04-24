<div class="flex items-center gap-3">
    <div class="avatar">
        <div class="mask mask-squircle w-12 h-12">
            <img
                src="{{ $url ?? 'https://media.istockphoto.com/id/1409329028/vector/no-picture-available-placeholder-thumbnail-icon-illustration-design.jpg?s=612x612&w=0&k=20&c=_zOuJu755g2eEUioiOUdz_mHKJQJn-tDgIAhQzyeKUQ=' }}"
                alt="{{ $alt }}" />
        </div>
    </div>
    @if(isset($name))
        <div class="">{{ $name }}</div>
    @endif
</div>
