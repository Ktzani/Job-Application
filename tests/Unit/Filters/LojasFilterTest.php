<?php

use Illuminate\Http\Request;
use App\Filters\V1\LojasFilter;
use PHPUnit\Framework\TestCase;

class LojasFilterTest extends TestCase
{
    public function testTransformMethodWithValidParams()
    {
        // Mock a request with query parameters
        $request = new Request([
            'usuarioId' => ['eq' => 1],
            'nome' => ['like' => 'Store'],
        ]);

        $lojasFilter = new LojasFilter();
        $result = $lojasFilter->transform($request);

        $expectedResult = [
            ['usuario_id', '=', 1],
            ['nome', 'LIKE', 'Store'],
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testTransformMethodWithInvalidParams()
    {
        // Mock a request without query parameters
        $request = new Request();

        $lojasFilter = new LojasFilter();
        $result = $lojasFilter->transform($request);

        $this->assertEmpty($result);
    }
}