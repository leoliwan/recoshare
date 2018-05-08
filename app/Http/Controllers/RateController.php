<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use App\Reco;

class RateController extends Controller
{
    public function postRating(Request $request, Reco $reco) 
    {
        $rating = New Rating;
        $rating->rating = $request->rating;
        $rating->user_id = auth()->user()->id;

        $reco->ratings()->save($rating);

        return back()->with('success_message', 'You just rated this stock reco');
    }
}
