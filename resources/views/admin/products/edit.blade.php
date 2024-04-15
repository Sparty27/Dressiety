@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('admin.products.update', $product)}}" class="max-w-xs border-[3px] border-blue-200 rounded-[15px] p-6">
        @csrf
        @method('PUT')
        <label class="form-control w-full font-bold">Name</label>
        <input name="name" type="text" placeholder="Type here" value="{{ old('name', $product->name)}}" class="input w-full max-w-xs mt-6 border-2 border-gray-200" />
        <label class="form-control w-full mt-6 font-bold">Status</label>
        <div class="form-control">
            <label class="label cursor-pointer">
                <span class="label-text">Sold</span>
                <input type="radio" name="status" class="radio checked:bg-red-500" value="{{ old('status',1)}}" {{$product->status==1?'checked':''}}/>
            </label>
        </div>
        <div class="form-control">
            <label class="label cursor-pointer">
                <span class="label-text">Not Sold</span>
                <input type="radio" name="status" class="radio checked:bg-blue-500" value="{{ old('status',0) }}" {{$product->status==0?'checked':''}}/>
            </label>
        </div>
        <div class="mt-6 flex justify-between">
            <button class="btn btn-primary">Edit</button>
            <a class="btn" href="{{route('admin.products.show', $product)}}">
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
