<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Image_User extends Model
{
    use HasFactory;

    protected $fillable = ['url_imagen','exchange_id'];

    protected $allowIncluded = ['Exchange','Exchange.Article','Exchange.Article.Store','Exchange.Children','Exchange.Children.User'];

    protected $allowFilter = ['id', 'image', 'exchange_id'];

    protected $allowSort = ['id', 'image', 'exchange_id'];

    public function  Exchange()
    {
        return $this->belongsTo(Exchange::class);
    }

    public function scopeIncluded(Builder $query)
    {

        if(empty($this->allowIncluded)||empty(request('included'))){
        }


        $relations = explode(',', request('included'));



        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);

            }

        }
        //return $relations;

        $query->with($relations);

        //http://api.codersfree.test/v1/Image_Users?included=Exchange


    }

    public function scopeFilter(Builder $query)
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

        //http://api.codersfree1.test/v1/categories?filter[name]=depo
        //http://api.codersfree1.test/v1/categories?filter[name]=posts&filter[id]=2

    }

    public function scopeSort(Builder $query)
    {

        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {

            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
        //http://api.codersfree1.test/v1/categories?sort=name
    }


}
}
