<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    //Estos Campos Entran para Asignacion Masiva
    protected $fillable = ['question','answer','score','clue','help','correct_answer','topic_id'];
    // Querys que entran a validacion (Nos trae una relacion anidada que con los ids que tenemos como llave foranea)
    protected $allowIncluded=['Topic','levels'];

    //Con este metodo relacionamos la levels(niveles) y question(pregunta) a nivel de modelo con hasMany(tiene muchos) y la ruta de dicho modelo.
    public function Levels()
    {
        return $this->hasMany('App\Models\Level');
    }
    //Con este metodo relacionamos la tabla topic(tema) y question(pregunta) a nivel de modelo con belongsto(pertenece a mucho) y la ruta de dicho modelo.
    public function Topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }


    public function scopeIncluded(Builder $query)
    {

        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));

        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {

            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }
}
