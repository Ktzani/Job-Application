<?php

use App\Http\Resources\V1\LojaResource;
use App\Models\Loja;
use Illuminate\Http\Request;
use Tests\TestCase;

class LojaResourceTest extends TestCase
{
    public function testToArray()
    {
        $request = Request::create('/');
        $loja = new Loja([
            'nome' => 'Minha Loja',
            'usuario_id' => 2,
            'url' => 'https://minhaloja.com',
            'logo_url' => 'https://minhaloja.com/logo.png',
            'endereco' => 'Rua da Loja',
            'numero' => 123,
            'bairro' => 'Centro',
            'cidade' => 'Cidade',
            'uf' => 'UF',
            'cep' => '12345678',
            // Adicione outros atributos da loja
        ]);
        $resource = new LojaResource($loja);
        $result = $resource->toArray($request);

        $this->assertIsArray($result);


    }
}