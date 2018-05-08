<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reco;
use App\User;
use App\Category;
use Storage;
// use App\Category;

class AdminController extends Controller
{
    public function index()
    {
       
        $users = User::all();
        $recos = Reco::orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        return view('admin.index', compact('recos', 'users', 'categories'));
    }

    public function destroy($id)
    {
        $reco = Reco::find($id);   
        Storage::delete($reco->image);      
         $reco->delete();
         return back()->with('success_message', 'Reco Deleted Successfully');
    
    }

}
