<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Animais;
use App\Models\Alerta;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class AnimaisController extends Controller
{
    // Exibe os animais cadastrados do usuário logado
    public function view(){
        
        $user = Auth::id();  // Obtém o ID do usuário logado
        
        $animais = Animais::where('user_id', $user)->get();  // Busca os animais do usuário

        return view('perfilAnimais', compact('animais'));  // Retorna a view com os animais
    }

    // Exibe a página de cadastro de um animal específico
    public function viewCadastro($animal_id){

        Log::debug($animal_id);
        
        $animal = Animais::find($animal_id);  // Busca o animal pelo ID
        Log::debug(json_encode($animal));
        
        return view('auth.animalRegister', compact('animal'));  // Retorna a view de cadastro com os dados do animal
    }

    // Cadastra um novo animal no sistema
    public function store(Request $request){
        $user = Auth::id();  // Obtém o ID do usuário logado
        $animal = Animais::find($request->animal_id);

        Log::debug($request->all());

        $request->validate([
            'fotoAnimal' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',  
        ]);
        
        if($request->animal_id == 0){
            $findAnimal = Animais::select('id')->last();
            $animalId = ($animal->id + 1);
        }

        // Verifica se o usuário enviou uma foto e se é válida
        if ($request->hasFile('fotoAnimal') && $request->file('fotoAnimal')->isValid()) {
            
            if(isset($animal)){
                $animalId = $animal->id;
            }
            // Gera o nome do arquivo da foto
            $filename = "animal_foto_{$user}_{$animalId}." . $request->file('fotoAnimal')->getClientOriginalExtension();
            
            $verifica_foto = "images/animais" . $filename;
            // Verifica se o animal já tem uma foto e se é diferente da nova
            if (isset($animal) && $animal->foto && $animal->foto != $verifica_foto) {
                Storage::disk('public')->delete($animal->foto);
            }
            
            // Salva a foto no diretório correto
            $path = $request->file('fotoAnimal')->storeAs("images/animais", $filename, 'public');
        } else {
            // Caso não tenha foto, define uma foto padrão
            $path = 'images/animais/default_pet.jpg';
        }

        // Formata o nome e a raça do animal
        $nomeFormatado = ucwords(strtolower(trim($request->nome)));
        $racaFormatado = ucwords(strtolower(trim($request->raca)));

        // Cria o animal no banco de dados
        if($animal){

            $animal->update([
                'user_id' => $user,
                'nome' => $nomeFormatado,
                'sexo' => $request->sexo,
                'idade' => $request->idade,
                'tipo' => $request->animal,
                'raca' => $racaFormatado,
                'foto' => $path, 
            ]);

            return redirect('perfilAnimal')->with('animalEditado', 'Animal Editado com sucesso!');

        } else {

            $animal = Animais::create([
                'user_id' => $user,
                'nome' => $nomeFormatado,
                'sexo' => $request->sexo,
                'idade' => $request->idade,
                'tipo' => $request->animal,
                'raca' => $racaFormatado,
                'foto' => $path, 
            ]);

            return redirect('perfilAnimal')->with('animalCadastrado', 'Animal cadastrado com sucesso!');  // Redireciona com mensagem de sucesso
        }
    }

    // Exclui um animal do sistema
    public function delete($animal_id){
        $animal = Animais::find($animal_id)->delete();  // Busca e deleta o animal pelo ID

        return response()->json(['success' => true]);  // Retorna uma resposta JSON de sucesso
    }       

    // Obtém os animais do usuário que não possuem alerta ativo
    public function getAnimais()
    {
        $user_id = Auth::id();  // Obtém o ID do usuário logado

        // Busca os animais que não possuem alerta ativo
        $animais_usuario = Animais::leftJoin('alertas', 'alertas.animal_id', '=', 'animais.id')
            ->join('users', 'animais.user_id', '=', 'users.id')
            ->select('users.id as user_id', 'animais.nome', 'animais.id')
            ->where('animais.user_id', $user_id)
            ->whereNotIn('animais.id', function($query) {
                $query->select('alertas.animal_id')
                    ->from('alertas')
                    ->where('alertas.exibir', 1);  // Verifica se o alerta está ativo
            })
            ->distinct()
            ->get();

        return response()->json($animais_usuario);  // Retorna os animais como resposta JSON
    }

    // Cria um alerta para um animal específico
    public function storeAlerta(Request $request){

        // Busca os dados do animal e sua localização
        $dados = Animais::join('localizacao', 'animais.user_id', 'localizacao.user_id')
        ->select('animais.user_id', 'animais.id as animal_id', 'localizacao.id as localizacao_id')
        ->where('animais.id', $request->input('animal_id'))
        ->first();

        // Cria um novo alerta para o animal
        Alerta::create([
            'user_id' => $dados->user_id,
            'animal_id' => $dados->animal_id,
            'localizacao_id' => $dados->localizacao_id,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'exibir' => 1  // Define o alerta como ativo
        ]);

        return redirect()->back();  // Redireciona de volta para a página anterior
    }

}
