<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Enquete;
use App\Events\VotoRegistado;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ActualizarEstadoEnqueteEncerrada extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encerra:enquete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza estados das enquetes com datas de encerramento expiradas.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data_actual = Carbon::now()->format('Y-m-d');

        Enquete::where('data_encerramento', '<', $data_actual)->update([
            'estado' => 0,
            'notifica' => 1,
        ]);

        return 'Verificação de enquetes expiradas.';
    }
}
