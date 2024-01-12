<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfileAdminsController extends Controller
{


    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $profile= DB::table('admins')->find($id);
    //     return view('backend.admins.profile', compact('profile'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
