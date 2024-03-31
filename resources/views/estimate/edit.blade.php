@extends('layouts.app')

@section('title', 'Finalisez mon devis')

@section('content')

<div class="title">
    <h1>Modifiez mon devis</h1>
    <div class="link" style="background-color: red">
        <a href="{{ route('estimate.destroy', ['estimate' => $estimate]) }}" style="color: white"><i class="far fa-trash-alt" style="color: white"></i>Supprimez devis</a>
    </div>
    <div class="link">
        <a href="{{ route('location_of_work.create', ['estimate' => $estimate]) }}"><i class="fas fa-plus"></i>Ajoutez des travaux sur ce devis</a>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Désignation</th>
            <th class="w25" colspan="2">Sous-total</th>
        </tr>
    </thead>
    <tbody>
        @php($total = 0)

        @foreach ($estimate->locationOfWorks as $location)

        <tr>
            <td><span class="bold underline ft12">{{ ucfirst($location->room->name) }} :</span><br>

                @foreach ($location->descriptions as $description)
                    - {{ $description->content }}<br>
                @endforeach

                <br>Forfait fournitures et matériaux : {{ $location->supplies }} €<br>
                <span class="bold">(Garantie pièces et main-d'œuvre : {{ $location->warranty}} ans)</span>
            </td>
            <td class="center bold ft12" colspan="2">
                {{ $location->subtotal }}€
            </td>
        </tr>

        @php($total += $location->subtotal)
        @php($advance = ceil($total / 100 * 35))
        
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <td class="bold center">TVA non applicable - article 293 B du CGI</td>
            <td class="center bold underline ft12">TOTAL NET</td>
            <td class="center bold underline ft12">{{ $total }} €</td>
        </tr>
    </tfoot>
</table>

<form class="w75 shadow" method="POST" action="{{ route('estimate.update', ['estimate' => $estimate]) }}">
    @csrf

    <div class="form-content">
        <div class="form-row">
            <div class="form-columns">

                <div class="h2-title">
                    <h2>Informations du devis</h2>
                </div>

                <div class="form-block">
                    <label for="reference">Référénce :</label>

                    <input id="reference"
                        type="text"
                        name="reference"
                        value="{{ old('reference', $estimate->getReference()) }}"
                        class="@error('reference') is-invalid @enderror">
                    
                    @error('reference')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                @if ($estimate->reference)
                <div class="form-block">
                    <label for="status_id">Statut :</label>

                    <select name="status_id" id="status_id">
                        @foreach ($statuses as $status)
                        <option value="{{ $status->id }}"
                            @if ( old('status_id') == $status->id )
                                selected
                            @endif>{{ ucfirst($status->name) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="form-block">
                    <label for="advance">Acompte :</label>

                    <input id="advance"
                        type="number"
                        name="advance"
                        value="{{ old('advance', $advance) }}"
                        class="@error('advance') is-invalid @enderror">
                    
                    @error('advance')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input id="total"
                        type="hidden"
                        name="total"
                        value="{{ old('total', $total) }}"
                        class="@error('total') is-invalid @enderror">
                    
                    @error('total')
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