<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    //Estos Campos Entran para Asignacion Masiva
    protected $fillable = ['question', 'score','correct_answer', 'clue', 'level_id'];

    // Querys que entran a validacion (Nos trae una relacion anidada que con los ids que tenemos como llave foranea)
    protected $allowIncluded = ['Level','Level.Topic','Answers'];

    /* Con $allowfilter podemos realizar busquedas especificas de una pregunta en especifico. */
    protected $allowFilter = ['id', 'question', 'score','level_id'];

    //Con este metodo relacionamos la levels(niveles) y question(pregunta) a nivel de modelo con hasMany(tiene muchos) y la ruta de dicho modelo.
    public function Level()
    {
        return $this->belongsTo(Level::class);
    }

      // Relación de uno a muchos con las respuestas
      public function Answers()
      {
          return $this->hasMany(Answer::class);
      }

    /* SCOPE-INCLUDED PREGUNTAS/QUESTIONS (HAIVER VELASCO)*/

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

    /* SCOPE-FILTER (HAIVER VELASCO) */

    public function scopeFilter(Builder $query)
    {

        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {

            if ($allowFilter->contains($filter)) {

                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }
}
