<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reco;

class SearchController extends Controller
{
    public function search(Request $request)  
    {      
        $q = $request->input('search');      
        $recos = Reco::where('stock', 'LIKE', '%' .$q. '%')->get();
             
        return view('search.results', compact('recos'));

    }
}
