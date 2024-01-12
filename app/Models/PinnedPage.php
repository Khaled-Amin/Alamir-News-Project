<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinnedPage extends Model
{
    use HasFactory;
    protected $table = 'pinned_page';
    protected $fillable =
    [
        'page_name',
        'href',
        'content',
    ];
}
