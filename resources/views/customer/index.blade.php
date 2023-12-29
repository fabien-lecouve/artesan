@extends('layouts.app')

@section('title', 'Mes clients')

@section('content')

<div class="title">
    <h1>Mes clients</h1>
    <div class="link">
        <a href="{{ route('customer.create') }}"><i class="fas fa-plus"></i>Créez un nouveau client</a>
    </div>
</div>

<div class="filter">
    <form class="w50" method="GET" action="#" class="form-filters">
        <div class="form-content">
            <div class="form-row">
                <div class="form-columns">
                    <div class="form-filter">
                        <input 
                            type="search" 
                            name="search_customer" 
                            id="search_customer" 
                            placeholder="Recherchez client par son nom ou email"
                            value="{{ request('search_customer')}}">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@if (session('success'))
<div class="success">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Code postal</th>
            <th>Ville</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        @foreach ($customers as $customer)
        <tr>
            <td>{{ strtoupper($customer->lastname) ?? '' }}</td>
            <td>{{ ucfirst(strtolower($customer->firstname)) ?? '' }}</td>
            <td>{{ $customer->email ?? '' }}</td>
            <td>{{ $customer->phone ?? '' }}</td>
            <td>
                {{ $customer->address ?? '' }}<br>
                {{ $customer->complementary_address ?? '' }}
            </td>
            <td>{{ $customer->postal_code ?? '' }}</td>
            <td>{{ $customer->city ?? '' }}</td>
            <td class="center actions">
                <a href="{{ route('customer.edit', ['customer' => $customer]) }}"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection