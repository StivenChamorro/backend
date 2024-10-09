<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'age', 'nickname', 'relation', 'avatar', 'gender', 'user_id']; //Campos que se van a asignacion masiva:

 //relaciones a nivel de modelos
 // Un niño pertenece a un solo usuario
 // la clase esta llamada en singular porque un niño pertenece a un solo ususario
   public function User(){

      return $this->belongsTo(User::class); //belongsTo se usa para relacionar y obtener el inverso de una relacion uno a muchos

   }

 //relacion con logros
 //un niño tiene muchos logros por eso la fucnion esta nombrada en plural

   public function achievements(){

      return $this->hasMany('App/Models/Achievement'); //has many llama a todos lo logros que tiene relacionado el niño

   }

   protected $allowIncluded = ['User']; //las posibles Querys que se pueden realizar

    /////////////////////////////////////////////////////////////////////////////
    public function scopeIncluded(Builder $query)
    {
       
        if(empty($this->allowIncluded)||empty(request('included'))){// validamos que la lista blanca y la variable included enviada a travez de HTTP no este en vacia.
            return;
        }

        
        $relations = explode(',', request('included')); //['posts','relation2']//recuperamos el valor de la variable included y separa sus valores por una coma

        return $relations;

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

    ///////////////////////////////////////////////////////////////////////////////////////////
}

 