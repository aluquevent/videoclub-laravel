<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\SaveMovieRequest;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the movies.
     */

    //Aquí se encuentra el middleware con el que se protegen las rutas excepto index y show
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    //Al tratarse de un controlador tipo Resource, estas funciones son necesarias y permitirán
    //a las rutas de tipo Resource encontrar su función.
    public function index()
    {
        return view('movies.index', [
			'movies'=> Movie::latest()->paginate()
		]);
    }

    /**
     * Show the form for creating a new movie.
     */
    public function create()
    {
        return view('movies.create', [
			'movie' => new Movie
		]);
    }

    /**
     * Store a newly created movie in storage.
     */
    public function store(SaveMovieRequest $request)
    {
        Movie::create( $request->validated() );
		
		return redirect()->route('movies.index')->with('status', 'La película fue creada con éxito');
    }

    /**
     * Display the specified movie.
     */
    public function show($id)
    {
        return view('movies.show', [
			'movie' => Movie::findOrFail($id)
			]);
    }

    /**
     * Show the form for editing the specified movie.
     */
    public function edit($id)
    {
        return view('movies.edit',[
			'movie' => Movie::findOrFail($id)
		]);
    }

    /**
     * Update the specified movie in storage.
     */
    public function update(SaveMovieRequest $request, $id)
    {
        Movie::findOrFail($id)->update( $request->validated() );

		return redirect()->route('movies.index')->with('status', 'La película fue actualizada con éxito');
    }

    /**
     * Remove the specified movie from storage.
     */
    public function destroy($id)
    {
        Movie::findOrFail($id)->delete();

        return redirect()->route('movies.index')->with('status', 'La película fue eliminada con éxito.');
    }
}

