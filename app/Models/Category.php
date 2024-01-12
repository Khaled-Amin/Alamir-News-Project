<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [];
    protected $fillable = ['name', 'slug', 'descr', 'parent_id']; // 'parent_id'


    public function supcategories(){
        return $this->hasMany(Category::class,'parent_id');
    }
    public function parent(){
        return $this->belongsTo(Category::class , 'parent_id');

    }
    public function article(): HasMany
    {

        return $this->hasMany(Article::class , 'category_id' , 'id');
    }

    // public function sites(): HasMany
    // {

    //     return $this->hasMany(Sites::class , 'category_id' , 'id');
    // }




}
