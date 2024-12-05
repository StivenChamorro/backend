<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelCompletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'children_id',
        'level_id',
        'status',
    ];

    // Relación con Children
    public function child()
    {
        return $this->belongsTo(Children::class);
    }

    // Relación con Level
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
