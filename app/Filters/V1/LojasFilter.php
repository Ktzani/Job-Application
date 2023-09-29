<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class LojasFilter extends ApiFilter {
    protected $safeParams = [
        'usuarioId' => ['eq', 'like'],  
        'nome' => ['eq', 'like'],  
        'url' => ['eq', 'like'],  
        'logoUrl' => ['eq', 'like'],  
        'endereco' => ['eq', 'like'],  
        'numero' => ['eq', 'like', 'ne', 'lt', 'lte', 'gt', 'gte'],  
        'bairro' => ['eq', 'like', 'ne'],  
        'cidade' => ['eq', 'like', 'ne'],  
        'uf' => ['eq', 'like', 'ne'],  
        'cep' => ['eq', 'like', 'ne', 'lt', 'lte', 'gt', 'gte'],  
    ];
    
    protected $columnMap = [
        'usuarioId' => 'usuario_id',
        'logoUrl' => 'logo_url'
    ];
}

