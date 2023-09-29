<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase; // Isso recriará o banco de dados a cada teste.

    public function testRegistroDeUsuario()
    {
        $dados = [
            'nome' => 'Nome do Usuário',
            'email' => 'usuario@example.com',
            'senha' => 'senha123',
            'telefone' => '1234567890',
        ];

        $response = $this->post('/api/v1/register', $dados);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'usuario',
                'token',
            ]);

        $this->assertDatabaseHas('usuarios', [
            'email' => 'usuario@example.com',
        ]);
    }

    public function testLoginDeUsuario()
    {
        $senha = 'senha123';
        $usuario = Usuario::factory()->create([
            'senha' => bcrypt($senha),
        ]);

        $dados = [
            'email' => $usuario->email,
            'senha' => $senha,
        ];

        $response = $this->post('/api/v1/login', $dados);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'usuario',
                'token',
            ]);
    }

    public function testLoginComCredenciaisInvalidas()
    {
        $dados = [
            'email' => 'naoexiste@example.com',
            'senha' => '12345678',
        ];

        $response = $this->post('/api/v1/login', $dados);

        $response->assertStatus(401)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testLogoutDeUsuario()
    {
        $usuario = Usuario::factory()->create();
        $token = $usuario->createToken('app-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/logout');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Logout realizado com sucesso',
            ]);
    }
}