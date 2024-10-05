<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTelefoneToUsersTable extends Migration
{
    /**
     * Execute as alterações na tabela.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefone'); // Campo não nulo
        });
    }

    /**
     * Reverte as alterações na tabela.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telefone'); // Remove a coluna 'telefone'
        });
    }
}
