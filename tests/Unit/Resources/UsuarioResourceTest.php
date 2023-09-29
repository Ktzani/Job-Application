<?php

use App\Http\Resources\V1\UsuarioResource;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Tests\TestCase;

class UsuarioResourceTest extends TestCase
{
    public function testToArray()
    {
        $request = Request::create('/');
        $usuario = new Usuario([
            
            'nome' => 'Meu Nome',
            'email' => 'meuemail@example.com',
            'telefone' => 1234567890,
        ]);
        $resource = new UsuarioResource($usuario);
        $result = $resource->toArray($request);

        $this->assertIsArray($result);


    }
}
