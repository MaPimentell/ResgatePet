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
        Log::debug('user_id: ' . $user_id);

        $animais_usuario = Animais::where('user_id', $user_id)->get();
        Log::debug('animais_usuario: ' . $animais_usuario);


        return response()->json($animais_usuario);
    }

}
