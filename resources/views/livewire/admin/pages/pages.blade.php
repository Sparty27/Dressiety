<div>
    <div class="flex max-sm:gap-4 justify-between items-end mb-8">
        <div class="flex gap-8 w-full">
            @include('parts.form.input', [
                'title' => 'Search',
                'model' => 'searchText',
                'small' => true
            ])
{{--            @include('parts.form.select', [--}}
{{--                'title' => 'Categories',--}}
{{--                'model' => 'selectedCategory',--}}
{{--                'options' => $categories,--}}
{{--                'value' => 'id',--}}
{{--                'name' => 'name',--}}
{{--                'small' => true,--}}
{{--                'placeholder' => 'All'--}}
{{--            ])--}}
        </div>

        <a href="{{ route('admin.pages.create')}}" class="btn btn-primary btn-sm">
            <i class="ri-add-circle-line"></i>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th class="cursor-pointer" wire:click="toggleSortColumn('id')">
                    <div class="flex items-center gap-1">
                        ID
                        @if($sortColumn == 'id')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-0.5"></i>
                            @else
                                <i class="ri-arrow-down-line mt-0.5"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-0.5"></i>
                        @endif
                    </div>
                </th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('title')">
                    <div class="flex items-center gap-1">
                        Title
                        @if($sortColumn == 'title')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-0.5"></i>
                            @else
                                <i class="ri-arrow-down-line mt-0.5"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-0.5"></i>
                        @endif
                    </div>
                </th>
                <th class="cursor-pointer" wire:click="toggleSortColumn('description')">
                    <div class="flex items-center gap-1">
                        Description
                        @if($sortColumn == 'description')
                            @if($sortDirection == 'asc')
                                <i class="ri-arrow-up-line mt-0.5"></i>
                            @else
                                <i class="ri-arrow-down-line mt-0.5"></i>
                            @endif
                        @else
                            <i class="ri-arrow-up-down-line mt-0.5"></i>
                        @endif
                    </div>
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($pages as $page)
                <tr class="hover">
                    <td class="font-black">{{$page->id}}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->description }}</td>
                    <td>
                        <div class="flex gap-1 items-center justify-center">
                            <a  class="btn btn-sm border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="{{ route('admin.pages.seo', $page) }}">
                                <img src="{{ asset('images/icons/seo-fill.svg') }}" alt="SEO" width="14" height="14">
                            </a>
                            <a class="btn btn-sm border-2 border-gray-200 hover:shadow-neutral-600 hover:shadow-sm" href="{{ route('admin.pages.edit', $page) }}">
                                <i class="ri-pencil-line"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger bg-red-600 hover:bg-red-700 text-white" wire:click="toggleDeleteModal('{{ $page->id }}')">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('parts.delete-modal', [
        'model' => $deletePage,
        'open' => $open,
        'deleteMethod' => 'delete',
        'toggleMethod' => 'toggleDeleteModal',
        'transPath' => 'pages.admin.pages.delete',
    ])

    {{ $pages->links() }}
</div>
