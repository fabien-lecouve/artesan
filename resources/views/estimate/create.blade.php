@extends('layouts.app')

@section('title', 'Créez un nouveau devis')

@section('content')

<div class="title">
    <h1>Créez un nouveau devis</h1>
    <div class="link">
        <a href="{{ route('estimate.index') }}"><i class="fas fa-arrow-left"></i>Retournez vers mes devis</a>
    </div>
</div>

<form class="w75 shadow m-auto" method="POST" action="{{ route('estimate.store') }}">
    @csrf

    <div class="form-content">
        <div class="form-row">
            <div class="form-columns">
                
                <div class="h2-title">
                    <h2>Création du devis</h2>
                </div>

                <div class="form-block">
                    <label for="mode_of_work_id">Mode de travaux :</label>

                    <select name="mode_of_work_id" id="select-modes">
                        <option value="" selected>- - Choisissez un mode de travaux - -</option>
                    @foreach ($modes as $mode)
                        <option value="{{ $mode->id }}"
                            @if ( old('mode_of_work_id') == $mode->id )
                                selected
                            @endif>{{ ucfirst($mode->name) }}</option>
                    @endforeach
                    </select>

                    @error('mode_of_work_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="form-row">
            <div class="form-columns">
                <div class="form-block">
                    <label for="titled">Intitulé du devis :</label>
            
                    <input id="titled"
                        type="text"
                        name="titled"
                        value="{{ old('titled') }}"
                        class="@error('titled') is-invalid @enderror">
                    
                    @error('titled')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-columns">

                <div class="form-block">

                    <div class="checkbox">
                        <input type="checkbox" name="checkbox_customer" id="checkbox_customer" @checked(old('checkbox_customer'))>
                        <label for="checkbox_customer">Nouveau client</label>
                    </div>

                    @error('checkbox_customer')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-columns">
                <div class="form-block">

                    <div class="big_construction">
                        <input type="checkbox" name="big_construction" id="big_construction" @checked(old('big_construction'))>
                        <label for="big_construction">Gros chantier</label>
                    </div>

                    @error('big_construction')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div id="old_customer" class="form-row">
            <div class="form-columns">

                <div class="form-block">
                    <label for="customer_id">Client :</label>

                    <select name="customer_id" id="select-customer">
                        <option value="" selected>- - Choisissez un client déjà existant - -</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"
                            @if ( old('customer_id') == $customer->id )
                                selected
                            @endif>{{ strtoupper($customer->lastname) }} {{ ucfirst($customer->firstname) }}</option>
                    @endforeach
                    </select>

                    @error('customer_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
     
            </div>
        </div>

        <div id="new_customer" class="form-row">

            <div class="form-columns">

                <div class="form-block">
                    <label for="lastname">Nom :</label>
            
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
                    <label for="firstname">Prénom :</label>
            
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
                    <label for="email">Email :</label>
            
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
                    <label for="phone">Téléphone :</label>
            
                    <input id="phone"
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
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
                        value="{{ old('address') }}"
                        class="@error('address') is-invalid @enderror">
                    
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            
                <div class="form-block">
                    <label for="postal_code">Code postal :</label>
            
                    <input id="postal_code"
                        type="number"
                        name="postal_code"
                        value="{{ old('postal_code') }}"
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
                        value="{{ old('city') }}"
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

<script>
    let form = document.querySelector('form');
    let checkbox = document.getElementById('checkbox_customer');
    let selectCustomer = document.getElementById('old_customer');
    let blockCustomer = document.getElementById('new_customer');

    checkbox.checked = true;
    blockCustomer.style.display = "none";

    function checked() {
        selectCustomer.style.display = "none";
        blockCustomer.style.display = "flex";
    }

    function unChecked() {
        selectCustomer.style.display = "flex";
        blockCustomer.style.display = "none";
    }

    function isChecked() {

        if(checkbox.checked) {
            checked();
        } else {
            unChecked();
        }
    }

    checkbox.addEventListener('click', isChecked);
    
    isChecked();
</script>

@endsection