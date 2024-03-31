@extends('layouts.app')

@section('title', 'Mon devis')

@section('content')

<div class="title">
    <h1>Devis {{ $estimate->reference.' '.$estimate->status->name }}</h1>
    <div class="link">
        <a href="{{ route('estimate.index') }}"><i class="fas fa-arrow-left"></i>Retournez vers mes devis</a>
    </div>
</div>

@if (session('success'))
<div class="success">{{ session('success') }}</div>
@endif

<div id="estimate-content">

    <div>
        <h2>{{ ucfirst(strtolower($estimate->mode_of_work->name)) }}</h2>
        <div id="estimate-informations">

            <div id="customer-informations">
                <div>
                    <span class="bold">{{ strtoupper($estimate->customer->lastname) . ' ' . ucfirst(strtolower($estimate->customer->firstname)) }}</span>
                </div>
                <div>
                    <p>{{ $estimate->customer->address }}</p>
                    @if ($estimate->customer->complementary_address)
                    <p>{{ $estimate->customer->complementary_address }}</p>
                    @endif
                    <p>{{ $estimate->customer->postal_code . ' ' . $estimate->customer->city }}</p>
                </div>
            </div>

        </div>
    </div>
    <div class="link">
        <a href="{{ route('estimate.edit', ['estimate' => $estimate]) }}"><i class="far fa-edit"></i>Éditer devis {{ $estimate->reference }}</a>
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
                <span class="bold">(Garantie pièces et main-d'œuvre : {{ $location->warranty }} ans)</span>
            </td>

            <td class="center bold ft12" colspan="2">
                {{ $location->subtotal }}€
            </td>
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <td class="bold center">TVA non applicable - article 293 B du CGI</td>
            <td class="center bold underline ft12">TOTAL NET</td>
            <td class="center bold underline ft12">{{ $estimate->total }} €</td>
        </tr>
    </tfoot>
</table>

<div class="div-a between">
    <p>Acompte demandé : <span class="bold">{{ $estimate->advance }}€</span></p>
    <div class="div-a end" style="gap: 10px">
        <a href="{{ route('estimate.estimate_pdf', ['estimate' => $estimate]) }}">Éditer devis</a>
        <a href="{{ route('estimate.invoice_pdf', ['estimate' => $estimate]) }}">Éditer facture</a>
    </div>
</div>

@endsection