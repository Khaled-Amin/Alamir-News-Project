<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name', 'slug'
    ];

    public function users()
    {
        return $this->belongsToMany(Admin::class, 'users_roles', 'admin_id', 'roles_id');
    }
    // public function admins(){
    //     $this->hasMany(Admin::class);
    // }

    // public function getPermissionsAttribute($permissions) {
    //     return json_decode($permissions, true);

    // }
}
