<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class UsuariosFilter extends ApiFilter {
    protected $safeParams = [
        'nome' => ['eq', 'like'],    
        'email' => ['eq', 'like'],
        'telefone' => ['eq', 'like']
    ];

}

