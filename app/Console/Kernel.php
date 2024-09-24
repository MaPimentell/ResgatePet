<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Definir comandos Artisan customizados.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('atualizaAlertas');
    }

    /**
     * Carregar os comandos customizados da aplicação.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
