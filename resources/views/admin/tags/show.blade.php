@extends('layouts.app')

@section('content')
    <div class="card w-96 bg-base-100 shadow-xl border-2">
        <div class="card-body">
            <div class="flex justify-between">
                <h2 class="card-title">ID: {{$tag->id}}</h2>
                <a class="btn" href="{{route('admin.tags.index')}}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                </a>
            </div>
            <p>Name: {{$tag->name}}</p>
            <p>Status: {{$tag->status==1?'True':'False'}}</p>
            <div class="card-actions justify-end">
                <a href="{{route('admin.tags.edit', $tag)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('admin.tags.destroy', $tag)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-red-600">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
