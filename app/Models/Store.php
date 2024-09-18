<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Store extends Model
{
    protected $fillable = ['name'];
    protected $table = 'stores';

    // Relación uno a muchos con Articles
    public function articles()
    {
        return $this->hasMany(Article::class, 'id_store');
    }

    /**
     * Scope para incluir relaciones según el parámetro 'included'.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeIncluded(Builder $query)
    {
        $relations = request('included');

        if (empty($relations)) {
            return;
        }

        $relations = explode(',', $relations);
        $allowIncluded = ['articles']; // Relaciones permitidas para inclusión

        $validRelations = array_filter($relations, function($relation) use ($allowIncluded) {
            return in_array($relation, $allowIncluded);
        });

        $query->with($validRelations);
    }

    /**
     * Scope para filtrar resultados según el parámetro 'filter'.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeFilter(Builder $query)
    {
        $filters = request('filter');

        if (empty($filters)) {
            return;
        }

        $allowFilter = ['name']; // Campos permitidos para filtrado

        foreach ($filters as $filter => $value) {
            if (in_array($filter, $allowFilter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }

    /**
     * Scope para ordenar resultados según el parámetro 'sort'.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeSort(Builder $query)
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

    /**
     * Scope para obtener o paginar resultados según el parámetro 'perPage'.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
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
