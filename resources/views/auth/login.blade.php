@extends('layouts.guest')

@section('title', 'Connexion')

@section('content')
    
<form class="w75" method="POST" action="{{ route('login.post') }}">
    @csrf

    <div class="form-content">
        <div class="form-row">
            <div class="form-columns">

                <div class="h2-title">
                    <h2>Connexion</h2>
                </div>

                <div class="form-block">
                    <label for="email">Votre email :</label>

                    <input id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="@error('email') is-invalid @enderror">
                    
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="password">Votre mot de passe :</label>

                    <input id="password"
                        type="password"
                        name="password"
                        class="@error('password') is-invalid @enderror">
                    
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
        </div>
    </div>

    <div class="form-button between">
        <a href="{{ route('register')}}">Pas encore inscrit ?</a>
        <button type="submit">Validez</button>
    </div>
    
</form>

@endsection