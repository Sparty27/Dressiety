@extends('layouts.app')

@section('content')
    <div>
        {{$category->name}}
    </div>
    <a class="btn" href="{{route('admin.categories.edit', $category)}}">Edit</a>

    <form action="{{ route('admin.categories.destroy', $category)}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">Delete</button>
    </form>
@endsection
