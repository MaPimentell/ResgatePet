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
        
        $user = Auth::id();
        
        $animais = Animais::where('user_id', $user)->get();

        return view('perfilAnimais', compact('animais'));
    }

    public function viewCadastro($animal_id){
        Log::debug('entrou na controller');
        Log::debug($animal_id);
        $animal = Animais::find($animal_id);
        
        return view('auth.animalRegister', compact('animal'));
    }

    public function store(Request $request){
        $user = Auth::id();

        $nomeFormatado = ucwords(strtolower(trim($request->nome)));
        $racaFormatado = ucwords(strtolower(trim($request->raca)));

        $animal = Animais::create([
            'user_id' => $user,
            'nome' => $nomeFormatado,
            'sexo' => $request->sexo,
            'idade' => $request->idade,
            'tipo' => $request->animal,
            'raca' => $racaFormatado,
            'foto' => '', 
        ]);


        if ($request->hasFile('fotoAnimal') && $request->file('fotoAnimal')->isValid()) {
            
            $animalId = $animal->id;
            $filename = "animal_foto_{$user}_{$animalId}." . $request->file('fotoAnimal')->getClientOriginalExtension();
    
            
            $path = $request->file('fotoAnimal')->storeAs("images/animais", $filename, 'public');
    
            
            $animal->update(['foto' => $path]);
        } else {
            
            $animal->update(['foto' => 'images/animais/default_pet.jpg']);
        }
        return redirect('perfilAnimal')->with('animalCadastrado', 'Animal cadastrado com sucesso!');
    
    }

    public function delete($animal_id){
        $animal = Animais::find($animal_id)->delete();

        return response()->json(['success' => true]);
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
