<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\PinnedPage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

use Illuminate\Http\Request;

class PinnedController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $getAllPinnedPage = PinnedPage::latest()->get();
        $DataSittings=Setting::where("id",1)->first();
        return view('backend.pinnedPage.index' , compact(['getAllPinnedPage','DataSittings']));
    }


    public function create(){
        $DataSittings=Setting::where("id",1)->first();
        return view('backend.pinnedPage.create',compact('DataSittings'));
    }

// |image|mimes:png,jpg,jpeg,svg,gif|max:2048|dimensions:min_width=256,min_height=300,max_width=720,max_height=920', /* required|image|mimes:png,jpg,jpeg,svg,gif|max:2048 */
    public function store(Request $request)
    {
        $request->validate([
            'page_name'     => 'required',
            'href'          => 'required|unique:pinned_page,href',
            'content'       => 'required'
            // 'photo'         => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:2048|dimensions:max_width=720,max_height=920'
        ]);


        $mydata=PinnedPage::create([
            'page_name'  => $request->input('page_name'),
            'href'       => $request->input('href'),
            'content'    => $request->input('content')
        ]);

        return redirect()->route('pinned.main')
        ->with('success', 'تم اضافة البيانات');
    }





    public function edit(PinnedPage $pinnedPages , $id)
    {
        $findId = PinnedPage::find($id);
        return view('backend.pinnedPage.edit' , compact('findId'));
    }


    public function update(Request $request ,$id)
    {
        $findId = PinnedPage::find($id);
        $request->validate([
            'page_name'     => 'required',
            'href'          => 'required',
            'content'       => 'required'
            // 'photo'         => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:2048|dimensions:max_width=720,max_height=920'
        ]);

            $findId->page_name = $request->page_name;
            $findId->href      = $request->href;
            $findId->content   = $request->content;
            // $findId->photo     = $newImageName;
            $findId->update();

        return redirect()->route('pinned.main')
            ->with('success' , 'تم تحديث البيانات');
    }


    public function destroy(PinnedPage $pinnedPages , $id)
    {
        $findId = PinnedPage::find($id);
        $findId->delete();
        return  redirect()->route('pinned.main')
            ->with('success' , 'تم حذف البيانات');
    }
}
