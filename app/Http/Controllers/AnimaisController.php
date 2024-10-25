<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Animais;
use App\Models\Alerta;
use Carbon\Carbon;

class AnimaisController extends Controller
{

    public function view(){
        
    }

    public function getAnimais()
    {
        $user_id = Auth::id();

        $animais_usuario = Animais::leftJoin('alertas', 'alertas.animal_id', '=', 'animais.id')
            ->join('users', 'animais.user_id', '=', 'users.id')
            ->select('users.id as user_id', 'animais.nome', 'animais.id')
            ->where('animais.user_id', $user_id)
            ->whereNotIn('animais.id', function($query) {
                $query->select('alertas.animal_id')
                    ->from('alertas')
                    ->where('alertas.exibir', 1);
            })
            ->distinct()
            ->get();

        return response()->json($animais_usuario);
    }

   public function storeAlerta(Request $request){

        $dados = Animais::join('localizacao', 'animais.user_id', 'localizacao.user_id')
        ->select('animais.user_id', 'animais.id as animal_id', 'localizacao.id as localizacao_id')
        ->where('animais.id', $request->input('animal_id'))
        ->first();

        Alerta::create([
            'user_id' => $dados->user_id,
            'animal_id' => $dados->animal_id,
            'localizacao_id' => $dados->localizacao_id,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'exibir' => 1
        ]);

        return redirect()->back();
    }

}
