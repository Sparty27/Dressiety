@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('products.store')}}" class="max-w-xs border-[3px] border-blue-200 rounded-[15px] p-6">
        @csrf
        <label class="form-control w-full font-bold">Name</label>
        <input name="name" type="text" placeholder="Type here" value="{{ old('name')}}" class="input w-full max-w-xs mt-6 border-2 border-gray-200" />
        <div class="form-control mt-6">
            <label class="label cursor-pointer font-bold">
                <span class="label-text">Status</span>
                <input name="status" type="checkbox" class="toggle" checked />
            </label>
        </div>
{{--        <div class="form-control">--}}
{{--            <label class="label cursor-pointer">--}}
{{--                <span class="label-text">Sold</span>--}}
{{--                <input type="radio" name="status" class="radio checked:bg-red-500" value="{{ old('status', 1) }}"/>--}}
{{--            </label>--}}
{{--        </div>--}}
{{--        <div class="form-control">--}}
{{--            <label class="label cursor-pointer">--}}
{{--                <span class="label-text">Not Sold</span>--}}
{{--                <input type="radio" name="status" class="radio checked:bg-blue-500" value="{{ old('status', 0) }}" checked/>--}}
{{--            </label>--}}
{{--        </div>--}}
{{--        <select class="select select-bordered w-full max-w-xs">--}}
{{--            <option disabled selected>Who shot first?</option>--}}
{{--            <option>Han Solo</option>--}}
{{--            <option>Greedo</option>--}}
{{--        </select>--}}
        <div class="mt-6 flex justify-between">
            <button class="btn btn-primary">Create</button>
            <a class="btn" href="{{route('products.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
        </div>
    </form>
    @error('name')
    {{ $message }}
    @enderror
@endsection
