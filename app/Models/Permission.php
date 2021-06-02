<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','slug','description'];
    public $timestamps = false;

     protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
