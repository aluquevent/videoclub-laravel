<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

//$guarded Funciona de forma contraria a la variable $fillable.
//Con esta línea estamos desprotegidos ante asignación masiva, 
//pero lo arreglamos en el método store del controlador.
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'url';
    }
}
