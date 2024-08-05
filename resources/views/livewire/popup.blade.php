<div x-data="{ visible: @entangle('visible').live }"
     x-show="visible"
     x-cloak
     x-on:show-popup.window="
         visible = true;
         setTimeout(() => {
             visible = false;
             $wire.hidePopup();
         }, $wire.duration);
     "
     class="fixed top-[50px] right-[25px] flex items-center justify-center z-50 transition-opacity duration-300 max-w-[300px]"
     x-transition:enter="ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div :class="`{{ $color }} p-4 rounded shadow-lg`">
        <p title="{{ $message }}" class="line-clamp-3 text-white flex items-center gap-3">
            @if(str_contains($color, 'blue'))
                <i class="ri-information-line"></i>
            @elseif(str_contains($color, 'green'))
                <i class="ri-checkbox-circle-line"></i>
            @elseif(str_contains($color, 'red'))
                <i class="ri-alarm-warning-line"></i>
            @elseif(str_contains($color, 'yellow'))
                <i class="ri-error-warning-line"></i>
            @endif
            <span>
                {{ $message }}
            </span>
        </p>
    </div>
</div>
