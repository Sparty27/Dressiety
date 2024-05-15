<form wire:submit.prevent="save">
    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Content</p>
        @include('parts.form.input', [
            'model' => 'tag.name',
            'title' => 'Name'
        ])
    @endcomponent
    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">Attributes</p>
        <div class="max-w-32">
            @include('parts.form.toggle', [
                'model' => 'tag.status',
                'title' => 'Visible'
            ])
        </div>
    @endcomponent

    <div class="flex items-center justify-center gap-3">
        <button class="btn btn-primary">Save</button>
        @include('parts.back', [
            'route' => 'admin.tags.index',
        ])
    </div>
</form>

