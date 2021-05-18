<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GamesOffline;

class GamesOfflineController extends Controller
{
    //
    public function getGamesOff(){
        $id_user=\Auth::user()->id;
        $gmoff = GamesOffline::where('user_id', $id_user)->get();
    
        // dd($gmoff);
        return $gmoff;
    }

}
