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


    <div class="flex items-center justify-center gap-3">
        <button class="btn btn-primary">Save</button>
        @include('parts.back', [
            'route' => 'admin.products.index',
        ])
    </div>
</form>
