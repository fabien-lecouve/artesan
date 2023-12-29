@extends('layouts.app')

@section('title', 'Mes matériaux')

@section('content')

<div class="title">
    <h1>Mes matériaux</h1>
    <div class="link">
        <a href="{{ route('material.create') }}"><i class="fas fa-plus"></i>Ajoutez un matériel</a>
    </div>
</div>

@if (session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

@foreach ($categories as $category)

<div style="margin-bottom: -10px;">
    <h2>{{ ucfirst($category->name) }}</h2>
</div>

<table>
    <thead>
        <tr>
            <th class="w15">Fourniture</th>
            <th class="w50">Description</th>
            <th class="w16">Neuf</th>
            <th class="w16">Rénovation</th>
            <th class="w3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($materials as $material)
            @if ($material->category->id === $category->id)
            <tr>
                <td>{{ ucfirst(strtolower($material->name)) }}</td>
                <td>
                    {{ $material->description }}<br>
                    @if ($material->start_of_description_for_several)
                    {{ $material->start_of_description_for_several }}<span class="bold"> plusieurs </span>{{ $material->end_of_description_for_several }}
                    @endif
                </td>
                <td>
                    <div style="display: flex; justify-content: space-between">
                    @foreach ($material->prices as $price)
                        @if ($price->mode_of_work->id === 1)
                        <div>
                            Fourniture<br>
                            Main-d'œuvre
                        </div>
                        <div>
                            {{ $price->unit_price }} €<br>
                            {{ $price->workforce_price }} €  
                        </div>   
                        @endif
                    @endforeach
                    </div>
                </td>
                <td>
                    <div style="display: flex; justify-content: space-between">
                        @foreach ($material->prices as $price)
                            @if ($price->mode_of_work->id > 1)
                            <div>
                                Fourniture<br>
                                Main-d'œuvre
                            </div>
                            <div>
                                {{ $price->unit_price }} €<br>
                                {{ $price->workforce_price }} €  
                            </div>   
                            @endif
                        @endforeach
                        </div>
                </td>
                <td class="actions center">
                    <a href="{{ route('material.edit', ['material' => $material]) }}"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>

@endforeach

@endsection