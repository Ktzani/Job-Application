<?php

use Illuminate\Http\Request;
use App\Filters\V1\UsuariosFilter;
use PHPUnit\Framework\TestCase;

class UsuariosFilterTest extends TestCase
{
    public function testTransformMethodWithValidParams()
    {
        // Mock a request with query parameters
        $request = new Request([
            'nome' => ['eq' => 'John'],
            'email' => ['like' => 'example'],
        ]);

        $usuariosFilter = new UsuariosFilter();
        $result = $usuariosFilter->transform($request);

        $expectedResult = [
            ['nome', '=', 'John'],
            ['email', 'LIKE', 'example'],
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testTransformMethodWithInvalidParams()
    {
        // Mock a request without query parameters
        $request = new Request();

        $usuariosFilter = new UsuariosFilter();
        $result = $usuariosFilter->transform($request);

        $this->assertEmpty($result);
    }
}