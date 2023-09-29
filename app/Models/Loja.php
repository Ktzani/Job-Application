<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'url',
        'logo_url',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'usuario_id'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }
}
