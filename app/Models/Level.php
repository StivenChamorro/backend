<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

//relacion a nivel de modelos
//relacion con achievement
//un nivel tiene muchos logros por eso la funcion esta en plural

    public function achievements(){

        return $this->hasMany('App/Models/Achievement');

    }
}
