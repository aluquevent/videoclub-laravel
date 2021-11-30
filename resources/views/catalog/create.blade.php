@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col12">
        <h1>Crear película</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form action="{{ route('crear') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="year">Año de estreno</label>
            <input type="text" name="year" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" name="director" class="form-control" id="">
        </div>
        <div class="form-group">
            <label for="synopsis">Resumen</label>
            <textarea name="synopsis" id="" cols="30" class="form-control" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="poster">Poster</label>
            <input name="poster" class="form-control"></input>
        </div>
          
          <button type="submit" class="btn btn-primary">Crear película</button>
        </form>
    </div>
</div>

@stop