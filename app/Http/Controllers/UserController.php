<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Reco;
use App\Category;
use Storage;

class UserController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recos = Reco::all();
        $users = User::all();
        $categories = Category::all();
        return view('user.index', compact('users', 'recos', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     // This create function is used by Admin to allow user permission


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name'         => 'required',
            'avatar'       => 'max:100',
        ));

        $user = User::find($id);
        // $user->user_id = auth()->id();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->donate = $request->donate;
        $user->bank_account = $request->bank_account;
        $user->link = $request->link;
   
    
        // Avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time(). ',' .$file->getClientOriginalExtension();
            $location = public_path('/images');
            $file->move($location, $filename);

        // Delete Old Chart
            $oldImage = $user->avatar;
            Storage::delete($oldImage);

            $user->avatar = $filename;
        }
        $user->save();

        return back()->with('success_message', 'Your profile has been succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
