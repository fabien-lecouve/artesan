@extends('layouts.app')

@section('title', 'Modifiez la catégorie' . ucfirst(strtoupper($category->name)) )

@section('content')

<div class="title">
    <h1>Modifiez la catégorie {{ ucfirst(strtolower($category->name)) }}</h1>
    <div class="link">
        <a href="{{ route('category.index') }}"><i class="fas fa-arrow-left"></i>Retournez vers mes catégories</a>
    </div>
</div>

<form class="w50 m-auto shadow" method="POST" action="{{ route('category.update', ['category' => $category]) }}">
    @csrf

    <div class="form-content">
        <div class="h2-title">
            <h2>Informations de la catégorie {{ ucfirst(strtolower($category->name)) }}</h2>
        </div>

        <div class="form-row">

            <div class="form-columns">

                <div class="form-block">
                    <label for="name">Nom :</label>
            
                    <input id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="@error('name') is-invalid @enderror">
                    
                    @error('name')
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