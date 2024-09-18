<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    //Estos Campos Entran para Asignacion Masiva
    protected $fillable = ['name', 'description', 'dificult'];

    //Con este metodo relacionamos la topic(tema) y levels(niveles) a nivel de modelo con hasMany(tiene muchos) y la ruta de dicho modelo. 
    public function Levels()
    {
        return $this->hasMany('App\Models\Levels');
    }
}
