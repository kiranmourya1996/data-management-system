<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id','name','description'];
    public $timestamps = false;

     protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function products()
    // {
    //     return $this->hasMany(\App\Models\Products::class);
    // }
     public function products()
    {
        // return $this->hasMany(Product::class);
        return $this->belongsToMany(
            Products::class,
            'id',
            'category_id',
            'user_id'
        );
    }

}
