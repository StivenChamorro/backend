<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exchange extends Model
{
    protected $fillable = ['description', 'id_children', 'id_article'];
    protected $table = 'exchanges';

    // Relaciones permitidas para inclusión
    protected $allowIncluded = ['article', 'children']; //añadir mas relaciones (children.user) 
    // Campos permitidos para filtrado
    protected $allowFilter = ['id', 'description']; 
    // Campos permitidos para ordenamiento
    protected $allowSort = ['id', 'description']; 

    // Relación con el modelo Article
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'id_article');
    }

    // Relación con el modelo Children
    public function children(): BelongsTo
    {
        return $this->belongsTo(Children::class, 'id_children');
    }

    // Relacion con el modelo Children_Image (HAIVER)
    public function ChildrenImages (){
        return $this->hasMany('App\Models\ChildrenImage');
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
