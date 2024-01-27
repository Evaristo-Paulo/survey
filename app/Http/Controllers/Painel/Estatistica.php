<?php

namespace App\Http\Controllers\Painel;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alternativa;
use App\Models\Enquete;
use App\Models\Pergunta;
use RealRashid\SweetAlert\Facades\Alert;

class Estatistica extends Controller
{
    public function pergunta(Request $request)
    {
        try {
            $pagina = 'Estatística / Pergunta';
            $enquetes = Enquete::where('estado', 1)->with('perguntas')->get();

            $notificacao_votacao = Enquete::mostrar_notificacao();
            return view('painel.estatistica.pergunta', compact('pagina', 'enquetes', 'notificacao_votacao'));
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function popular_alternativas_perguntas(Request $request)
    {
        try {
            $pergunta_id = $request->pergunta;
            $alternativas = Alternativa::where('pergunta_id', $pergunta_id)->get();

            return response()->json([
                'dados' => $alternativas
            ]);

        } catch (Exception $error) {
            return response()->json([
                'mensagem' => 'Ocorreu algum erro durante o registo',
                'dados' => $error->getMessage(),
            ], 402);
        }
    }
}
