<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alertas', function (Blueprint $table) {
            DB::statement('ALTER TABLE alertas
            MODIFY COLUMN `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
            MODIFY COLUMN `user_id` BIGINT UNSIGNED AFTER `id`,
            MODIFY COLUMN `animal_id` BIGINT UNSIGNED AFTER `user_id`,
            MODIFY COLUMN `latitude` DECIMAL(10, 8) AFTER `animal_id`,
            MODIFY COLUMN `longitude` DECIMAL(11, 8) AFTER `latitude`,
            MODIFY COLUMN `exibir` TINYINT(1) AFTER `longitude`,
            MODIFY COLUMN `created_at` TIMESTAMP AFTER `exibir`,
            MODIFY COLUMN `updated_at` TIMESTAMP AFTER `created_at`');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alertas', function (Blueprint $table) {
            //
        });
    }
};
