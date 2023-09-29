<?php

use Illuminate\Http\Request;
use App\Filters\ApiFilter;
use PHPUnit\Framework\TestCase;

class ApiFilterTest extends TestCase
{
    public function testTransformMethodWithValidParams()
    {
        // Mock a request with query parameters
        $request = new Request([
            'param1' => [
                'eq' => 'value1',
                'like' => 'value2',
            ],
        ]);

        $apiFilter = new ApiFilter();
        $result = $apiFilter->transform($request);

        $expectedResult = [
            ['param1', '=', 'value1'],
            ['param1', 'LIKE', 'value2'],
        ];

        $this->assertEquals($expectedResult, $result);
    }
    public function testTransformMethodWithInvalidParams()
    {
        // Mock a request without query parameters
        $request = new Request();

        $apiFilter = new ApiFilter();
        $result = $apiFilter->transform($request);

        $this->assertEmpty($result);
    }
}