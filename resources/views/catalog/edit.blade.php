@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col12">
        <h1>Modificar película</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form action="{{ route('edit', ['id' => $singlePelicula->id]) }}" method="POST">
        @csrf

        {{-- Especificamos que el formulario va a usar el método PUT --}}
        
        <input name="_method" type="hidden" value="PUT"> {{-- or @method('PUT') --}}

        <div class="form-group">
            <label for="title">Título</label>
        <input type="text" name="title" class="form-control" id="" value=" {{ $singlePelicula->title }} ">
        </div>
        <div class="form-group">
            <label for="year">Año de estreno</label>
            <input type="text" name="year" class="form-control" id="" value=" {{ $singlePelicula->year }} ">
        </div>
        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" name="director" class="form-control" id="" value=" {{ $singlePelicula->director }} ">
        </div>
        <div class="form-group">
            <label for="poster">Poster</label>
            <input type="text" name="poster" class="form-control" id="" value=" {{ $singlePelicula->poster }} ">
        </div>
        <div class="form-group">
            <label for="synopsis">Resumen</label>
            <textarea name="synopsis" id="" cols="30" class="form-control" rows="10">  {{ $singlePelicula->synopsis }} </textarea>
        </div>
          
          <button type="submit" class="btn btn-primary">Modificar película</button>
        </form>
    </div>
</div>

@stop