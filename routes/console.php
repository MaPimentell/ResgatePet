<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;




Artisan::command('atualizaAlertas', function () {

    DB::table('alertas')
        ->where('created_at', '<=', now()->subDay())
        ->where('exibir', 1)
        ->update(['exibir' => 0]);

})->purpose('atualiza alertas expirados')->everySecond();
