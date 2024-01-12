<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class SettigsController extends Controller
{

    public function getSetting()
    {
        $getShowSettings = Setting::first();
        // dd($getShowSettings);
        $this->authorize('view', $getShowSettings);

        return view('backend.settings.addSettings', compact('getShowSettings'));
    }
    public function setSittings(Request $request)
    {
        $validate = $request->validate([
            'nameWebsite' => "max:30",
            // 'Description' => "max:256"
        ]);


        $get_id = Setting::select('id', 'favicon', 'meta_image')->first();
        // Check if record exits or Not
        if (isset($get_id->id)) {
            if ($request->hasFile('favicon')) {
                $pathImg = str_replace('\\', '/', public_path('uploading/')) . $get_id->favicon;
                if (File::exists($pathImg)) {
                    File::delete($pathImg);
                    $myimage = $request->favicon;
                    $time = time();
                    $newImage = Image::make($myimage->getRealPath())->encode('webp', 100)->resize(150, 150)->save(public_path('uploading/' .  $time . '.webp'));
                    DB::table('settings')->where('id', $get_id->id)->update([
                        'favicon' => $time . '.' . 'webp'
                    ]);
                }
            }
            if ($request->hasFile('meta_image')) {
                $pathImg = str_replace('\\', '/', public_path('uploading/')) . $get_id->meta_image;
                if (File::exists($pathImg)) {
                    File::delete($pathImg);
                    $myimage = $request->meta_image;
                    $time_two = 'images' . time();
                    $newImage = Image::make($myimage->getRealPath())->encode('webp', 100)->resize(150, 150)->save(public_path('uploading/' .  $time_two . '.webp'));
                    DB::table('settings')->where('id', $get_id->id)->update([
                        'meta_image' => $time_two . '.' . 'webp'
                    ]);
                }
            }
            $insertToDataBase = DB::table('settings')->where('id', $get_id->id)->update([
                'nameWebsite' => $request->nameWebsite,
                'linkWebsite' => $request->linkWebsite,
                'Description' => $request->content,
                'About_us' => $request->About_us,
                'socialMidiaFacebook' => $request->socialMidiaFacebook,
                'socialMidiaTwitter' => $request->socialMidiaTwitter,
                'socialMidiaLinkedin' => $request->socialMidiaLinkedin,
                'Keywords' => $request->key_words,
            ]);
            return redirect()->back()->with('msg', 'تم تحديث بنجاح');
        } else {
            if ($request->hasFile('favicon')) {
                $myimage = $request->favicon;
                $time = time();
                $newImage = Image::make($myimage->getRealPath())->encode('webp', 100)->resize(150, 150)->save(public_path('uploading/' .  $time . '.webp'));
            }
            if ($request->hasFile('meta_image')) {
                $myimage = $request->meta_image;
                $time_two = 'images' . time();
                $newImage = Image::make($myimage->getRealPath())->encode('webp', 100)->resize(150, 150)->save(public_path('uploading/' .  $time_two . '.webp'));
                $insertToDataBase = DB::table('settings')->insert([
                    'nameWebsite' => $request->nameWebsite,
                    'linkWebsite' => $request->linkWebsite,
                    'Description' => $request->content,
                    'About_us' => $request->About_us,
                    'socialMidiaFacebook' => $request->socialMidiaFacebook,
                    'socialMidiaTwitter' => $request->socialMidiaTwitter,
                    'socialMidiaLinkedin' => $request->socialMidiaLinkedin,
                    'Keywords' => $request->key_words,
                    'favicon' => $time . '.' . 'webp',
                    'meta_image' => $time_two . '.' . 'webp',
                ]);
            }
            else {
                $insertToDataBase = DB::table('settings')->insert([
                    'nameWebsite' => $request->nameWebsite,
                    'linkWebsite' => $request->linkWebsite,
                    'Description' => $request->content,
                    'About_us' => $request->About_us,
                    'socialMidiaFacebook' => $request->socialMidiaFacebook,
                    'socialMidiaTwitter' => $request->socialMidiaTwitter,
                    'socialMidiaLinkedin' => $request->socialMidiaLinkedin,
                    'Keywords' => $request->key_words,
                ]);
            }


            return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
        }
    }
     // Show All Admins
     public function getAdmins(){
        $admins = Admin::select('id', 'name', 'email')->get();
        return view('backend.admins.index', compact('admins'));
    }
}
