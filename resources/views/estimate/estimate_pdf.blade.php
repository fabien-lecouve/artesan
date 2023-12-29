<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Devis {{ $estimate->reference }}</title>
    <style>
        body {
            margin: 30px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #11113d;
            font-family: sans-serif;
        }
        h1 {
            font-size: 2.5rem;
        }
        h2 {
            font-size: 2rem;
        }
        .ft12 {
            font-size: 1.2rem;
        }
        .bold {
            font-weight: bold;
        }
        .underline {
            text-decoration: underline;
        }
        .w65 {
            width: 65%;
        }
        .center {
            text-align: center;
        }
        header, section {
            margin-bottom: 30px;
        }
        header > *, section > * {
            display: inline-block;
        }
        header > * {
            vertical-align: top;
        }
        section > * {
            vertical-align: middle;
        }
        #estimate {
            background-color: #11113d;
            padding: 15px 60px;
            float: right;
        }
        #estimate h2 {
            color: #ffffff;
        }
        #reference-div {
            margin-top: 20px;
            padding: 10px;
            background-color: #11113d;
        }
        #reference-div > * {
            display: inline-block;
            vertical-align: middle
        }
        #reference-div * {
            color: #ffffff;
            font-weight: bold;
        }
        #reference {
            margin-left: 10px;
            float: right;
        }

        #customer {
            border: 1px solid #11113d;
            padding: 15px 40px;
            float: right;
        }

        #titled {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #11113d;
            border-collapse: collapse;
            padding: 10px;
        }
        th {
            background-color: #11113d;
            color: #ffffff;
        }
        #signature {
            margin-bottom: 150px;
        }

        li {
            margin-left: 20px;
            list-style:none;
        }
        #bottom {
            page-break-inside: avoid;
        }
        footer {
            margin-top: 30px;
        }
        footer p {
            text-align: center;
            font-size: 0.8rem;
        }
        footer div {
            width: 50%;
            margin: 0 auto;
            margin-top: 30px;
        }
        footer img {
            width: 80px;
        }
        #qualifelec {
            float: right;
        }
    </style>
</head>
<body>

    <header>
        <div id="estimate">
            <h2>Devis</h2>
        </div>
        <div>
            <h1>{{ Auth::user()->company }}</h1>
            <h2>{{ strtoupper(Auth::user()->lastname) .' '. ucfirst(strtolower(Auth::user()->firstname)) }}</h2>
        </div>
    </header>

    <section>
        <div id="customer" class="center">
            <p><span class="bold ft12">{{ strtoupper($estimate->customer->lastname).' '.ucfirst(strtolower($estimate->customer->firstname)) }}</span></p><br>
            <p>{{ $estimate->customer->address }}</p>
            @if ($estimate->customer->complementary_address)
            <p>{{ $estimate->customer->complementary_address }}</p>
            @endif
            <p>{{ $estimate->customer->postal_code.' '.ucfirst(strtolower($estimate->customer->city)) }}</p>
        </div>
        <div>
            <div>
                <p>{{ Auth::user()->address }}</p>
                <p>{{ Auth::user()->postal_code .' '.ucfirst(strtolower(Auth::user()->city)) }}</p>
                <p>{{ Auth::user()->phone }}</p>
                <p>{{ Auth::user()->email }}</p><br>
                <p>N° RM : {{ Auth::user()->rm_number }}</p>
            </div>
            <div id="reference-div">
                <div>
                    <div>Référence</div>
                    <div>Date</div>
                </div>
                <div id="reference">
                    <div>{{ $estimate->reference }}</div>
                    <div>{{ $estimate->created_at->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>
    </section>

    <p id="titled" class="ft12"><span class="bold underline ft12">Intitulé</span>: {{ $estimate->titled }}</p>

    <table>
        <thead>
            <tr>
                <th class="w65">Désignation</th>
                <th colspan="2">Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @php($total = 0)
    
            @foreach ($estimate->locationOfWorks as $location)
    
            <tr>
                <td><span class="bold underline">{{ ucfirst($location->room->name) }} :</span><br>
    
                    @foreach ($location->descriptions as $description)
                        - {{ $description->content }}<br>
                    @endforeach

                    <br>Forfait fournitures et matériaux : {{ $location->supplies }} €<br>
                    <span class="bold">(Garantie pièces et main-d'œuvre : {{ $location->warranty }} ans)</span>
                </td>
    
                <td class="center bold" colspan="2">
                    {{ $location->subtotal }}€
                </td>
            </tr>
            @endforeach
    
        </tbody>
        <tfoot>
            <tr>
                <td class="bold center">TVA non applicable - article 293 B du CGI</td>
                <td class="center bold underline">TOTAL NET</td>
                <td class="center bold underline">{{ $estimate->total }} €</td>
            </tr>
        </tfoot>
    </table>

    <div id="bottom">
        <p>Date et signature avec les mentions</p>
        <p id="signature">"Lu et approuvé" et "devis reçu avant l'exécution des travaux"</p>

        <p>Conditions de paiement :</p>
        <ul>
            <li>- 35% à la signature du devis : <span class="bold underline">{{ $estimate->advance }} €</span> (à l'ordre de "ROMANET Charlie")</li>
            @if ($estimate->big_construction)

            @php($livraison = $estimate->total - ($estimate->advance * 2) )
            <li>- 35% en cours de travaux : <span class="bold underline">{{ $estimate->advance }} €</span></li>
            <li>- 30% à la livraison du chantier : <span class="bold underline">{{ $livraison }} €</span></li>
            @else
            <li>- Restant dû à la livraison du chantier</li>

            @endif
            <li>- Devis valable 2 mois</li>
        </ul>

        <footer>
            <p>Assurance professionnelle : {{ Auth::user()->insurance_name }}</p>
            <p>{{ Auth::user()->insurance_address }}</p>
            <div>
                <img src="{{ base_path('public/storage/'.Auth::user()->artisan_logo_path) }}" alt="Logo Artisan de {{ Auth::user()->firstname }}">
                <img id="qualifelec" src="{{ base_path('public/storage/'.Auth::user()->qualifelec_logo_path) }}" alt="Logo Qualifelec de {{ Auth::user()->firstname }}">
            </div>
        </footer>
    </div>
</body>
</html>

       
        
