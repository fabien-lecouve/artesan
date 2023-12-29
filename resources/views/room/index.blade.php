@extends('layouts.app')

@section('title', 'Mes pièces')

@section('content')

<div class="title">
    <h1>Mes pièces</h1>
    <div class="link">
        <a href="{{ route('room.create') }}"><i class="fas fa-plus"></i>Créez une nouvelle pièce</a>
    </div>
</div>

@if (session('success'))
<div class="success">{{ session('success') }}</div>
@endif

<table class="w50">
    <thead>
        <tr>
            <th>Nom</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        @foreach ($rooms as $room)
        <tr>
            <td>{{ ucfirst(strtolower($room->name)) ?? '' }}</td>
            <td class="center">
                <a href="{{ route('room.edit', ['room' => $room]) }}"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection