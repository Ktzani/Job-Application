<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\Loja;

class LojaControllerTest extends TestCase
{
    use RefreshDatabase;

    private $usuario;

    public function setUp(): void
    {
        parent::setUp();

        $this->usuario = Usuario::factory()->create([
            'senha' => Hash::make('senha_do_usuario'),
        ]);
    }

    public function testListagemDeLojas()
    {
        $this->actingAs($this->usuario);

        // Criar algumas lojas fictícias para o teste
        Loja::factory()->count(5)->create(['usuario_id' => $this->usuario->id]);

        $response = $this->get('/api/v1/lojas');

        $response->assertStatus(200)
            ->assertJsonStructure([
                    '*' => [
                        'id',
                        'nome',
                        'url',
                        'logoUrl',
                        'endereco',
                        'numero',
                        'bairro',
                        'cidade',
                        'uf',
                        'cep',
                    ],
                ]
            );
    }

    public function testCriacaoDeLoja()
    {
        $this->actingAs($this->usuario);

        $dados = [
            "nome" => "Paxton Ondricka",
            "url" => "http://www.mohr.info/",
            "logoUrl" => "http://www.yundt.com/",
            "endereco" => "Zulauf Loop",
            "numero" => 50,
            "bairro" => "Valerie Stravenue",
            "cidade" => "Dustyview",
            "uf" => "MG",
            "cep" => 31275180
        ];

        $response = $this->post('/api/v1/lojas', $dados);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'loja' => [
                    'id',
                    'nome',
                    'url',
                    'logoUrl',
                    'endereco',
                    'numero',
                    'bairro',
                    'cidade',
                    'uf',
                    'cep',
                ],
            ]);
    }

    public function testExibicaoDeLoja()
    {
        $this->actingAs($this->usuario);

        $loja = Loja::factory()->create(['usuario_id' => $this->usuario->id]);

        $response = $this->get('/api/v1/lojas/' . $loja->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'nome',
                'url',
                'logoUrl',
                'endereco',
                'numero',
                'bairro',
                'cidade',
                'uf',
                'cep',
                // Outros campos que deseja verificar
            ]);
    }

    public function testAtualizacaoDeLoja()
    {
        $this->actingAs($this->usuario);

        $loja = Loja::factory()->create(['usuario_id' => $this->usuario->id]);

        $dadosAtualizados = [
            "nome" => "Paxton Ondricka",
            "url" => "http://www.mohr.info/",
            "logoUrl" => "http://www.yundt.com/",
            "endereco" => "Zulauf Loop",
            "numero" => 50,
            "bairro" => "Valerie Stravenue",
            "cidade" => "Dustyview",
            "uf" => "MG",
            "cep" => 31275180
        ];

        $response = $this->put('/api/v1/lojas/' . $loja->id, $dadosAtualizados);

        $response->assertStatus(200)
            ->assertJson([
                'update' => true,
                'message' => 'Loja atualizada com sucesso',
            ]);
        
    }

    public function testDelecaoDeLoja()
    {
        $this->actingAs($this->usuario);

        $loja = Loja::factory()->create(['usuario_id' => $this->usuario->id]);

        $response = $this->delete('/api/v1/lojas/' . $loja->id);

        $response->assertStatus(204);

        // Verificar se a loja foi excluída do banco de dados
        $this->assertDatabaseMissing($loja, ['id' => $loja->id]);
    }
}