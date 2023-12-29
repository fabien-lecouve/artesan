@extends('layouts.app')

@section('title', 'Modifiez les informations de ' . ucfirst(strtolower($customer->firstname)) .' '. strtoupper($customer->lastname))

@section('content')

<div class="title">
    <h1>Modifiez les informations du client</h1>
    <div class="link">
        <a href="{{ route('customer.index') }}"><i class="fas fa-arrow-left"></i>Retournez vers mes clients</a>
    </div>
</div>


<form class="w75 m-auto shadow" method="POST" action="{{ route('customer.update', ['customer' => $customer]) }}">
    @csrf

    <div class="form-content">
        <div class="h2-title">
            <h2>Informations du client</h2>
        </div>
        <div class="form-row">
            <div class="form-columns">
                <div class="form-block">
                    <label for="lastname">Nom :</label>
            
                    <input id="lastname"
                        type="text"
                        name="lastname"
                        value="{{ old('lastname', $customer->lastname) }}"
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
                        value="{{ old('firstname', $customer->firstname) }}"
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
                        value="{{ old('email', $customer->email) }}"
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
                        value="{{ old('phone', $customer->phone) }}"
                        class="@error('phone') is-invalid @enderror">
                    
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-columns">
                <div class="form-block">
                    <label for="address">Adresse :</label>
            
                    <input id="address"
                        type="text"
                        name="address"
                        value="{{ old('address', $customer->address) }}"
                        class="@error('address') is-invalid @enderror">
                    
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="complementary_addres">Adresse complémentaire :</label>
            
                    <input id="complementary_addres"
                        type="text"
                        name="complementary_addres"
                        value="{{ old('complementary_addres', $customer->complementary_address ?? '') }}"
                        class="@error('complementary_addres') is-invalid @enderror">
                    
                    @error('complementary_addres')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-block">
                    <label for="postal_code">Code postal :</label>
            
                    <input id="postal_code"
                        type="number"
                        name="postal_code"
                        value="{{ old('postal_code', $customer->postal_code) }}"
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
                        value="{{ old('city', $customer->city) }}"
                        class="@error('city') is-invalid @enderror">
                    
                    @error('city')
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