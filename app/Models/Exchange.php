<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exchange extends Model
{
    protected $fillable = ['description', 'children_id', 'article_id'];
    protected $table = 'exchanges';

    // Relaciones permitidas para inclusión
    protected $allowIncluded = ['Article','Article.Store', 'Children','Childre.Levels']; // Añadir más relaciones si es necesario
    // Campos permitidos para filtrado
    protected $allowFilter = ['id', 'description'];
    // Campos permitidos para ordenamiento
    protected $allowSort = ['id', 'description'];

    // Relación con el modelo Article
    public function Article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    // Relación con el modelo Children
    public function Children(): BelongsTo
    {
        return $this->belongsTo(Children::class, 'children_id');
    }
    public function Image_Users()
    {
        return $this->hasMany(Image_User::class);
    }

    // Scope para incluir relaciones
    public function scopeIncluded(Builder $query): void
    {
        if (empty($this->allowIncluded) || !request()->has('included')) {
            return;
        }

        $relations = explode(',', request('included'));
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    // Scope para filtrar resultados
    public function scopeFilter(Builder $query): void
    {
        if (empty($this->allowFilter) || !request()->has('filter')) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }

    // Scope para ordenar resultados
    public function scopeSort(Builder $query): void
    {
        if (empty($this->allowSort) || !request()->has('sort')) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {
            $direction = 'asc';

            if (substr($sortField, 0, 1) === '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    // Scope para obtener o paginar resultados
    public function scopeGetOrPaginate(Builder $query)
    {
        if ($perPage = request('perPage')) {
            $perPage = intval($perPage);

            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
}
