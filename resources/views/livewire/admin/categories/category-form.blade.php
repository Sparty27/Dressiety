<form wire:submit.prevent="save">
    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Content</p>
        @include('parts.form.input', [
            'model' => 'category.name',
            'title' => 'Name'
        ])
    @endcomponent

        @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
            <p class="card-title">Image</p>
            <div class="object-cover w-[300px] h-[300px] relative">
                <img src="{{ $singleImage->photo->url ?? '' }}" alt="Category image" class="object-cover w-[300px] h-[300px]" onerror="this.src='{{ App\Models\Photo::IMAGE_NOT_FOUND }}';">
                <div wire:click="deletePhoto" class="rounded-xl cursor-pointer w-10 h-10 absolute top-3 right-3 bg-red-600 flex items-center justify-center">
                    <i class="ri-delete-bin-6-line"></i>
                </div>
            </div>
            <input type="file" class="file-input file-input-bordered w-full max-w-xs" wire:model="singleImage.uploadPhoto"/>
        @endcomponent

    <div class="flex items-center justify-center gap-3">
        <button class="btn btn-primary">Save</button>
        @include('parts.back', [
            'route' => 'admin.categories.index',
        ])
    </div>
</form>
