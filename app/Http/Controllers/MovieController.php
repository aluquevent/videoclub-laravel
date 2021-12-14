<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\SaveMovieRequest;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movies.index', [
			'movies'=> Movie::latest()->paginate()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create', [
			'movie' => new Movie
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveMovieRequest $request)
    {
        Movie::create( $request->validated() );
		
		return redirect()->route('movies.index')->with('status', 'La película fue creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('movies.show', [
			'movie' => Movie::findOrFail($id)
			]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('movies.edit',[
			'movie' => Movie::findOrFail($id)
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Movie::findOrFail($id)->update( $request->validated() );

		return redirect()->route('movies.index')->with('status', 'La película fue actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')->with('status', 'La película fue eliminada con éxito.');
    }
}

//     <?php

// namespace App\Http\Controllers;


// use App\Models\Movie;
// use App\Http\Requests\SaveMovieRequest;

// class MovieController extends Controller
// {

// 	public function __construct()
//     {
//         $this->middleware('auth')->except('index', 'show');
// 	}
	
//     public function index(){
		
// 		return view('movies.index', [
// 			'movies'=> Movie::latest()->paginate()
// 		]);
//     }

//     public function show($id){
		
// 		return view('movies.show', [
// 			'movie' => Movie::findOrFail($id)
// 			]);
// 	}
	
// 	public function create(){

// 		return view('movies.create', [
// 			'movie' => new Movie
// 		]);
// 	}

	
	// public function store(SaveMovieRequest $request ){

	// 	Movie::create( $request->validated() );
		
	// 	return redirect()->route('movies.index')->with('status', 'La película fue creada con éxito');
	// }

// 	public function edit($id){

// 		return view('movies.edit',[
// 			'movie' => Movie::findOrFail($id)
// 		]);
// 	}

// 	public function update($id, SaveMovieRequest $request){

// 		Movie::findOrFail($id)->update( $request->validated() );

// 		return redirect()->route('movies.index')->with('status', 'La película fue actualizada con éxito');
// 	}

// 	public function destroy($id){

// 		Movie::findOrFail($id)->delete();

//         return redirect()->route('movies.index')->with('status', 'La película fue eliminada con éxito.');
// 	}

// 	public function rented($id){

// 		$p = Movie::findOrFail($id);
// 		if ($p->rented==0){
// 			$p->rented=1;
// 			$p->save();
// 		}
// 		return redirect('movies.show')
// 				->with('status','Has alquilado correctamente la película.');
// 	}
// }

// }
