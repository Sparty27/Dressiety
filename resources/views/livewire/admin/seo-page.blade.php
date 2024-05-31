<form wire:submit.prevent="save">
    @component('parts.layouts.card', [
        'class' => 'mb-6 border-[1px] border-gray-100'
    ])
        <p class="card-title">SEO Product Template</p>
        <p class="text-base">
            <span class="font-bold">{title}</span> - it's a placeholder for title<br/>
            <span class="font-bold">{description}</span> - it's a placeholder for description
        </p>
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
    </div>
</form>
