<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelCompletion extends Model
{
    

    protected $fillable = [
        'child_id',
        'level_id',
        'status',
    ];
    protected $allowIncluded = ['Children','Children.User','Children.Exchanges','Children.Exchanges.Image_users',
     'Children.Exchanges.Articles','Children.Exchanges.Articles.Store'];

     protected $allowFilter = [
        'child_id',
        'level_id',
        'status',
    ];

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

    public function scopeIncluded(Builder $query): void
    {
        $relations = request('included');

        if (empty($relations)) {
            return;
        }

        $relations = explode(',', $relations);
        $allowIncluded = ['Children','Children.User','Children.Exchanges','Children.Exchanges.Image_users',
     'Children.Exchanges.Articles','Children.Exchanges.Articles.Store']; // Relaciones permitidas para inclusión

        $validRelations = array_filter($relations, function($relation) use ($allowIncluded) {
            return in_array($relation, $allowIncluded);
        });

        $query->with($validRelations);
    }

    // Scope para filtrar resultados
    public function scopeFilter(Builder $query): void
    {
        $filters = request('filter');

        if (empty($filters)) {
            return;
        }

        $allowFilter = ['name', 'description']; // Campos permitidos para filtrado

        foreach ($filters as $filter => $value) {
            if (in_array($filter, $allowFilter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }

    // Scope para ordenar resultados
    public function scopeSort(Builder $query): void
    {
        $sortFields = request('sort');

        if (empty($sortFields)) {
            return;
        }

        $sortFields = explode(',', $sortFields);
        $allowSort = ['id', 'name']; // Campos permitidos para ordenamiento

        foreach ($sortFields as $sortField) {
            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if (in_array($sortField, $allowSort)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    // Scope para obtener o paginar resultados
    public function scopeGetOrPaginate(Builder $query)
    {
        $perPage = request('perPage');

        if ($perPage) {
            $perPage = intval($perPage);
            if ($perPage > 0) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
}
