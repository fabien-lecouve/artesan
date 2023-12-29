@extends('layouts.app')

@section('title', 'Mes catégories de fournitures')

@section('content')

<div class="title">
    <h1>Mes catégories de fournitures</h1>
    <div class="link">
        <a href="{{ route('category.create') }}"><i class="fas fa-plus"></i>Créez une nouvelle catégorie</a>
    </div>
</div>

@if (session('success'))
<div class="success">{{ session('success') }}</div>
@endif

<table class="w50">
    <thead>
        <tr>
            <th>Nom</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        @foreach ($categories as $category)
        <tr>
            <td>{{ ucfirst(strtolower($category->name)) ?? '' }}</td>
            <td class="center">
                <a href="{{ route('category.edit', ['category' => $category]) }}"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection