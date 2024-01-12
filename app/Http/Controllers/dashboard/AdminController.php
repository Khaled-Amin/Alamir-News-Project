<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }
    public function index(){
        return view('backend.login.admin_login');
    }

    public function Dashboard(){
        return view('backend.index');
    }

    public function Login(Request $request){
        // dd($request->all());
        $check =  $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'] , 'password'=>$check['password']])){
            return redirect()->route('admin.dashboard')->with('error' , 'Administrator logged in');
        }else{
            return back()->with('error' , 'Error in login email or password');
        }
    }

    public function AdminLogout(Request $request){
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login_form')->with('error' , 'The admin has been logged out');
    }

    // public function AdminRegister(){

    //     return view('admin.admin_register');
    // }

    public function AdminRegisterCreate(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'name'      => ['required', 'string', 'max:255'],
        //     'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password'  => ['required', 'confirmed']
        // ]);
        Admin::insert([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('login_form')->with('error' , 'An admin account has been created');
    }

}
