<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    //Con este metodo relacionamos la topic(tema) y levels(niveles) a nivel de modelo con belongsTo(pertenece a mucho) y la ruta de dicho modelo. 
    public function Topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }
    //Con este metodo relacionamos la question(pregunta) y levels(niveles) a nivel de modelo con belongsTo(pertenece a mucho) y la ruta de dicho modelo.
    public function Question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
