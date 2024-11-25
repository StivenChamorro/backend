<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    protected $fillable = ['name', 'description', 'price', 'avatar','type', 'store_id'];
    protected $table = 'articles';

    protected $allowIncluded = ['Store', 'Exchanges','Exchanges.Image_users','Exchanges.Children',
'Exchanges.Children.LevelCompletions','Exchanges.Children.LevelCompletions.Level','Exchanges.Children.LevelCompletions.Level.Questions',
'Exchanges.Children.LevelCompletions.Level.Questions.Answers','Exchanges.Children.LevelCompletions.Level.Topic']; // Relaciones permitidas para inclusión
    protected $allowFilter = ['id', 'name', 'description', 'price']; // Campos permitidos para filtrado
    protected $allowSort = ['id', 'name', 'price']; // Campos permitidos para ordenamiento

    public function Store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function Exchanges(): HasMany
    {
        return $this->hasMany(Exchange::class, 'article_id');
    }

    // Scope para incluir relaciones
    public function scopeIncluded(Builder $query): void
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
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
        if (empty($this->allowFilter) || empty(request('filter'))) {
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
        if (empty($this->allowSort) || empty(request('sort'))) {
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
        if (request('perPage')) {
            $perPage = intval(request('perPage'));

            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
}