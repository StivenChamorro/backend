<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model {
    use HasFactory;


    //Estos Campos Entran para Asignacion Masiva
    protected $fillable = ['name', 'score','topic_id'];

    /* Con $allowIncluded podemos relaizar querys. en este caso se pueden ver los id de topics y questions de dicho level,
    ya que $allowIncluded me permite anidar los id de topics y questions como FK de level */
    protected $allowIncluded=['Topic','Questions','Questions.Answers','Level_Completions'];

    /* Con $allowfilter podemos realizar busquedas especificas de un nivel en especifico. */
    protected $allowFilter = ['id','name','score','topic_id'];


    //Con este metodo relacionamos la topic(tema) y levels(niveles) a nivel de modelo con belongsTo(pertenece a mucho) y la ruta de dicho modelo.
    public function Topic()
    {
        return $this->belongsTo(Topic::class);
    }
    //Con este metodo relacionamos la question(pregunta) y levels(niveles) a nivel de modelo con belongsTo(pertenece a mucho) y la ruta de dicho modelo.
    public function Questions()
    {
        return $this->hasMany(Question::class);
    }

    // relacion a nivel de modelos relacion con achievement un nivel tiene muchos logros por eso la funcion esta en plural

    public function Level_Completions(){
        return $this->hasMany(LevelCompletion::class); //has many llama a todos lo logros que tiene relacionado el niño
     }

    /*
    SCOPE-INCLUDED LEVEL/NIVELE (HAIVER)
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

    // SCOPE-FILTER (HAIVER VELASCO)

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
