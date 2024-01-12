<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $guarded = ['web'];
    protected $fillable =
    [
        'nameWebsite',
        'linkWebsite',
        'Keywords',
        'Description',
        'socialMidiaFacebook',
        'socialMidiaTwitter',
        'socialMidiaInstagram',
        'socialMidiaLinkedin',
        'favicon',
        'meta_image'
    ];

    public static function checkSettings()
    {
        // Your logic to retrieve and check settings goes here
        return self::all();
    }

}
