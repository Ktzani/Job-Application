<?php

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\V1\StoreUsuarioRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class StoreUsuarioRequestTest extends TestCase
{
    public function testValidationPasses()
    {
        $validator = Validator::make([
            'nome' => 'Nome do Usuário',
            'email' => 'user@example.com',
            'senha' => 'password123',
            'telefone' => '1234567890',
        ], (new StoreUsuarioRequest())->rules());

        $this->assertFalse($validator->fails());
    }

}