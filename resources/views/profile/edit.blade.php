@extends('layouts.app')

@section('title', 'Modifiez mon profil')

@section('content')

<div class="title">
    <h1>Modifiez mon profil</h1>
    <div class="link">
        <a href="{{ route('profile.show') }}"><i class="fas fa-arrow-left"></i>Retournez vers mon profil</a>
    </div>
</div>
    

<form class="w75 m-auto shadow" method="POST" action="{{ route('profile.update', ['profile' => $profile]) }}" enctype="multipart/form-data">
    @csrf

    <div class="form-content">

        <div class="h2-title">
            <h2>Mes informations</h2>
        </div>

        <div class="form-row">
            <div class="form-columns">
                <div class="form-block">
                    <label for="company">Nom de mon entreprise :</label>

                    <input id="company"
                        type="text"
                        name="company"
                        value="{{ old('company', $profile->company) }}"
                        class="@error('company') is-invalid @enderror">
                    
                    @error('company')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-block">
                    <label for="lastname">Nom :</label>

                    <input id="lastname"
                        type="text"
                        name="lastname"
                        value="{{ old('lastname', $profile->lastname) }}"
                        class="@error('lastname') is-invalid @enderror">
                    
                    @error('lastname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="firstname">Prénom :</label>

                    <input id="firstname"
                        type="text"
                        name="firstname"
                        value="{{ old('firstname', $profile->firstname) }}"
                        class="@error('firstname') is-invalid @enderror">
                    
                    @error('firstname')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="email">Email :</label>

                    <input id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $profile->email) }}"
                        class="@error('email') is-invalid @enderror">
                    
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="phone">Téléphone :</label>

                    <input id="phone"
                        type="tel"
                        name="phone"
                        value="{{ old('phone', $profile->phone) }}"
                        class="@error('phone') is-invalid @enderror">
                    
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-columns">
                <div class="form-block">
                    <label for="rm_number">N° de RM :</label>

                    <input id="rm_number"
                        type="text"
                        name="rm_number"
                        value="{{ old('rm_number', $profile->rm_number) }}"
                        class="@error('rm_number') is-invalid @enderror">
                    
                    @error('rm_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-block">
                    <label for="address">Adresse :</label>

                    <input id="address"
                        type="text"
                        name="address"
                        value="{{ old('address', $profile->address) }}"
                        class="@error('address') is-invalid @enderror">
                    
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="complementary_address">Adresse complémentaire :</label>

                    <input id="complementary_address"
                        type="text"
                        name="complementary_address"
                        value="{{ old('complementary_address', $profile->complementary_address) }}"
                        class="@error('complementary_address') is-invalid @enderror">
                    
                    @error('complementary_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="postal_code">Code postal :</label>

                    <input id="postal_code"
                        type="number"
                        name="postal_code"
                        value="{{ old('postal_code', $profile->postal_code) }}"
                        class="@error('postal_code') is-invalid @enderror">
                    
                    @error('postal_code')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="city">Ville :</label>

                    <input id="city"
                        type="text"
                        name="city"
                        value="{{ old('city', $profile->city) }}"
                        class="@error('city') is-invalid @enderror">
                    
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="h2-title">
            <h2>Mon mot de passe</h2>
        </div>

        <div class="form-row">
            <div class="form-columns">

                <div class="form-block">
                    <label for="password">Mon mot de passe :</label>
            
                    <input id="password"
                        type="password"
                        name="password"
                        class="@error('password') is-invalid @enderror">
                    
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="password_confirmation">Confirmez mon mot de passe :</label>
            
                    <input id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="@error('password_confirmation') is-invalid @enderror">
                    
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="h2-title">
            <h2>Mon assurance</h2>
        </div>

        <div class="form-row">
            <div class="form-columns">

                <div class="form-block">
                    <label for="insurance_name">Nom de mon assurance :</label>

                    <input id="insurance_name"
                        type="text"
                        name="insurance_name"
                        value="{{ old('insurance_name', $profile->insurance_name) }}"
                        class="@error('insurance_name') is-invalid @enderror">
                    
                    @error('insurance_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="insurance_address">Adresse de mon assurance :</label>

                    <input id="insurance_address"
                        type="text"
                        name="insurance_address"
                        value="{{ old('insurance_address', $profile->insurance_address) }}"
                        class="@error('insurance_address') is-invalid @enderror">
                    
                    @error('insurance_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="h2-title">
            <h2>Mes logos</h2>
        </div>

        <div class="form-row">
            <div class="form-columns">

                <div class="form-block">
                    <label for="artisan_logo_path">Logo Artisan :</label>

                    <input id="artisan_logo_path"
                        type="file" 
                        name="artisan_logo_path"
                        class="@error('artisan_logo_path') is-invalid @enderror">
                    
                    @error('artisan_logo_path')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-block">
                    <label for="qualifelec_logo_path">Logo Qualifelec :</label>

                    <input id="qualifelec_logo_path"
                        type="file" 
                        name="qualifelec_logo_path"
                        class="@error('qualifelec_logo_path') is-invalid @enderror">
                    
                    @error('qualifelec_logo_path')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

    </div>

<div class="form-button end">
    <button type="submit">Validez</button>
</div>
    
</form>

@endsection