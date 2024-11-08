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

    // Estos campos entran para asignación masiva
    protected $fillable = ['answer', 'option', 'question_id'];

    // Querys que entran para validación (Nos trae una relación anidada que con los ids que tenemos como llave foránea)
    protected $allowIncluded = ['question'];

    // Con $allowFilter podemos realizar búsquedas específicas de una respuesta
    protected $allowFilter = ['id', 'answer', 'option', 'question_id'];


    /**
     * Scope para incluir relaciones adicionales (si se especifica en la solicitud).
     */
    public function scopeIncluded(Builder $query)
    {
        // Verificamos si hay relaciones solicitadas en la solicitud
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));

        $allowIncluded = collect($this->allowIncluded);

        // Comprobamos que las relaciones solicitadas sean válidas
        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        // Cargamos las relaciones válidas
        $query->with($relations);
    }

    /**
     * Scope para aplicar filtros (por ejemplo, para buscar respuestas específicas).
     */
    public function scopeFilter(Builder $query)
    {
        // Verificamos si hay filtros solicitados
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        // Aplicamos cada filtro que está permitido
        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }
}
