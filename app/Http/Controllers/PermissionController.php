<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.permission.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->permission = $request->permission;

        $user->save();
        return back()->with('success_message', 'Permission Has Been Modified');
    }
}
