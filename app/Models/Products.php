<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id','category_id','name','description','price','image'];
    public $timestamps = false;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function products()
    {
        return $this->hasMany(\App\Models\Products::class);
    }
}
