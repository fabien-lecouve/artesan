@extends('layouts.guest')

@section('title', 'Inscription')

@section('content')
    
<form class="w75 shadow" method="POST" action="{{ route('register.store') }}">
    @csrf

    <div class="form-content">
        <div class="form-row">
            <div class="form-columns">
                <div class="h2-title">
                    <h2>Inscription</h2>
                </div>
                <div class="form-block">
                    <label for="lastname">Votre nom :</label>

                    <input id="lastname"
                        type="text"
                        name="lastname"
                        value="{{ old('lastname') }}"
                        class="@error('lastname') is-invalid @enderror">
                    
                    @error('lastname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="firstname">Votre prénom :</label>

                    <input id="firstname"
                        type="text"
                        name="firstname"
                        value="{{ old('firstname') }}"
                        class="@error('firstname') is-invalid @enderror">
                    
                    @error('firstname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
        <a href="{{ route('login')}}">Déjà inscrit ?</a>
        <button type="submit">Validez</button>
    </div>
    
</form>

@endsection