<?php

namespace App\Http\Controllers;

use App\Models\Localizacao;
use App\Models\Alerta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Post;

class MapaController extends Controller
{
    /**
     * Exibe uma lista de alertas de todos os usuários.
     */
    public function index()
    {
        // Exibe todos os alertas com informações sobre os animais e suas localizações
        $alertas_usuarios = Alerta::join('animais', 'animais.id', 'alertas.animal_id')
            ->select(   'alertas.id',
                        'alertas.latitude',
                        'alertas.longitude',
                        'alertas.created_at',
                        'alertas.data_perdido',
                        'animais.id as animal_id',
                        'animais.nome',
                        'animais.idade',
                        'animais.sexo',
                        'animais.tipo',
                        'animais.raca',
                        'animais.foto')
            ->where('exibir', 1)  // Filtra alertas que devem ser exibidos
            ->get();

        // Retorna os alertas de usuários em formato JSON
        return response()->json($alertas_usuarios);
    }


    public function create()
    {
        
    }

    /**
     * Armazena um novo recurso no banco de dados.
     */
    public function store(Request $request)
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Verifica se o usuário já tem uma localização cadastrada
        $localizacao = Localizacao::where('user_id', $user->id)->get();

        // Se não houver localização, cria uma nova
        if ($localizacao->isEmpty()) {
            $localizacao = Localizacao::create([
                'user_id' => $user->id,
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]);
        } else {
            // Se houver, apenas atualiza a latitude e longitude
            $localizacao->latitude = $request->input('latitude');
            $localizacao->longitude = $request->input('longitude');
        }

        // Retorna a localização atualizada ou criada em formato JSON
        return response()->json($localizacao);
    }

    public function show(string $id)
    {
       
    }

   
    public function edit(string $id)
    {
       
    }

    public function update(Request $request, string $id)
    {
       
    }

   
    public function destroy(string $id)
    {
        
    }
}
