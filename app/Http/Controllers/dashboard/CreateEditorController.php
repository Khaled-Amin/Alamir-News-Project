<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CreateEditorController extends Controller
{
    public function index(){
        $editor = Admin::select('id', 'name', 'email', 'status')->where('status', 0)->get();
        return view('backend.editors.index', compact('editor'));
    }

    public function create(){
        return view('backend.editors.create');
    }
    public function store(Request $request){
        $request->validate([
                'name'      => ['required', 'string', 'max:255'],
                'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'  => ['required']
        ]);
        Admin::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        return redirect()->route('createEditor.main')
            ->with('success' , 'Successfuly Add Editors');
    }
    public function destroy($id){
        $editor = Admin::find($id);
        $editor->delete();

        return redirect()->route('createEditor.main')
            ->with('success' , 'Successfuly Add Editors');
    }

}
