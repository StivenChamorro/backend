<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;


    protected $fillable = ['name','description','reward','children_id','level_id'];

    protected $allowIncluded = ['Children','Children.User','level'];

    protected $allowFilter = ['id', 'image', 'exchange_id'];

    protected $allowSort = ['id', 'image', 'exchange_id'];


//relacion a nivel de modelos
//relacion con children
//un logro pertenece a un solo niño por eso esta en singular

    public function children(){

        return $this->belongsTo(Children::class);  //belongsTo llama al niño al cual estann relacionados los logros

    }

//relacion con levels
//un logro pertenece a un solo nivel por eso la funcion esta en singular

    public function level(){

       return $this->belongsTo(Level::class); //belongsTo llama al nivel al cual estan relacionados los logros

    }

}



