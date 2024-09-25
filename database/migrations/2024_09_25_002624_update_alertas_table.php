<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alertas', function (Blueprint $table) {

            $table->dropForeign(['localizacao_id']);
            $table->dropColumn('localizacao_id');
            

            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alertas', function (Blueprint $table) {

            $table->dropColumn(['latitude', 'longitude']);
            $table->unsignedBigInteger('localizacao_id')->nullable();

        });
    }
}
