<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;


public function User()
    {
    return $this->belongsTo(User::class, 'user_id', 'id'); //belongsTo se usa para relacionar y obtener el inverso de una relacion uno a muchos
    }
    public function LevelCompletions()
    {
    return $this->hasMany(LevelCompletion::class); //belongsTo se usa para relacionar y obtener el inverso de una relacion uno a muchos
    }

    public function Exchanges()
    {
    return $this->hasMany(Exchange::class); //belongsTo se usa para relacionar y obtener el inverso de una relacion uno a muchos
    }
    public function Level_Completions(){
        return $this->hasMany(LevelCompletion::class); //has many llama a todos lo logros que tiene relacionado el niño
     }


    protected $fillable = ['name', 'lastname', 'birthdate', 'nickname', 'relation', 'avatar', 'gender','diamonds', 'user_id']; //Campos que se van a asignacion masiva:
    protected $allowIncluded = ['Exchanges','Exchanges.Image_Users','Exchanges.Article','Exchanges.Article.Store',
    ,'Level_Completions']; //las posibles Querys que se pueden realizar
    protected $allowFilter = ['id','name','lastname','age','nickname','relation','avatar','gender','user_id','children_id',];
    public function Levels(){
        return $this->belongsToMany(level::class); //has many llama a todos lo logros que tiene relacionado el niño
     }
  
    protected $fillable = ['name', 'lastname', 'birthdate', 'nickname', 'relation', 'avatar', 'gender','diamonds', 'user_id']; //Campos que se van a asignacion masiva:
    protected $allowIncluded = ['User','Exchanges','Exchanges.Image_Users','Exchanges.Article','Exchanges.Article.Store',
    'Levels','Levels.Topic','Levels.Topic.Question']; //las posibles Querys que se pueden realizar
    protected $allowFilter = ['id','name','lastname','age','nickname','relation','avatar','gender','diamonds','user_id','children_id',];
 //relaciones a nivel de modelos
 // Un niño pertenece a un solo usuario
 // la clase esta llamada en singular porque un niño pertenece a un solo ususario

 //relacion con logros
 //un niño tiene muchos logros por eso la fucnion esta nombrada en plural


    /////////////////////////////////////////////////////////////////////////////
    public function scopeIncluded(Builder $query)
    {

        if(empty($this->allowIncluded)||empty(request('included'))){// validamos que la lista blanca y la variable included enviada a travez de HTTP no este en vacia.
            return;
        }


        $relations = explode(',', request('included')); //['posts','relation2']//recuperamos el valor de la variable included y separa sus valores por una coma

       // return $relations;

        $allowIncluded = collect($this->allowIncluded); //colocamos en una colecion lo que tiene $allowIncluded en este caso = ['posts','posts.user']

        foreach ($relations as $key => $relationship) { //recorremos el array de relaciones

            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }
        $query->with($relations); //se ejecuta el query con lo que tiene $relations en ultimas es el valor en la url de included

        //http://api.codersfree1.test/v1/categories?included=posts


    }
    //return $relations;
    // return $this->allowIncluded;
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

        //http://api.codersfree1.test/v1/categories?filter[name]=depo
        //http://api.codersfree1.test/v1/categories?filter[name]=posts&filter[id]=2

    }

    public function scopeSort(Builder $query)
    {

        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {

            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
        //http://api.codersfree1.test/v1/categories?sort=name
    }
    }
}

    ///////////////////////////////////////////////////////////////////////////////////////////



