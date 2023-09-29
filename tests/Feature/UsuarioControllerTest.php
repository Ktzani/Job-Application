<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioControllerTest extends TestCase
{
    use RefreshDatabase; // Isso recriará o banco de dados a cada teste.
    private $usuario; // Declare a variável como propriedade da classe

    public function setUp(): void
    {
        parent::setUp();

        // Criar um usuário autenticado para cada teste
        $this->usuario = Usuario::factory()->create([
            'senha' => Hash::make('12345'), // Substitua pela senha desejada
        ]);
    }

    public function testListagemDeUsuarios()
    {   
        $this->actingAs($this->usuario);
        // Criar alguns usuários fictícios para testar
        Usuario::factory()->count(5)->create();

        $response = $this->get('/api/v1/usuarios');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'nome',
                    'email',
                    'telefone'
                ],
            ]);
    }

    public function testExibicaoDeUsuario()
    {
        $this->actingAs($this->usuario);

        $usuario = Usuario::factory()->create();

        $response = $this->get('/api/v1/usuarios/' . $usuario->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'nome',
                'email',
                'telefone'
            ]);
    }

    public function testAtualizacaoDeUsuario()
    {
        $this->actingAs($this->usuario);
        $usuario = Usuario::factory()->create();

        $dadosAtualizados = [
            'nome' => 'Novo',
            'email' => 'teste@example.com',
            'telefone' => '1212221222',
            'senha' => Hash::make('12345672')
        ];

        $response = $this->put('/api/v1/usuarios/' . $usuario->id, $dadosAtualizados);

        $response->assertStatus(200)
            ->assertJson([
                'update' => true,
                'message' => 'Usuário atualizado com sucesso',
            ]);
    
        $dadosAtualizados2 = [
            'nome' => 'Novo Nome',
            'email' => 'novoemail@example.com'
        ];
        
        $response2 = $this->patch('/api/v1/usuarios/' . $usuario->id, $dadosAtualizados2);

        $response2->assertStatus(200)
            ->assertJson([
                'update' => true,
                'message' => 'Usuário atualizado com sucesso',
            ]);

        $this->assertDatabaseHas('usuarios', $dadosAtualizados2);
    }

    public function testExclusaoDeUsuario()
    {
        $this->actingAs($this->usuario);
        $usuario = Usuario::factory()->create();

        $response = $this->delete('/api/v1/usuarios/' . $usuario->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('usuarios', ['id' => $usuario->id]);
    }
}