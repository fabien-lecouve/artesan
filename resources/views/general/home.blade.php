@extends('layouts.guest')

@section('title', 'Accueil')

@section('content')
    
<div>
    @if (Route::has('login_user'))
        <div>
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login_user') }}">Log in</a>

                @if (Route::has('register_user'))
                    <a href="{{ route('register_user') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
    
</div>

@endsection