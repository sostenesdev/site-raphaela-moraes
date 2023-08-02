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
        Schema::create('emendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('titulo')->nullable();
            $table->string('slug')->nullable();
            $table->longText('descricao')->nullable();
            $table->text('objeto')->nullable();
            $table->string('valor')->nullable();
            $table->text('orgao_destino')->nullable();
            $table->string('data_liberacao')->nullable();
            $table->text('beneficiario')->nullable();
            $table->longText('estagio_processo')->nullable();
            $table->text('numero_processo')->nullable();
            $table->text('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emendas');
    }
};
