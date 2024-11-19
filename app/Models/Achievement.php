<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Achievement extends Model
{
    use HasFactory;


    protected $fillable = ['name','description','reward','level_id'];

    protected $allowIncluded = ['Children','Children.User','Children.Exchanges',
    'Children.Exchanges.Image_Users','Children.Exchanges.Article','Children.Exchanges.Article.Store',
    'Level','Level.Topic','Level.Question'];

    protected $allowFilter = ['id', 'name', 'description','reward','children_id','level_id'];

    protected $allowSort = ['id', 'name', 'description','reward','children_id','level_id'];


//relacion a nivel de modelos
//relacion con children
//un logro pertenece a un solo niño por eso esta en singular

    public function childrens(){

        return $this->hasMany(Children::class);  //belongsTo llama al niño al cual estann relacionados los logros

    }

//relacion con levels
//un logro pertenece a un solo nivel por eso la funcion esta en singular

    public function level(){

       return $this->belongsTo(Level::class); //belongsTo llama al nivel al cual estan relacionados los logros

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






