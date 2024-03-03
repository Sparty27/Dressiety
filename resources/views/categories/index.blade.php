@extends('layouts.app')
   

@section('content')
    @foreach ($categories as $category)
        <div>
            <a href="{{ route('categories.show', compact('category'))}}">{{$category->name}}</a>
        </div>
    @endforeach
@endsection

