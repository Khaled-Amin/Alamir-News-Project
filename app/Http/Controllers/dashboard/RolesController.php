<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected $rolesemodel;

    public function __construct(Roles $role)
    {
        $this->rolesemodel = $role;
    }
    public function index(){
        $roles = Roles::orderBy('id', 'desc')->get();
        $this->authorize('viewAny', Admin::class);
        return view('backend.roles.index', compact('roles'));
    }
    public function create()
    {
        $this->authorize('create', Admin::class);
        return view('backend.roles.create');
    }
    public function store(Request $request) {
        $validate = $request->validate([
            'role_name'      => ['required', 'max:255'],
            'role_slug'      => ['required', 'max:255'],
        ]);

        $role = Roles::create([
            'name' => ucwords(strtolower($request->role_name)),
            'slug' => $request->role_slug,
        ]);

        return redirect('admin/roles');

    }
    public function edit($id)
    {
        $this->authorize('viewAny', Admin::class);
        $role = Roles::find($id);
        return view('backend.roles.edit', compact('role'));
    }
    public function show($id)
    {
        $role = Roles::find($id);
        return view('backend.roles.show', compact('role'));
    }
    public function update(Request $request, $id){
        // dd($request);
        $role = Roles::find($id);
        $role->name = ucwords(strtolower($request->role_name));
        $role->slug = $request->role_slug;
        $role->update();

        return redirect('admin/roles');
    }

    public function destroy($id) {
        $role = Roles::find($id);
        $role->delete();

        return redirect('admin/roles');
    }
}
