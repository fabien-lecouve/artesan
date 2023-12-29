@extends('layouts.app')

@section('title', 'Personnalisez la description')

@section('content')

<div class="title">
    <h1>Personnalisez la description</h1>
</div>

<div class="estimate-construction">

    <form class="w50 border" method="POST" action="{{ route('location_of_work.update', ['estimate' => $estimate, 'location_of_work' => $location_of_work]) }}">
        @csrf

        <div class="form-content">
            <div class="form-row">
                <div class="form-columns">
                    
                    <div class="h2-title">
                        <h2>{{ $location_of_work->room->name }}</h2>
                    </div>

                    <div class="form-block">
                        <label for="descriptions">Description :</label>

                        @php( $description = '')
                        @php( $i = 0)
                        @foreach ($location_of_work->operations as $operation)

                            @if ($operation->quantity > 1 && isset($operation->material->start_of_description_for_several)) 
                            @php( $description = $operation->material->start_of_description_for_several .' '. $operation->quantity .' '.  $operation->material->end_of_description_for_several)
                            @else
                            @php( $description = $operation->material->description)
                            @endif

                            <textarea name="descriptions[{{++$i}}]" id="descriptions" cols="30" rows="10">{{ $description }}</textarea>
                            
                        @endforeach

                    </div>

                </div>
            </div>
        </div>

        <div class="form-button end">
            <button type="submit">Validez</button>
        </div>

    </form>
</div>



@endsection