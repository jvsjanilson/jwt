<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categoria::orderBy('id', 'desc')
            ->paginate(5);
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->only('name', 'image', 'active');


        try {
            $category = Categoria::create($dados);
            return response()->json([$category],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()],401);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categoria::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = $request->only('name', 'image', 'active');
        $categories = Categoria::find($id);

        try {
            $categories->update($dados);
            return response()->json(['message' => 'Atualizado com sucesso.'],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()],401);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categoria::find($id);

        try {
            $category->delete();
            return response()->json(['message' => 'Removido com sucesso.'],200)    ;
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()],401);
        }

    }
}
