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
        Schema::create('arquivos_denuncias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('denuncia_id');
            $table->string('descricao')->nullable();
            $table->string('nome');
            $table->string('extensao');
            $table->longText('base64');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('denuncia_id')
                  ->references('id')
                  ->on('denuncias')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivos_denuncias');
    }
};
