@extends('layouts.master')
@section('content')
<div class="row">
    <h1>Ficha de película</h1>
</div>
    <div class="row">
        
    <div class="col-sm-4">
        {{-- TODO: Imagen de la película --}}
        <img src="{{$singlePelicula['poster']}}">
    </div>
    <div class="col-sm-8">
        {{-- TODO: Datos de la película --}}
        <h2>{{$singlePelicula['title']}}</h2>
        <h3>Año: {{$singlePelicula['year']}}</h3>
        <h3>Director: {{$singlePelicula['director']}}</h3>
        <p><strong>Resumen: </strong>{{$singlePelicula['synopsis']}}</p>
        <p><strong>Estado:</strong>
            @if ($singlePelicula['rented'] == false)
                Película disponible para alquilar.</p>      
            @else
                Película no disponible en este momento.</p>
            @endif
        <a href="{{ route( 'edit', ['id' => $singlePelicula->id] ) }}" class="btn btn-success">Modificar película</a>
        @if ($singlePelicula['rented'])
            <a href="" class="btn btn-secondary">Alquiler no disponible</a>
        @else
            <a href="{{ route( 'rent', ['id' => $singlePelicula->id] ) }}" class="btn btn-primary">Alquilar película</a>
        @endif

    </div>
    
    </div>

@stop