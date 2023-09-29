<?php

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\V1\StoreLojaRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class StoreLojaRequestTest extends TestCase
{
    public function testValidationPasses()
    {
        $validator = Validator::make([
            'nome' => 'Nome da Loja',
            'url' => 'https://example.com',
            'logo_url' => 'https://example.com/logo.png',
            'endereco' => 'Endereço da Loja',
            'numero' => 123,
            'bairro' => 'Bairro da Loja',
            'cidade' => 'Cidade da Loja',
            'uf' => 'UF da Loja',
            'cep' => 12345678,
        ], (new StoreLojaRequest())->rules());

        $this->assertFalse($validator->fails());
    }
}