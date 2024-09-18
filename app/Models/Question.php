<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    //Con este metodo relacionamos la levels(niveles) y question(pregunta) a nivel de modelo con hasMany(tiene muchos) y la ruta de dicho modelo.
    public function Levels()
    {
        return $this->hasMany('App\Models\Level');
    }
}
