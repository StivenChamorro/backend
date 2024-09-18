<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    public function  Image_Users()
    {
        return $this->hasMany(Image_User::class);
    }

    public function Article()
    {
    return $this->belongsTo(Article::class); //belongsTo se usa para relacionar y obtener el inverso de una relacion uno a muchos
    }

    public function Children()
    {
    return $this->belongsTo(Children::class); //belongsTo se usa para relacionar y obtener el inverso de una relacion uno a muchos
    }
}
