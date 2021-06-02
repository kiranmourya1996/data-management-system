<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PermissionRole;
use App\Models\Permission;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','description'];
    public $timestamps = false;

     protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function permission()
    {
        // return $this->hasMany(Product::class);
        // return $this->belongsToMany(
        //     Permission::class,
        //     'permission_role',
        //     'permission_id',
        //     'role_id'
        // );
        return $this->belongsToMany('App\Models\Permission','permission_role', 'role_id', 'permission_id')->withTimestamps();
    }
}
