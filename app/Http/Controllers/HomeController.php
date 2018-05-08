<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Reco;
use App\User;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $recos = Reco::all();
        $categories = Category::all();
        return view('home', compact('recos','categories', 'users'));
    }


    public function store(Request $request)
    {
        //validate data
        $this->validate($request, array(
        'category_id'       => 'required',
        'stock'              => 'required|max:255',
        'from'              => 'required|numeric',
        'to'                => 'required|numeric',
        'stoploss'          => 'required|numeric',
        'target'             => 'required|numeric',
        'expire'             => 'required|date',
        'risk'              => 'required',
        'type'              => 'required',
        'details'           => 'required',
        'image'             => 'required|image|mimes:jpeg,png,jpg,gif',
        
        ));

        $reco = New Reco;
        $reco->user_id = auth()->id();
        $reco->category_id = $request->category_id;
        $reco->stock = $request->stock;
        $reco->slug = str_slug($reco->stock);
        $reco->from = $request->from;
        $reco->to = $request->to;
        $reco->stoploss = $request->stoploss;
        $reco->target = $request->target;
        $reco->expire = $request->expire;
        $reco->risk = $request->risk;
        $reco->type = $request->type; 
        $reco->details = $request->details;

        // Stock Chart
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time(). ',' .$file->getClientOriginalExtension();
            $location = public_path('/images');
            $file->move($location, $filename);
            $reco->image = $filename;
        }
        $reco->save();

        return back();
    }

    public function stockreco($slug)
    {
        // $reco = Reco::find($id);
        $reco = Reco::where('slug', '=', $slug)->first();
        $categories = Category::all();
        return view('stockreco', compact('reco', 'categories'));
    }

    public function showcategories($slug)
    {
        $recos = Reco::all();
        $categories = Category::all();
        $categories2 = Category::where('slug', '=', $slug)->first();
        return view('showcategories', compact('categories2', 'categories', 'recos'));
    }


    
}
