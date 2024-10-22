<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Alerta;

class AlertasController extends Controller
{
    public function view(){

        $user_id = Auth::id();

        Log::debug($user_id);

        $alertas = Alerta::join('animais', 'animais.id', 'alertas.animal_id')
        ->join('users', 'users.id', 'alertas.user_id')
        ->select(   'alertas.id',
                    'alertas.resgatado',
                    'alertas.created_at',
                    'animais.id as animal_id',
                    'animais.nome',
                    'alertas.exibir')
        ->where('users.id', $user_id)
        ->orderBy('created_at', 'desc')
        ->get();

        $alertas_ativos = Alerta::join('animais', 'animais.id', 'alertas.animal_id')
        ->join('users', 'users.id', 'alertas.user_id')
        ->select('alertas.id')
        ->where('users.id', $user_id)
        ->where('alertas.exibir', 1)
        ->get();

        $alertas_desativados = Alerta::join('animais', 'animais.id', 'alertas.animal_id')
        ->join('users', 'users.id', 'alertas.user_id')
        ->select('alertas.id')
        ->where('users.id', $user_id)
        ->where('alertas.exibir', 0)
        ->get();

        return view('alertas', compact('alertas', 'alertas_ativos', 'alertas_desativados'));
    }

    public function updateResgatado($alerta_id){

        $alerta = Alerta::find($alerta_id);
        $alerta->resgatado = 1;
        $alerta->exibir = 0;
        $alerta->save();

        return redirect()->back()->with('resgatado', 'Ficamos felizes por ter dado tudo certo! ');

    }
    public function desativaAlerta($alerta_id){

        $alerta = Alerta::find($alerta_id);
        $alerta->exibir = 0;
        $alerta->save();

        return redirect()->back()->with('desativado', 'Alerta desativado com sucesso!');
    }

}
