<div x-data="{ visible: @entangle('visible').live, duration: $wire.entangle('duration') }"
     x-show="visible"
     x-on:show-popup.window="
         visible = true;
         setTimeout(() => {
             visible = false;
             $wire.hidePopup();
         }, {{ $duration }});
         console.log({{ $duration }});
     "
     class="fixed top-[50px] right-[25px] flex items-center justify-center z-50 transition-opacity duration-300 max-w-[300px]"
     x-transition:enter="ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div :class="`{{ $color }} p-4 rounded shadow-lg`">
        <p title="{{ $message }}" class="line-clamp-3 text-white">{{ $message }}</p>
    </div>
</div>
