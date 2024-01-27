<?php

namespace App\Http\Controllers\Painel;

use Carbon\Carbon;
use App\Models\Mes;
use App\Models\Modelo;
use App\Models\Enquete;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\VotoRegistado;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;

class Home extends Controller
{
    public function home()
    {
        $pagina = 'Dashboard';
        $uniqueid = Str::random(20);

        $modelos = Modelo::get();
        $enquetes = Enquete::listar_enquete();

        $ano = Carbon::now()->year;
        $estatistica_enquete_registadas = Enquete::estatistica_enquete_registadas($ano);

        $enquete_activa = 0;
        $enquete_encerrada = 0;
        $total_votos = 0;

        foreach ($enquetes as $enquete) {
            $total_votos += $enquete['voto'];
            if ($enquete['estado'] == 1) {
                $enquete_activa++;
            } else {
                $enquete_encerrada++;
            }
        }

        $notificacao_votacao = Enquete::mostrar_notificacao();

        return view('painel.home', compact('pagina', 'notificacao_votacao', 'ano', 'uniqueid', 'modelos', 'total_votos', 'enquetes', 'enquete_activa', 'enquete_encerrada', 'estatistica_enquete_registadas'));
    }
}
