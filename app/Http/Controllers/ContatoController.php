<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animais;
use Illuminate\Support\Facades\Log;


class ContatoController extends Controller
{
    public function view($animal_id){

        $infoContato = Animais::join('users', 'animais.user_id', 'users.id')
        ->where('animais.id', $animal_id)
        ->first();


        return view('contato', compact('infoContato'));
    }
}
