@extends('layouts.app')

@section('title', 'Modifiez la pièce' . ucfirst(strtoupper($room->name)))

@section('content')

<div class="title">
    <h1>Modifiez la pièce {{ ucfirst(strtolower($room->name)) }}</h1>
    <div class="link">
        <a href="{{ route('room.index') }}"><i class="fas fa-arrow-left"></i>Retournez vers mes pièces</a>
    </div>
</div>

<form class="w50 m-auto shadow" method="POST" action="{{ route('room.update', ['room' => $room]) }}">
    @csrf

    <div class="form-content">
        <div class="h2-title">
            <h2>Informations de la pièce</h2>
        </div>

        <div class="form-row">

            <div class="form-columns">

                <div class="form-block">
                    <label for="name">Nom :</label>
            
                    <input id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $room->name) }}"
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