<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Animais;


class AnimaisController extends Controller
{
    public function getAnimais(){
        $user_id = Auth::id();

        $animais_usuario = Animais::where('user_id', $user_id)->get();
        
        return response()->json($animais_usuario);
    }

}
