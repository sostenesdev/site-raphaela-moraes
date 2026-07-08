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
        Schema::table('proposicoes', function (Blueprint $table) {
            $table->text('titulo')->change();
            $table->text('slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposicoes', function (Blueprint $table) {
            $table->text('titulo')->change();
            $table->string('slug')->nullable()->change();
        });
    }
};
