<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Loja;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreLojaRequest;
use App\Http\Requests\V1\UpdateLojaRequest;
use App\Http\Resources\V1\LojaCollection;
use App\Http\Resources\V1\LojaResource;


use App\Filters\V1\LojasFilter;

class LojaController extends Controller
{
    public function index(Request $request)
    {   
        $filtro = new LojasFilter();
        $filterItems = $filtro->transform($request); //[['coluna', 'operador', 'valor']]

        $perPage = $request->input('per_page', 20);
        $usuario = auth()->user();

        if(count($filterItems) == 0){
            $lojas = new LojaCollection(Loja::where('usuario_id', $usuario->id)->paginate($perPage));
        }
        else{
            $lojasFiltered = Loja::where('usuario_id', $usuario->id)
                ->where($filterItems)
                ->paginate($perPage);
            $lojas = new LojaCollection($lojasFiltered->appends($request->query()));
        }
        
        return response()->json($lojas);
    }

    public function store(StoreLojaRequest $request)
    {
        $usuario = auth()->user();

        $loja = Loja::create([
            'nome' => $request->input('nome'),
            'url' => $request->input('url'),
            'logo_url' => $request->input('logo_url'),
            'endereco' => $request->input('endereco'),
            'numero' => $request->input('numero'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'uf' => $request->input('uf'),
            'cep' => $request->input('cep'),
            'usuario_id' => $usuario->id
        ]);

        return response()->json([
            'loja' => new LojaResource($loja)
        ], 201);
    }

    public function show(Loja $loja)
    {
        return response()->json(new LojaResource($loja));
    }

    public function update(UpdateLojaRequest $request, Loja $loja)
    {
        $usuario = auth()->user();
        return response()->json($loja->update([
            'nome' => $request->has('nome') ? $request->input('nome') : $loja->nome,
            'url' => $request->has('url') ? $request->input('url') : $loja->url,
            'logo_url' => $request->has('logoUrl') ? $request->input('logo_url') : $loja->logo_url,
            'endereco' => $request->has('endereco') ? $request->input('endereco') : $loja->endereco,
            'numero' => $request->has('numero') ? $request->input('numero') : $loja->numero,
            'bairro' => $request->has('bairro') ? $request->input('bairro') : $loja->bairro,
            'cidade' => $request->has('cidade') ? $request->input('cidade') : $loja->cidade,
            'uf' => $request->has('uf') ? $request->input('uf') : $loja->uf,
            'cep' => $request->has('cep') ? $request->input('cep') : $loja->cep,
            'usuario_id' => $usuario->id
        ]));
    }

    public function destroy(Loja $loja)
    {
        $loja->delete();
        return response()->json("Loja Deletada", 204);
    }
}
