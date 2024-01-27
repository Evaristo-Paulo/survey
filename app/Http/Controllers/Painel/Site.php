<?php

namespace App\Http\Controllers\Painel;

use Exception;
use App\Models\Modelo;
use App\Models\Enquete;
use App\Models\Pergunta;
use App\Models\Alternativa;
use Illuminate\Http\Request;
use App\Events\VotoRegistado;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Query\JoinClause;

class Site extends Controller
{
    public function visualizar($id)
    {
        try {
            $id = decrypt($id);
            $resultado = Enquete::find($id);

            if (empty($resultado)) {
                Alert::toast('Não conseguimos processar esta requisição...', 'error');
                return redirect()->back();
            }

            $modelos = Modelo::get();
            $enquete = Enquete::visualizar_enquete($id);

            return view('site.enquetes.votacao', compact('enquete', 'modelos'));
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function votar_escolha_multipla(Request $request)
    {
        try {
            $alternativas = $request->alternativas;
            $pergunta_id = $request->pergunta;

            // PEGA PERGUNTA REFERENTE
            $pergunta = Pergunta::find($pergunta_id);
            /* ADICIONA +1 VOTO NA ALTERNATIVA PERTECENTE A PERGUNTA */

            $enquete = Enquete::where('id', $pergunta->enquete_id)->first();
            // VERIFICA SE A ENQUETE AINDA NÃO FOI ENCERRADA E SE PODE CONTABILIZAR O VOTO

            if ($enquete->estado == 1) {
                $user_id = $enquete->user_id;
                foreach ($alternativas as $alternativa_id) {
                    // PEGA ALTERNATIVA REFERENTE
                    $alternativa = Alternativa::find($alternativa_id);
                    $alternativa->update([
                        'voto' => $alternativa->voto + 1,
                        'notifica' => 1,
                    ]);

                    /* ADICIONA +1 VOTO NA PERGUNTA */
                    $pergunta->update([
                        'voto' => $pergunta->voto + 1,
                    ]);
                }

                $alternativas_actualizadas = Alternativa::whereIn('id', $alternativas)->get()->toArray();

                $dados = [
                    'pergunta' => $pergunta,
                    'alternativas' => $alternativas_actualizadas,
                ];

                $notificacao_votacao = Enquete::mostrar_notificacao($user_id);

                VotoRegistado::dispatch($notificacao_votacao, $user_id);

                return response()->json([
                    'tipo' => 'success',
                    'mensagem' => 'Voto contabilizado com sucesso',
                    'dados' => $dados,
                ], 200);

            } else {
                return response()->json([
                    'tipo' => 'warning',
                ], 200);
            }
        } catch (Exception $error) {
            return response()->json([
                'mensagem' => 'Ocorreu algum erro durante o registo',
                'dados' => $error->getMessage(),
            ], 402);
        }
    }


    public function votar(Request $request)
    {
        try {
            $alternativa_id = $request->alternativa;
            $pergunta_id = $request->pergunta;
            // PEGA ALTERNATIVA REFERENTE
            $alternativa = Alternativa::find($alternativa_id);
            // PEGA PERGUNTA REFERENTE
            $pergunta = Pergunta::find($pergunta_id);

            $enquete = Enquete::where('id', $pergunta->enquete_id)->first();

            // VERIFICA SE A ENQUETE AINDA NÃO FOI ENCERRADA E SE PODE CONTABILIZAR O VOTO

            if ($enquete->estado == 1) {
                $user_id = $enquete->user_id;

                /* ADICIONA +1 VOTO NA ALTERNATIVA PERTECENTE A PERGUNTA */
                $alternativa->update([
                    'voto' => $alternativa->voto + 1,
                    'notifica' => 1,
                ]);
                /* ADICIONA +1 VOTO NA PERGUNTA */
                $pergunta->update([
                    'voto' => $pergunta->voto + 1,
                ]);

                $dados = [
                    'pergunta' => $pergunta,
                    'alternativa' => $alternativa,
                ];

                $notificacao_votacao = Enquete::mostrar_notificacao($user_id);

                VotoRegistado::dispatch($notificacao_votacao, $user_id);

                return response()->json([
                    'tipo' => 'success',
                    'mensagem' => 'Voto contabilizado com sucesso',
                    'dados' => $dados,
                ], 200);
            } else {
                return response()->json([
                    'tipo' => 'warning',
                ], 200);
            }
        } catch (Exception $error) {
            return response()->json([
                'mensagem' => 'Ocorreu algum erro durante o registo',
                'dados' => $error->getMessage(),
            ], 402);
        }
    }
}
