<div>
    <form wire:submit="save" class="max-w-xs border-[3px] border-blue-200 rounded-[15px] p-6">
        @csrf
        <label class="form-control w-full font-bold px-[4px]">Name</label>
        <input name="name" type="text" placeholder="Type here" wire:model="name" class="input w-full max-w-xs mt-6 border-2 border-gray-200" />
        <div class="form-control mt-6">
            <label class="label cursor-pointer font-bold">
                <span class="font-bold">Status</span>
                <input name="status" type="checkbox" class="toggle" wire:model="status" {{ $tag->status==1?'checked':''}} />
            </label>
        </div>
        <div class="mt-6 flex justify-between">
            <button class="btn btn-primary">Edit</button>
            <a class="btn" href="{{route('admin.tags.show', $tag)}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
        </div>
    </form>
</div>
