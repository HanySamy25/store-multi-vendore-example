<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name','parent_id','description','slug','image','status'];

    // public function scopeActive(Builder $builder)
    // {
    //     $builder->where('status','active');
    // }
    public function scopeFilter(Builder $builder,$filters)
    {

        $builder->when($filters['name']??false,function($builder,$value){
            $builder->where('categories.name','LIKE',"%{$value}%");
        });

        $builder->when($filters['status']??false,function($builder,$value){
            $builder->where('categories.status',$value);
        });


        // if($filters['name']??false){
        //     $builder->where('name','LIKE',"%{$filters['name']}%");
        // }

        // if($filters['status']??false){
        //     $builder->where('status',$filters['status']);
        // }

    }


public function parent()
{
    return $this->belongsTo(Category::class,'parent_id','id')
    ->withDefault([
        'name'=>'Main Category'
    ]);// using withDefault to avoid where the model is null & it works in relation belongs to only
    # code...
}
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
