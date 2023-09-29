<?php

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\V1\LoginUsuarioRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class LoginUsuarioRequestTest extends TestCase
{
    public function testValidationPasses()
    {
        $validator = Validator::make([
            'email' => 'user@example.com',
            'senha' => 'password123',
        ], (new LoginUsuarioRequest())->rules());

        $this->assertFalse($validator->fails());
    }

}