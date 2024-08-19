@section('breadcrumbs')
    @include('parts.breadcrumbs', ['links' => [
                                    [
                                        'url' => route('admin.home'),
                                        'name' => 'Home'
                                    ],
                                    [
                                        'url' => route('admin.products.index'),
                                        'name' => 'Products',
                                    ],
                                    [
                                        'url' => url()->current(),
                                        'name' => 'SEO Product',
                                    ],
                                    ]])
@endsection

<form wire:submit.prevent="save">
    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">{{ $product->name }}</p>
        @include('parts.form.input', [
            'model' => 'title',
            'title' => 'Title'
        ])
        @include('parts.form.textarea', [
            'model' => 'description',
            'title' => 'Description',
            'class' => 'max-h-[400px]'
        ])
    @endcomponent

    <div class="flex items-center justify-center gap-3">
        <button class="btn btn-primary">Save</button>
        @include('parts.back', [
            'route' => 'admin.products.index',
        ])
    </div>
</form>
