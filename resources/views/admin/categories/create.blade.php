@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.categories.store')}}">
        @csrf
        <label class="form-cotnrol w-full">Name</label>
        <input name="name" type="text" placeholder="Type here" value="{{ old('name')}}" class="input w-full max-w-xs" />
        <button class="btn">Button</button>
    </form>
    @error('name')
        {{ $message }}
    @enderror
@endsection
