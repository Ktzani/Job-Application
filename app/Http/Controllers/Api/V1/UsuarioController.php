<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Usuario;
use App\Http\Controllers\Controller;

use App\Http\Requests\V1\UpdateUsuarioRequest;
use App\Http\Resources\V1\UsuarioResource;
use App\Http\Resources\V1\UsuarioCollection;

use App\Filters\V1\UsuariosFilter;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {   
        $filter = new UsuariosFilter();
        $filterItems = $filter->transform($request); //[['coluna', 'operador', 'valor']]
        
        $usuarios = Usuario::where($filterItems);

        $perPage = $request->input('per_page', 20);
        $includeLojas = $request->query("includeLojas");
        
        if($includeLojas){
            $usuarios = $usuarios->with('lojas');
        }
        
        return response()->json(new UsuarioCollection($usuarios->paginate($perPage)->appends($request->query())));
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {   
        $includeLojas = request()->query("includeLojas");

        if($includeLojas){
            return response()->json(new UsuarioResource($usuario->loadMissing(('lojas'))));
        }

        return response()->json(new UsuarioResource($usuario));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        return response()->json($usuario->update([
            'nome' => $request->has('nome') ? $request->input('nome') : $usuario->nome,
            'email' => $request->has('email') ? $request->input('email') : $usuario->email,
            'senha' => $request->has('senha') ? bcrypt($request->input('senha')) : $usuario->senha,
            'telefone' => $request->has('telefone') ? $request->input('telefone') : $usuario->telefone
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json("Usuário Deletado", 204);
    }
}
