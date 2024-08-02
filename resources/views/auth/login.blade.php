@extends('components.layouts.auth')

@section('content')
    <div class="py-24 px-10"><h2 class="text-2xl font-semibold mb-2 text-center">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <div class="form-control w-full mt-4"><label class="label"><span
                            class="label-text text-base-content undefined">Email</span></label>
                    <input id="email" type="email" class="input  input-bordered w-full @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-control w-full mt-4">
                    <label class="label">
                        <span class="label-text text-base-content undefined">Password</span>
                    </label>
                    <input id="password" type="password" class="input  input-bordered w-full  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <p class="text-center  text-error mt-8"></p>
            <button type="submit" class="btn mt-2 w-full btn-primary">{{ __('Login') }}</button>
        </form>
    </div>
@endsection
