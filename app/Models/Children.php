<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

public function User()
    {
    return $this->belongsTo(User::class); //belongsTo se usa para relacionar y obtener el inverso de una relacion uno a muchos
    }

    public function Exchanges()
    {
    return $this->hasMany(Exchange::class); //belongsTo se usa para relacionar y obtener el inverso de una relacion uno a muchos
    }

}

