<form wire:submit.prevent="save">
    @component('parts.layouts.card')
        <p class="card-title">Content</p>
        @include('parts.form.input', [
            'model' => 'product.name',
            'title' => 'Name'
        ])
        @include('parts.form.textarea', [
            'model' => 'product.description',
            'title' => 'Description'
        ])
    @endcomponent
    @component('parts.layouts.card')
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
            'small' => true
        ])

        @include('parts.form.toggle', [
            'title' => 'Status',
            'model' => 'product.status'
        ])

        @include('parts.form.input', [
            'model' => 'product.count',
            'title' => 'Count'
    ])
    @endcomponent


    <button class="btn btn-primary">Save</button>
</form>
