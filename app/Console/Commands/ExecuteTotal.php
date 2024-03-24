<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use App\Jobs\CalcularCostoTotal;

class ExecuteTotal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'execute:total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcular costo total';

    /**
     * Execute the console command.
     */
    public function handle()
    {
	CalcularCostoTotal::dispatch();
	$this->info('Queue para costo total en cola exitosamente');
    }
}
