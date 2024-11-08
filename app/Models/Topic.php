<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    //Estos Campos Entran para Asignacion Masiva
    protected $fillable = ['name', 'description'];

    /* Con $allowIncluded podemos relaizar querys. en este caso se pueden ver los id de topics y questions de dicho level,
    ya que $allowIncluded me permite anidar los id de topics y questions como FK de level */
    protected $allowIncluded=['levels'];

    /* Con $allowfilter podemos realizar busquedas especificas de un nivel en especifico. */
    protected $allowFilter = ['id','name','level_id'];

    //Con este metodo relacionamos la topic(tema) y levels(niveles) a nivel de modelo con hasMany(tiene muchos) y la ruta de dicho modelo.
    public function Levels()
    {
        return $this->hasMany('App\Models\Levels');
    }

    /* SCOPE-INCLUDED LEVEL/NIVELE (HAIVER) */
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
