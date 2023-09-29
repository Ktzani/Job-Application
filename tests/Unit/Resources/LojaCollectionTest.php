<?php

use App\Http\Resources\V1\LojaCollection;
use Illuminate\Http\Request;
use Tests\TestCase;

class LojaCollectionTest extends TestCase
{
    public function testToArray()
    {
        $request = Request::create('/');
        $collection = new LojaCollection([]);
        $result = $collection->toArray($request);

        $this->assertIsArray($result);
    }
}
