<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait UploadSingleImageTrait {

    public function processSingleImage($image, $folder='articlePic/', $disk='public', $width = 300, $height = 300)
    {
        if(isset($image)){
            $filename = time() . '.' .'webp';
            Image::make($image->getRealPath())->encode('webp', 100)->resize($width, $height)->save(public_path($folder . $filename));
            return $filename;
        }
        return null;
    }
    public function ckProcessSingleImage($image, $folder='articlePic/', $disk='public', $width = 300, $height = 300)
    {
        if(isset($image)){
            $filename = time() . '.' .'webp';
            Image::make($image->getRealPath())->encode('webp', 100)->resize($width, $height)->save(public_path($folder . $filename));
            return $filename;
        }
        return null;
    }

}
