<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lojas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("usuario_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("nome");
            $table->string("url");
            $table->string("logo_url");
            $table->string("endereco");
            $table->integer("numero");
            $table->string("bairro");
            $table->string("cidade");
            $table->string("uf");
            $table->integer("cep");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lojas');
    }
};
