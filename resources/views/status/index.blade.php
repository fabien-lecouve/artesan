@extends('layouts.app')

@section('title', 'Mes statuts')

@section('content')

<div class="title">
    <h1>Mes statuts</h1>
    <div class="link">
        <a href="{{ route('status.create') }}"><i class="fas fa-plus"></i>Ajoutez un statut</a>
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

        @foreach ($statuses as $status)
        <tr>
            <td>{{ ucfirst(strtolower($status->name)) ?? '' }}</td>
            <td class="center">
                <a href="{{ route('status.edit', ['status' => $status]) }}"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection