<?php

use App\Http\Resources\V1\UsuarioCollection;
use Illuminate\Http\Request;
use Tests\TestCase;

class UsuarioCollectionTest extends TestCase
{
    public function testToArray()
    {
        $request = Request::create('/');
        $collection = new UsuarioCollection([]);
        $result = $collection->toArray($request);

        $this->assertIsArray($result);
    }
}