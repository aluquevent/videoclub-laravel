<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class CatalogController extends Controller
{

    public function getIndex(){
		$peliculas = Movie::all();
		return view('catalog.index', ['arrayPeliculas'=> $peliculas]);
    }

    public function getCreate(){
        return view('catalog.create');
	}

    public function getShow($id){
		$pelicula = Movie::findOrFail($id);
        return view('catalog.show', array('singlePelicula'=>$pelicula));
    }

    public function getEdit($id){
		$pelicula = Movie::findOrFail($id);
        return view('catalog.edit', array('singlePelicula'=>$pelicula));
	}
	
	public function store(Request $request ){
		$p = new Movie;
		$p->title = $request->title;
		$p->year = $request->year;
		$p->director = $request->director;
		$p->poster = $request->poster;
		$p->synopsis = $request->synopsis;
		$p->save();
		return redirect('/catalog');
	}

	public function update(Request $request, $id){
		$p = Movie::findOrFail($id);
		$p->title = $request->title;
		$p->year = $request->year;
		$p->director = $request->director;
		$p->poster = $request->poster;
		$p->synopsis = $request->synopsis;
		$p->save();
		return redirect('/catalog/show/'.$id);
	}
}
