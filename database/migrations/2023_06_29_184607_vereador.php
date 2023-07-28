<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposicoes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_integracao')->default(0);//se não vier da integração: id_integracao = 0
            $table->text('titulo');
            $table->string('slug')->nullable();
            $table->text('descricao')->nullable();
            $table->string('protocolo')->nullable();
            $table->string('processo')->nullable();
            $table->datetime('data')->nullable();
            $table->string('situacao')->nullable();
            $table->string('tipo')->nullable();
            $table->string('link')->nullable();
            $table->foreignId('user_id')->constrained()->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

        //Cargos do organograma
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->string('funcao')->nullable();
            $table->string('descricao')->nullable();
            $table->string('pessoa_nome')->nullable();
            $table->integer('regime_trabalho')->nullable();
            $table->foreignId('user_id')->constrained()->on('users');
            $table->softDeletes();
            $table->timestamps();
        });

        //Arquivos
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('nome');
            $table->string('extensao')->nullable();
            $table->longText('base64')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cargo_arquivo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cargo_id')->constrained()->on('cargos');
            $table->foreignId('arquivo_id')->constrained()->on('arquivos');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargo_arquivo');
        Schema::dropIfExists('proposicoes');
        Schema::dropIfExists('cargos');
    }
};
