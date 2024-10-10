<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Alerta;

class AlertasController extends Controller
{
    public function view(){

        $alertas = Alerta::join('animais', 'animais.id', 'alertas.animal_id')
        ->select(   'alertas.id',
                    'alertas.resgatado',
                    'alertas.created_at',
                    'animais.id as animal_id',
                    'animais.nome',
                    'alertas.exibir')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('alertas', compact('alertas'));
    }

    public function updateResgatado($alerta_id){

        $alerta = Alerta::find($alerta_id);
        $alerta->resgatado = 1;
        $alerta->exibir = 0;
        $alerta->save();

        return redirect()->back();

    }
    public function desativaAlerta($alerta_id){

        $alerta = Alerta::find($alerta_id);
        $alerta->exibir = 0;
        $alerta->save();

        return redirect()->back();

    }

}
