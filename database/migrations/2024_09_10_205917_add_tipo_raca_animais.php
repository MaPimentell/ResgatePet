<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->string('tipo')->after('idade'); // Adiciona a coluna 'tipo' após a coluna 'idade'
            $table->string('raca')->nullable()->after('tipo'); // Adiciona a coluna 'raca' após 'tipo' (permitindo valores nulos)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('animais', function (Blueprint $table) {
            $table->dropColumn('tipo');
            $table->dropColumn('raca');
        });
    }
};
