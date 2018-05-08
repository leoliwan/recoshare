<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reco;

use Illuminate\Support\Facades\Input;


class LikeController extends Controller
{
    public function recoLike()
    {
        $recoId  = Input::get('recoId');
        $reco    = Reco::find($recoId);
 
        if(!$reco->YouLiked()){
            $reco->YouLikeIt();
            return response()->json(['status'=>'success', 'message' => 'liked']);
        }else{
            $reco->YouUnlike();
            return response()->json(['status'=>'success', 'message' => 'unliked']);
        }
    }
}
