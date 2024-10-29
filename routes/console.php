<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\AtualizaAlertas;
use Illuminate\Support\Facades\Log;

Artisan::command('atualizaAlertas', function () {
    AtualizaAlertas::dispatch();
})->purpose('atualiza alertas expirados');

Schedule::command('atualizaAlertas')->everyMinute();