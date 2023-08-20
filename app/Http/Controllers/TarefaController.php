<?php

namespace App\Http\Controllers;

use App\Models\tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return tarefa::all();
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
        if(tarefa::create($request->all())){
            return response()->json([
                'message' => 'tarefa registada com sucesso'
            ], 201);
        }
        
        return response()->json([
            'message' => 'Erro ao registar a tarefa'
        ], 404);

    }

    /**
     * Display the specified resource.
     */
    public function show($tarefa)
    {
        $t = tarefa::find($tarefa);
        if($t){
            return $t;
        }

        return response()->json([
            'message' => 'A tarefa nao foi encontrada'
        ],404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tarefa $tarefa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tarefa)
    {
        $t = tarefa::find($tarefa);
        if($t){
            $t->update($request->all());
            return $tarefa;
        }
        
        return response()->json([
            'message' => 'Erro ao atualizar a tarefa'
        ],404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tarefa)
    {
    
        if(tarefa::destroy($tarefa)){
              return response()->json([
                'message' => 'tarefa apagada com sucesso'
              ],201);
        }
        return response()->json([
            'message' => 'Erro ao apagar a tarefa'
        ],404);
    }
}
