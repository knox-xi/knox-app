@extends('Layout.AuthImg')
@extends('Layout.app')

@section('title', 'Sign Up')
@section('content')
@section('form')

    <div class="items-center justify-center p-8">
        <form action="{{ route('signup') }}" method="POST" class="mx-auto mt-5 max-w-xl rounded-lg p-9">
            @csrf
            <h2 class="mb-4 text-2xl font-bold text-center text-white">Sign Up</h2>

            <x-form-field name="name" label="Name" hint="2–50 characters, letters only." required minlength="2"
                maxlength="50" />

            <x-form-field name="email" type="email" label="Email" hint="A valid email, e.g. name@example.com"
                required />

            <x-form-field name="password" type="password" label="Password" hint="At least 8 characters." required
                minlength="8" />

            <p class="mb-4 text-sm text-white">
                You already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log In</a>
            </p>

            <button type="submit" class="btn-primary w-full">Sign Up</button>
        </form>
    </div>

@endsection
@endsection
