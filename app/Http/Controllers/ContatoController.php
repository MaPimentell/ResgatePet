<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animais;
use Illuminate\Support\Facades\Log;
use App\Models\Post;
use Carbon\Carbon;

class ContatoController extends Controller
{
    // Exibe as informações de contato relacionadas a um animal específico
    public function view($animal_id){

        // Busca as informações de contato do usuário associado ao animal
        $infoContato = Animais::join('users', 'animais.user_id', 'users.id')
        ->join('alertas', 'animais.id', 'alertas.animal_id')
        ->where('animais.id', $animal_id)  // Filtra pelo ID do animal
        ->first();  // Retorna o primeiro resultado

        $data_perdido = Carbon::createFromFormat('Y-m-d H:i:s', $infoContato->data_perdido)->format('d/m/Y');

        // Retorna a view 'contato' com os dados do contato
        return view('contato', compact('infoContato', 'data_perdido'));
    }
}
