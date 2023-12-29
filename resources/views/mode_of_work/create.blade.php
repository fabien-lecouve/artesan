@extends('layouts.app')

@section('title', 'Créez un nouveau mode de travaux')

@section('content')

<div class="title">
    <h1>Créez un nouveau mode de travaux</h1>
    <div class="link">
        <a href="{{ route('mode_of_work.index') }}"><i class="fas fa-arrow-left"></i>Retournez vers mes modes de travaux</a>
    </div>
</div>

<form class="w50 m-auto shadow" method="POST" action="{{ route('mode_of_work.store') }}">
    @csrf

    <div class="form-content">
        <div class="h2-title">
            <h2>Informations du mode de travaux</h2>
        </div>

        <div class="form-row">

            <div class="form-columns">

                <div class="form-block">
                    <label for="name">Nom :</label>
            
                    <input id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="@error('name') is-invalid @enderror">
                    
                    @error('name')
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