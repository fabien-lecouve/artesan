@extends('layouts.app')

@section('title', 'Modifiez une fourniture')

@section('content')

<div class="title">
    <h1>Modifiez une fourniture</h1>
    <div class="link">
        <a href="{{ route('material.index') }}"><i class="fas fa-arrow-left"></i>Retournez vers mes fournitures</a>
    </div>
</div>

@if (session('failed'))
    <div class="alert failed">{{ session('failed') }}</div>
@endif

<form class="m-auto shadow w75" id="material-form" method="POST" action="{{ route('material.update', ['material' => $material]) }}">
    @csrf

    <div id="form-content">

        <div class="form-row">

            <div class="form-columns">

                <div class="h2-title">
                    <h2>Fourniture</h2>
                </div>

                <div class="form-block">
            
                    <input id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $material->name) }}"
                        class="@error('name') is-invalid @enderror">
                    
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="form-columns">

                <div class="h2-title">
                    <h2>Catégorie</h2>
                </div>

                <div class="form-block">
                    <select name="category_id" id="category_id" class="@error('category_id') is-invalid @enderror">
                        <option value="" selected>- - Choisissez une catégorie - -</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @if ($material->category_id === $category->id)
                                selected
                            @endif
                            
                            >{{ ucfirst($category->name) }}</option>
                    @endforeach
                    </select>

                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

        </div>
        <div class="form-row">

            <div class="form-columns">

                <div class="h2-title">
                    <h2>Description</h2>
                </div>
            
                <div class="form-block">
            
                    <input id="description"
                        type="text"
                        name="description"
                        value="{{ old('description', $material->description) }}"
                        placeholder="Mise en place d'un circuit composé d'une prise XYZ"
                        class="@error('description') is-invalid @enderror">
                    
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            
                <div id="descriptions">
                    <div class="form-block w100">
                
                        <input id="start_of_description_for_several"
                            type="text"
                            name="start_of_description_for_several"
                            value="{{ old('start_of_description_for_several', $material->start_of_description_for_several) }}"
                            placeholder="Mise en place d'un circuit composé de"
                            class="@error('start_of_description_for_several') is-invalid @enderror">
                        
                        @error('start_of_description_for_several')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="padding-bottom: 10px">
                        plusieurs
                    </div>
                
                    <div class="form-block w100">
                
                        <input id="end_of_description_for_several"
                            type="text"
                            name="end_of_description_for_several"
                            value="{{ old('end_of_description_for_several', $material->end_of_description_for_several) }}"
                            placeholder="prises XYZ"
                            class="@error('end_of_description_for_several') is-invalid @enderror">
                        
                        @error('end_of_description_for_several')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

        </div>
        <div class="form-row">

            <div class="form-columns">
                <div class="h2-title">
                    <h2>Prix</h2>
                </div>
            </div>
        </div>

        <div class="form-row">
            
            <div class="form-columns">

                <h3>Neuf ou rénovation sous doublage</h3>

                @foreach ($material->prices as $price)
                    @if ($price->mode_of_work_id === 1)

                <div class="form-block">
                    <label for="new_unit_price">Prix fourniture :</label>
            
                    <input id="new_unit_price"
                        min="0"
                        type="number"
                        name="new_unit_price"
                        value="{{ old('new_unit_price', $price->unit_price) }}"
                        class="@error('new_unit_price') is-invalid @enderror">
                    
                    @error('new_unit_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="new_workforce_price">Prix main-d'œuvre :</label>
            
                    <input id="new_workforce_price"
                        min="0"
                        type="number"
                        name="new_workforce_price"
                        value="{{ old('new_workforce_price', $price->workforce_price) }}"
                        class="@error('new_workforce_price') is-invalid @enderror">
                    
                    @error('new_workforce_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
                @else
            <div class="form-columns">

                <h3>Rénovation sous saignée</h3>

                <div class="form-block">
                    <label for="renovation_unit_price">Prix fourniture :</label>
            
                    <input id="renovation_unit_price"
                        min="0"
                        type="number"
                        name="renovation_unit_price"
                        value="{{ old('renovation_unit_price', $price->unit_price) }}"
                        class="@error('renovation_unit_price') is-invalid @enderror">
                    
                    @error('renovation_unit_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-block">
                    <label for="workforce_price">Prix main-d'œuvre :</label>
            
                    <input id="renovation_workforce_price"
                        min="0"
                        type="number"
                        name="renovation_workforce_price"
                        value="{{ old('renovation_workforce_price', $price->workforce_price) }}"
                        class="@error('renovation_workforce_price') is-invalid @enderror">
                    
                    @error('renovation_workforce_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

                @endif
            @endforeach

        </div>

    </div>

    <div class="form-button end">
        <button type="submit">Validez</button>
    </div>
    
</form>

@endsection