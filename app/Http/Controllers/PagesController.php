<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Reco;

class PagesController extends Controller
{
    public function disclaimerPage() 
    {
        $categories = Category::all();
        $recos = Reco::all();
        return view('pages.disclaimer', compact('categories', 'recos'));
    }

    public function termsAndConditions() 
    {
        $categories = Category::all();
        $recos = Reco::all();
        return view('pages.termsandconditions',  compact('categories', 'recos'));
    }

    public function about() 
    {
        $categories = Category::all();
        $recos = Reco::all();
        return view('pages.about',  compact('categories', 'recos'));
    }
}
