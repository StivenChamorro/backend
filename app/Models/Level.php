<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model {
    use HasFactory;


    //Estos Campos Entran para Asignacion Masiva
    protected $fillable = ['name', 'level', 'help', 'score', 'image', 'question_id', 'topic_id'];
    
    /* Con $allowIncluded podemos relaizar querys. en este caso se pueden ver los id de topics y questions de dicho level, 
    ya que $allowIncluded me permite anidar los id de topics y questions como FK de level */
    protected $allowIncluded=['Topic','Question'];


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

    // relacion a nivel de modelos relacion con achievement un nivel tiene muchos logros por eso la funcion esta en plural

    public function achievements(){

        return $this->hasMany('App/Models/Achievement');

    }

    /*
    ESCOPE LEVEL/NIVELE (HAIVER) 
    */
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

    