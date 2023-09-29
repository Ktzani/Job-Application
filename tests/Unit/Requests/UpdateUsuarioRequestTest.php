<?php

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\V1\UpdateUsuarioRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UpdateUsuarioRequestTest extends TestCase
{
    public function testValidationPasses()
    {
        $validator = Validator::make([
            'nome' => 'Novo Nome do Usuário',
            'email' => 'newuser@example.com',
            'senha' => 'newpassword123',
            'telefone' => '9876543210',
        ], (new UpdateUsuarioRequest())->rules());

        $this->assertFalse($validator->fails());
    }

}