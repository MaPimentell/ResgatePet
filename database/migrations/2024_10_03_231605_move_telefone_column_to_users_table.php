<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MoveTelefoneColumnToUsersTable extends Migration
{
    /**
     * Execute as alterações na tabela.
     *
     * @return void
     */
    public function up()
    {
        // Primeiro, renomeia a coluna 'telefone' temporariamente
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('telefone', 'telefone_temp');
        });

        // Depois, adiciona a coluna 'telefone' novamente na posição correta
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefone')->after('email');
        });

        // Finalmente, copia os dados da coluna temporária para a nova coluna
        DB::table('users')->update(['telefone' => DB::raw('telefone_temp')]);

        // Remove a coluna temporária
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telefone_temp');
        });
    }

    /**
     * Reverte as alterações na tabela.
     *
     * @return void
     */
    public function down()
    {
        // Para reverter, você pode precisar fazer o processo inverso.
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefone_temp')->after('email'); // Adiciona coluna temporária de volta
        });

        DB::table('users')->update(['telefone_temp' => DB::raw('telefone')]); // Copia dados

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telefone'); // Remove coluna original
            $table->renameColumn('telefone_temp', 'telefone'); // Renomeia coluna temporária de volta
        });
    }
}
