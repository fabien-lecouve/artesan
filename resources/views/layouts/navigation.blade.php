<div id="left-nav">
    <nav>
        <ul style="margin: 0px">
            <li style="margin: 0px"><a href=""><img style="width: 120px" src="{{ asset('storage/images/artesan.png') }}" alt="Logo de Art-e-san"></a></li>
        </ul>
        <div class="h3-title border-top">
            <h3>GÉNÉRAL</h3>
        </div>
        <ul>
            <li><a href="{{ route('profile.show') }}">Profil</a></li>
            <li><a href="{{ route('customer.index') }}">Clients</a></li>
            <li><a href="{{ route('estimate.index') }}">Devis</a></li>
            <li><a href="{{ route('material.index') }}">Fournitures</a></li>
        </ul>
        <div class="h3-title border-top">
            <h3>CONFIGURATION</h3>
        </div>
        <ul>
            <li><a href="{{ route('category.index') }}">Catégories</a></li>
            <li><a href="{{ route('mode_of_work.index') }}">Modes de travaux</a></li>
            <li><a href="{{ route('room.index') }}">Pièces</a></li>
            <li><a href="{{ route('status.index') }}">Statut</a></li>
        </ul>
    </nav>
    <div id="logout">
        <a href="{{ route('logout') }}">Se déconnecter</a>
    </div>
</div>
