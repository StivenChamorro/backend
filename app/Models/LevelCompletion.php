<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'level_id',
        'status',
    ];
    protected $allowIncluded = ['Childrens'];

    // Relación con Children
    public function Children()
    {
        return $this->belongsTo(Children::class);
    }

    // Relación con Level
    public function Level()
    {
        return $this->belongsTo(Level::class);
    }

    
}
