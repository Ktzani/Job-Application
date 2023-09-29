<?php

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\V1\UpdateLojaRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UpdateLojaRequestTest extends TestCase
{
    public function testValidationPasses()
    {
        $validator = Validator::make([
            'nome' => 'Nome da Loja Atualizada',
            'url' => 'https://example-updated.com',
            'logo_url' => 'https://example-updated.com/logo.png',
            'endereco' => 'Endereço da Loja Atualizada',
            'numero' => 456,
            'bairro' => 'Novo Bairro da Loja',
            'cidade' => 'Nova Cidade da Loja',
            'uf' => 'Novo UF da Loja',
            'cep' => 87654321,
        ], (new UpdateLojaRequest())->rules());

        $this->assertFalse($validator->fails());
    }
}
