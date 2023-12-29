@extends('layouts.app')

@section('title', 'Mes devis')

@section('content')

<div class="title">
    <h1>Mes devis</h1>
    <div class="link">
        <a href="{{ route('estimate.create') }}"><i class="fas fa-plus"></i>Créez un nouveau devis</a>
    </div>
</div>

<form class="multi-filters" method="GET" action="#">
    <div class="multi-input">
        <div>
            <input 
                type="search" 
                name="search_customer" 
                id="search_customer" 
                placeholder="Recherchez un devis par le nom ou l'email du client"
                value="{{ request('search_customer')}}">
        </div>
        <div class="multi-radio">
            <div>
                <input 
                    type="radio" 
                    id="all"
                    name="search_status" 
                    value="" checked>
                <label for="all">Tous</label>
            </div>
            @foreach ($statuses as $status)
            <div>
                <input 
                    type="radio" 
                    id="{{ $status->slug }}"
                    name="search_status" 
                    value="{{ $status->slug }}" @if (request('search_status') == $status->slug )
                        checked
                    @endif>
                <label for="{{ $status->slug }}" class="{{ $status->slug }}-color">{{ ucfirst($status->name) }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <div class="multi-submit">
        <input type="submit" value="Cherchez les devis">
    </div>
</form>

<table>
    <thead>
        <tr>
            <th>Référence</th>
            <th>Client</th>
            <th>Adresse</th>
            <th>Statut</th>
            <th>Date de création</th>
            <th>Prix total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        @foreach ($estimates as $estimate)
        <tr>
            <td>{{ $estimate->reference }}</td>
            <td>{{ strtoupper($estimate->customer->lastname).' '.$estimate->customer->firstname }}</td>
            <td>
                {{ $estimate->customer->address}}<br>
                {{$estimate->customer->postal_code.' '.$estimate->customer->city }}
            </td>
            <td class="{{ $estimate->status->slug }}"></td>
            <td class="center">{{ $estimate->created_at->format('d/m/Y') }}</td>
            <td class="center">{{ $estimate->total }} €</td>
            <td class="center actions">
                <a href="{{ route('estimate.show', ['estimate' => $estimate]) }}"><i class="far fa-eye"></i></a>
                <a href="{{ route('estimate.edit', ['estimate' => $estimate]) }}"><i class="far fa-edit"></i></a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection