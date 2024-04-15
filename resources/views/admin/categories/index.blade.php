@extends('layouts.app')

@section('breadcrumbs')
    @include('parts.breadcrumbs', ['links' => [
                                    [
                                        'url' => 'test',
                                        'name' => 'first'
                                    ],
                                    [
                                        'url' => 'test2',
                                        'name' => 'second',
                                    ]]])
@endsection

@section('content')
    <div class="overflow-x-auto">
        <a href="{{ route('admin.categories.create')}}" class="btn btn-primary mb-8">Create</a>
        <table class="table">
            <!-- head -->
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>

            @foreach($categories as $category)
                <tr class="hover">
                    <th>{{$category->id}}</th>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                    <img src="{{ $category->photos()->value('url') }}" alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><a href="{{ route('admin.categories.show', compact('category')) }}">{{$category->name}}</a></td>
                    <td>{{$category->created_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

