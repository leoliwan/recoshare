<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reco;
use App\Category;
use Storage;


class RecosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $recos = Reco::all();
        return view('admin.reco.index', compact('recos', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return back()->with('success_message', 'Stock Reco Created Succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // $reco = Reco::find($id);
        $reco = Reco::where('slug', '=', $slug)->first();
        $categories = Category::all();
        return view('admin.reco.show', compact('reco', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $reco = Reco::find($id);
        return view('admin.reco.edit', compact('reco', 'categories'));
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
        //validate data
        $this->validate($request, array(
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
    
            $reco = Reco::find($id);
            $reco->user_id = auth()->id();
            $reco->stock = $request->stock;
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
    
            // Delete Old Chart
                $oldImage = $reco->image;
                \Storage::delete($oldImage);
                $reco->image = $filename;
            }
            $reco->save();
    
            return back()->with('success_message', 'Stock Reco Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reco = Reco::find($id);   
        Storage::delete($reco->image);      
         $reco->delete();
         return back()->with('success_message', 'Reco Deleted Successfully');
    
    }


}
