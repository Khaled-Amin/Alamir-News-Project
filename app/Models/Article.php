<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    // protected $guarded = ['web'];
    protected $fillable =
    [
        'title',
        'title_slug',
        'content',
        'meta_description',
        'key_words',
        'image',
        'albums',
        'trending',
        'category_id',
        'subcategory_id',
        'user_id'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
