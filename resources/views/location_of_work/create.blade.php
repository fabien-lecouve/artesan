@extends('layouts.app')

@section('title', 'Choisissez une pièce')

@section('content')

<div class="title">
    <h1>Choisissez une pièce</h1>
    @if (count($estimate->locationOfWorks) > 0)
    <div class="link">
        <a href="{{ route('estimate.edit', ['estimate' => $estimate]) }}"><i class="fas fa-equals"></i>Finalisez mon devis</a>
    </div>
    @endif
</div>

@if (session('success'))
<div class="success">{{ session('success') }}</div>
@endif

<div class="estimate-construction">
    @if (count($estimate->locationOfWorks) > 0)
    <div id="resume" class="w25">
        <div class="h2-title">
            <h2>Résumé du devis</h2>
        </div>
        @foreach ($estimate->locationOfWorks as $location)
        <ul>
            <li><span class="bold">{{ strtoupper($location->room->name) }}</span></li>
            @foreach ($location->operations as $operation)
                <ul>
                    <li>{{ $operation->quantity . ' ' . $operation->material->name }}</li>
                </ul>
            @endforeach
        </ul>
        @endforeach   
    </div>
    @endif

    <form class="w50 border" method="POST" action="{{ route('location_of_work.store', ['estimate' => $estimate]) }}">
        @csrf

        <div class="form-content">
            <div class="form-row">
                <div class="form-columns">
                    
                    <div class="h2-title">
                        <h2>Lieu des travaux</h2>
                    </div>

                    <div class="form-block">
                        <label for="room_id">Lieu des travaux :</label>

                        <select name="room_id">
                            <option value="" selected>- - Choisissez une pièce - -</option>
                            @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ ucfirst($room->name) }}</option>
                            @endforeach
                        </select>

                        @error('room_id')
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
</div>


@endsection