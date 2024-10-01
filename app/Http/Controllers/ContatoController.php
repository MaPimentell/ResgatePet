<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animais;
use Illuminate\Support\Facades\Log;


class ContatoController extends Controller
{
    public function view($animal_id){

        $animal = Animais::where('id', $animal_id)->first();

        Log::debug($animal);

        return view('contato', compact('animal'));
    }
}
