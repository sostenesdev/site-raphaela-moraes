<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiencias_publicas', function (Blueprint $table) {
            $table->id();
            $table->text('titulo');
            $table->text('descricao')->nullable();
            $table->text('documento_nome')->nullable();
            $table->string('documento_extensao')->nullable();
            $table->longText('documento_base64')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audiencias_publicas');
    }
};
