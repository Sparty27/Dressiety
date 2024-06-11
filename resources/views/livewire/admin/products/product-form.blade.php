<form wire:submit.prevent="save">
    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Content</p>
        @include('parts.form.input', [
            'model' => 'product.name',
            'title' => 'Name'
        ])
        @include('parts.form.textarea', [
            'model' => 'product.description',
            'title' => 'Description',
            'class' => 'max-h-[400px]'
        ])
    @endcomponent
    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Attributes</p>
        @include('parts.form.input', [
            'model' => 'product.price',
            'title' => 'Price',
            'type' => 'money'
        ])

        @include('parts.form.select', [
            'title' => 'Categories',
            'model' => 'product.category_id',
            'options' => $categories,
            'value' => 'id',
            'name' => 'name',
            'placeholder' => 'Choose category'
        ])
        <div class="max-w-32">
            @include('parts.form.toggle', [
                'title' => 'Visible',
                'model' => 'product.status'
            ])
        </div>

        @include('parts.form.input', [
            'model' => 'product.count',
            'title' => 'Count'
    ])
    @endcomponent

    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <ul wire:sortable="renderImages" class="flex gap-3 flex-wrap">
            @foreach($gallery->photos as $photo)
                <div wire:sortable.item="{{ $photo['id'] }}" draggable="true" class="object-cover w-[300px] h-[300px] relative">
                    <img src="{{ $photo['url'] }}" alt="photo" class="object-cover w-[300px] h-[300px]" onerror="this.src='{{ App\Models\Photo::IMAGE_NOT_FOUND }}';">
                    <div class="rounded-xl cursor-grab w-10 h-10 absolute bottom-3 right-3 bg-yellow-400 flex items-center justify-center" wire:sortable.handle>
                        <i class="ri-drag-move-2-line text-2xl"></i>
                    </div>
                    <div wire:click="deletePhoto('{{ $photo['id'] }}')" class="rounded-xl cursor-pointer w-10 h-10 absolute top-3 right-3 bg-red-600 flex items-center justify-center">
                        <i class="ri-delete-bin-6-line"></i>
                    </div>

                </div>
            @endforeach
        </ul>
        <input type="file" class="file-input file-input-bordered w-full max-w-xs" wire:model="gallery.uploadPhoto"/>
        @error($gallery->uploadPhoto)
        <div class="label">
            <span class="label-text-alt text-red-500">{{ $message }}</span>
        </div>
        @enderror
    @endcomponent


    <div class="flex items-center justify-center gap-3">
        <button class="btn btn-primary">Save</button>
        @include('parts.back', [
            'route' => 'admin.products.index',
        ])
    </div>


        @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>

</form>
