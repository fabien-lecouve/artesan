@extends('layouts.app')

@section('title', 'Mes modes de travaux')

@section('content')

<div class="title">
    <h1>Mes modes de travaux</h1>
    <div class="link">
        <a href="{{ route('mode_of_work.create') }}"><i class="fas fa-plus"></i>Créez un mode de travaux</a>
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

        @foreach ($mode_of_works as $mode_of_work)
        <tr>
            <td>{{ ucfirst(strtolower($mode_of_work->name)) ?? '' }}</td>
            <td class="center">
                <a href="{{ route('mode_of_work.edit', ['mode_of_work' => $mode_of_work]) }}"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection