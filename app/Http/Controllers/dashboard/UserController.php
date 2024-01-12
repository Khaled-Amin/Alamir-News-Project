<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Article;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $user;
    public function __construct(Admin $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $users = Admin::with('roles')->orderBy('id', 'desc')->get();
        $userID = Admin::with('roles')->orderBy('id', 'desc')->first();
        $this->authorize('create', Admin::class);
        // $this->authorize('viewAny', $users);
        return view('backend.users.index', compact('userID','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $this->authorize('create', Admin::class);
    $roles = Roles::all();
    $user = Admin::with('roles')->orderBy('id', 'desc')->first();
    return view('backend.users.create', compact('user','roles'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $this->authorize('viewAny', Admin::class);
        // dd($request);
        $request->validate([
                'name'      => ['required', 'max:255'],
                'email'     => ['required','email', 'max:255', 'unique:admins'],
                'password'  => ['required', 'confirmed', 'between:8,255'],
                'password_confirmation'  => ['required']
        ]);
        $user = Admin::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'created_at' => \Carbon\Carbon::now(),
        ]);
        // dd($request->role);
        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        return redirect()->route('user.main');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Admin::find($id);
        return view('backend.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Admin::with('roles')->find($id);
        $this->authorize('viewAny', Admin::class);
        $roles = Roles::get();

        return view('backend.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('viewAny', Admin::class);
        // dd($request);
        // $request->validate([
        //     'name'      => ['required', 'max:255'],
        //     'email'     => ['required','email', 'max:255', 'unique:admins'],
        //     'password'  => ['required', 'confirmed', 'between:8,255'],
        //     'password_confirmation'  => ['required']
        // ]);
        $user = Admin::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

        $user->update();

        $user->roles()->detach();

        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        return redirect()->route('user.main');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Admin::find($id);
        $this->authorize('viewAny', Admin::class);
        $user->roles()->detach();
        Article::select('user_id')->where('user_id', $user->id)->delete();
        $user->delete();

        return redirect()->route('user.main');

    }
}
