@extends('Layout.AuthImg')
@extends('Layout.app')

@section('title', 'Log In')
@section('content')
@section('form')

    <div class="flex items-center justify-center p-8">
        <form action="{{ route('login') }}" method="POST" class="mx-auto mt-5 w-full max-w-xl rounded-lg p-9">
            @csrf

            <h2 class="mb-2 text-center text-2xl font-bold text-white">Log In</h2>

            <x-form-field name="email" type="email" label="Email" hint="A valid email, e.g. name@example.com"
                required />

            <x-form-field name="password" type="password" label="Password" hint="At least 8 characters." required
                minlength="8" />

            <button type="submit" class="btn btn-primary w-full">Log In</button>
        </form>
    </div>

@endsection
@endsection
