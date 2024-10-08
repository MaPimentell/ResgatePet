<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alerta;

class AlertasController extends Controller
{
    public function view(){

        $alertas = Alerta::join('animais', 'animais.id', 'alertas.animal_id')
        ->select(   'alertas.created_at',
                    'animais.nome')
        ->get();

        return view('alertas', compact('alertas'));
    }
}
