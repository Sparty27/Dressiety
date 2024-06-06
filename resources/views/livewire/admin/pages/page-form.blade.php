<form wire:submit.prevent="save">
    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Content</p>
        @include('parts.form.input', [
            'model' => 'page.title',
            'title' => 'Title'
        ])
        @include('parts.form.textarea', [
            'model' => 'page.description',
            'title' => 'Description',
            'class' => 'max-h-[400px]'
        ])
    @endcomponent

    <div class="flex items-center justify-center gap-3">
        <button class="btn btn-primary">Save</button>
        @include('parts.back', [
            'route' => 'admin.pages.index',
        ])
    </div>
</form>
