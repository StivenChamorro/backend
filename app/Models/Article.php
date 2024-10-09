<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function  Exchanges()
    {
        return $this->hasMany(Exchange::class);
    }

    public function Store()
    {
    return $this->belongsTo(Store::class); 
    }
}
