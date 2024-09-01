<?php

namespace App\Http\Controllers;

use App\Models\Localizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $localizacao = Localizacao::where('user_id', $user->id)->get();

       if($localizacao->isEmpty()){
            $localizacao = Localizacao::create([
                'user_id' => $user->id,
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]);
       }else{
            $localizacao->latitude = $request->input('latitude');
            $localizacao->latitude = $request->input('longitude');
       }

        return response()->json($localizacao);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
