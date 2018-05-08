<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class BankPermissionController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.bankpermission.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->bank_permission = $request->bank_permission;

        $user->save();
        return back()->with('success_message', 'Permission Has Been Modified');
    }
}
