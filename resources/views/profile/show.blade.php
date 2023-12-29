@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')

<div class="title">
    <h1>Mon profil</h1>
    <div class="link">
        <a href="{{ route('profile.edit') }}"><i class="fas fa-edit"></i>Éditez mon profil</a>
    </div>
</div>

@if (session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

<div id="profile-content">
    
    <div class="h2-title">
        <h2>Mes informations</h2>
    </div>

    <div id="profile-informations">
        <div>
            <p>Nom de mon entreprise: <span class="bold">{{ $profile->company }}</span></p>
            <p>Nom : <span class="bold">{{ strtoupper($profile->lastname) }}</span></p>
            <p>Prénom : <span class="bold">{{ $profile->firstname }}</span></p>
            <p>Email : <span class="bold">{{ $profile->email }}</span></p>
            <p>Téléphone : <span class="bold">{{ $profile->phone }}</span></p>
        </div>
        <div>
            <p>N° de RM : <span class="bold">{{ $profile->rm_number }}</span></p>
            <p>Adresse : <span class="bold">{{ $profile->address }}</span></p>
            @if ($profile->complementary_address)
            <p>Adresse complémentaire : <span class="bold">{{ $profile->complementary_address }}</span></p>
            @endif
            <p>Code postal : <span class="bold">{{ $profile->postal_code }}</span></p>
            <p>Ville : <span class="bold">{{ $profile->city }}</span></p>
        </div>
    </div>

    <div class="h2-title">
        <h2>Mon assurance</h2>
    </div>

    <div id="insurance-informations">
        <p>Nom de mon assurance : <span class="bold">{{ $profile->insurance_name }}</span></p>
        <p>Adresse de mon assurance : <span class="bold">{{ $profile->insurance_address }}</span></p>
    </div>

    @if ($profile->artisan_logo_path || $profile->qualifelec_logo_path)
    <div class="h2-title">
        <h2>Mes logos</h2>
    </div>

    <div id="logos-informations">
        @if ($profile->artisan_logo_path)
        <div id="image">

            <img src="{{ asset('storage/'.$profile->artisan_logo_path) }}" alt="Logo Artisan de {{ $profile->firstname }}">

        </div>
        @endif

        @if ($profile->qualifelec_logo_path)
        <div id="image">

            <img src="{{ asset('storage/'.$profile->qualifelec_logo_path) }}" alt="Logo Qualifelec de {{ $profile->firstname }}">

        </div>
        @endif
    </div>
    @endif

</div>

@endsection