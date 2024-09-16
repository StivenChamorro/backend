<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

 //relaciones a nivel de modelos
 // Un niño pertenece a un solo usuario
 // la clase esta llamada en singular porque un niño pertenece a un solo ususario
   public function user(){

      return $this->belongsTo('App/Models/User'); //belongsTo se usa para relacionar y obtener el inverso de una relacion uno a muchos

   }

 //relacion con logros
 //un niño tiene muchos logros por eso la fucnion esta nombrada en plural

   public function achievements(){

      return $this->hasMany('App/Models/Achievement'); //has many llama a todos lo logros que tiene relacionado el niño

   }
}

 