@extends('layouts.app')

@section('title', 'Modifiez le statut' . ucfirst(strtoupper($status->name)))

@section('content')

<div class="title">
    <h1>Modifiez le statut {{ ucfirst(strtolower($status->name)) }}</h1>
    <div class="link">
        <a href="{{ route('status.index') }}"><i class="fas fa-arrow-left"></i>Retournez vers mes statuts</a>
    </div>
</div>

<form class="w50 m-auto shadow" method="POST" action="{{ route('status.update', ['status' => $status]) }}">
    @csrf

    <div class="form-content">
        <div class="h2-title">
            <h2>Informations du statut</h2>
        </div>

        <div class="form-row">

            <div class="form-columns">

                <div class="form-block">
                    <label for="name">Nom :</label>
            
                    <input id="name"
                        type="text"
                        name="name"
                        value="{{ old('name',$status->name) }}"
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