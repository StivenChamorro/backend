<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Answer extends Model
{
    use HasFactory;

    // Relación con la pregunta (question_id)
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Estos campos son asignables masivamente
    protected $fillable = ['answer', 'option', 'question_id'];

    // Relaciones permitidas para incluir
    protected $allowIncluded = ['question'];

    // Filtros permitidos
    protected $allowFilter = ['id', 'answer', 'option', 'question_id'];

    /**
     * Scope para incluir relaciones adicionales (si se especifica en la solicitud).
     */
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return $query;
        }

        $relations = array_intersect(
            explode(',', request('included')),
            $this->allowIncluded
        );

        return $query->with($relations);
    }

    /**
     * Scope para aplicar filtros específicos.
     */
    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return $query;
        }

        foreach (request('filter') as $filter => $value) {
            if (in_array($filter, $this->allowFilter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }

        return $query;
    }
}
