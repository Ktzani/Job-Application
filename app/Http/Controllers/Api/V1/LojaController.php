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

        if(count($filterItems) == 0){
            $lojas = new LojaCollection(Loja::paginate(20));
        }
        else{
            $lojasFiltered = Loja::where($filterItems)->paginate(20);
            $lojas = new LojaCollection($lojasFiltered->appends($request->query()));
        }
        
        return response()->json($lojas);
    }

    public function store(StoreLojaRequest $request)
    {
        return response()->json(new LojaResource(Loja::create([
            'nome' => $request->input('nome'),
            'url' => $request->input('url'),
            'logo_url' => $request->input('logo_url'),
            'endereco' => $request->input('endereco'),
            'numero' => $request->input('numero'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'uf' => $request->input('uf'),
            'cep' => $request->input('cep'),
            'usuario_id' => $request->input('usuario_id'),
        ])), 201);
    }

    public function show(Loja $loja)
    {
        return response()->json(new LojaResource($loja));
    }

    public function update(UpdateLojaRequest $request, Loja $loja)
    {
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
            'usuario_id' => $request->input('usuario_id'),
        ]));
    }

    public function destroy(Loja $loja)
    {
        $loja->delete();
        return response()->json("Loja Deletada", 204);
    }
}
