<div>
    <div>
        {{$category->name}}
    </div>
    <a class="btn" href="{{route('admin.categories.edit', $category)}}">Edit</a>
    <button class="btn btn-danger mt-5" wire:click="delete">Delete</button>

{{--    <form action="{{ route('admin.categories.destroy', $category)}}" method="post">--}}
{{--        @csrf--}}
{{--        @method('DELETE')--}}
{{--        <button type="submit" class="btn">Delete</button>--}}
{{--    </form>--}}
</div>
