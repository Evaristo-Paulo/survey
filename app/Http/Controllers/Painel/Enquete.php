<?php

namespace App\Http\Controllers\Painel;

use Exception;
use App\Models\Modelo;
use App\Models\Pergunta;
use App\Models\Alternativa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\PartilhaURLEnquete;
use App\Models\PerguntaTemporaria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AlternativaTemporaria;
use App\Models\Enquete as Questionario;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Validator;

class Enquete extends Controller
{

    public function visualizar_enquete($id)
    {
        try {
            $pagina = 'Enquete / Visualização';
            $modelos = Modelo::get();
            $uniqueid = Str::random(20);

            $resultado = Questionario::find($id);

            if (empty($resultado)) {
                Alert::toast('Não conseguimos processar esta requisição...', 'error');
                return redirect()->back();
            } else {
                // VERIFICA SE O USER LOGADO PERTENCE ESTA ENQUETE
                if ($resultado->user_id != Auth::user()->id) {
                    Alert::toast('Não conseguimos processar esta requisição...', 'error');
                    return redirect()->back();
                }
            }

            $enquete = Questionario::visualizar_enquete($id);
            $usuario_logado_id = Auth::user()->id;
            $notificacao_votacao = Questionario::mostrar_notificacao($usuario_logado_id);

            return view('painel.enquetes.visualizacao', compact('pagina', 'enquete', 'modelos', 'uniqueid', 'notificacao_votacao'));
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            return redirect()->back();
        }
    }

    public function ler_notificacao($enquete, $alternativa)
    {
        try {
            $id = $enquete;
            $resultado = Questionario::find($id);

            if (empty($resultado)) {
                Alert::toast('Não conseguimos processar esta requisição...', 'error');
                return redirect()->back();
            } else {
                // VERIFICA SE O USER LOGADO PERTENCE ESTA ENQUETE
                if ($resultado->user_id != Auth::user()->id) {
                    Alert::toast('Não conseguimos processar esta requisição...', 'error');
                    return redirect()->back();
                }
            }

            // SERÁ -1 CASO SEJA UMA NOTIFICAÇÃO DE ENCERRAMENTO DA ENQUETE, OU SEJA, NÃO FARÁ REFERÊNCIA A UMA ALTERNATIVA EM ESPECÍFICO
            if ($alternativa != -1) {
                $dados_alternativa = Alternativa::find($alternativa);
                /* ACTUALIZA A NOTIFICAÇÃO NA ALTERNATIVA PERTECENTE A PERGUNTA */
                $dados_alternativa->update([
                    'notifica' => 0,
                ]);
            } else {
                $dados_enquete = $resultado;
                /* ACTUALIZA A NOTIFICAÇÃO NA ENQUETE PERTECENTE A PERGUNTA */
                $dados_enquete->update([
                    'notifica' => 0, // NÃO NOTIFICA
                ]);
            }

            return to_route('sys.enquete.visualizacao', $id);
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            return redirect()->back();
        }
    }

    public function remover_enquete(Request $request)
    {
        try {

            $id = $request->id;
            Questionario::where('id', $id)->delete();
            Alert::toast('Enquete removida com sucesso!', 'success');

            return to_route('sys.dashboard');
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function partilhar_por_email(Request $request)
    {
        try {
            $id = $request->id;
            $destinatario = $request->email;

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {

                Alert::toast('Verifique os campos e tenta novamente.', 'error');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }


            $enquete = Questionario::find($id);
            $remetente = Auth::user();

            PartilhaURLEnquete::dispatch($enquete, $remetente, $destinatario)->delay(now()->addSeconds('20'));

            Alert::toast('Email enviado com sucesso!', 'success');

            return redirect()->back();
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function registar_enquete(Request $request)
    {
        try {
            $enquete = Questionario::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'user_id' => Auth::user()->id,
                'data_encerramento' => $request->data_encerramento,
            ]);

            $referencia = $request->referencia;

            $perguntas = PerguntaTemporaria::where('referencia_enquete', $referencia)->get();

            foreach ($perguntas as $pergunta) {
                $buscaPergunta = Pergunta::create([
                    'pergunta' => $pergunta->pergunta,
                    'total_alternativa' => $pergunta->total_alternativa,
                    'modelo_id' => $pergunta->modelo_id,
                    'enquete_id' => $enquete->id,
                ]);

                $alternativas = AlternativaTemporaria::where('pergunta_id', $pergunta->id)->get();

                foreach ($alternativas as $alternativa) {
                    /* ADICIONAR ALTERNATIVA */
                    Alternativa::create([
                        'alternativa' => str::upper($alternativa->alternativa),
                        'pergunta_id' => $buscaPergunta->id,
                    ]);
                }

                AlternativaTemporaria::where('pergunta_id', $pergunta->id)->delete();
            }

            // APAGAR DADOS DA TABELA TEMPORÁRIA
            PerguntaTemporaria::where('referencia_enquete', $referencia)->delete();

            $link = URL::signedRoute('site.enquetes.perguntas.visualizacao', ['id' => encrypt($enquete->id)]);

            $enquete->update([
                'url' => $link
            ]);

            Alert::toast('Enquete registada com sucesso!', 'success');
            return to_route('sys.dashboard');
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function actualizar_enquete_anexo(Request $request)
    {
        try {
            $referencia = $request->referencia;

            $perguntas = PerguntaTemporaria::where('referencia_enquete', $referencia)->get();

            foreach ($perguntas as $pergunta) {
                $buscaPergunta = Pergunta::create([
                    'pergunta' => $pergunta->pergunta,
                    'total_alternativa' => $pergunta->total_alternativa,
                    'modelo_id' => $pergunta->modelo_id,
                    'enquete_id' => $request->id,
                ]);

                $alternativas = AlternativaTemporaria::where('pergunta_id', $pergunta->id)->get();

                foreach ($alternativas as $alternativa) {
                    /* ADICIONAR ALTERNATIVA */
                    Alternativa::create([
                        'alternativa' => str::upper($alternativa->alternativa),
                        'pergunta_id' => $buscaPergunta->id,
                    ]);
                }

                AlternativaTemporaria::where('pergunta_id', $pergunta->id)->delete();
            }

            // APAGAR DADOS DA TABELA TEMPORÁRIA
            PerguntaTemporaria::where('referencia_enquete', $referencia)->delete();

            Alert::toast('Enquete actualizada com sucesso!', 'success');
            return redirect()->back();
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function actualizar_enquete_cabecalho(Request $request)
    {
        try {
            $id = $request->id;

            $validator = Validator::make($request->all(), [
                'nome' => 'required|min:3',
                'descricao' => 'required|min:3',
            ]);

            if ($validator->fails()) {

                Alert::toast('Verifique os campos e tenta novamente.', 'error');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $enquete = Questionario::where('id', $id)->update([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'data_encerramento' => $request->data_encerramento,
                'estado' => $request->estado,
            ]);

            Alert::toast('Enquete actualizada com sucesso!', 'success');
            return redirect()->back();
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function actualizar_enquete_alternativa(Request $request)
    {
        try {
            $id = $request->id;

            Pergunta::where('id', $id)->update([
                'pergunta' => $request->pergunta,
                'total_alternativa' => $request->total_alternativa,
                'modelo_id' => $request->modelo,
            ]);

            if ($request->has('alternativas')) {
                $alternativas = $request->alternativas;

                foreach ($alternativas as $alternativa) {
                    /* ADICIONAR ALTERNATIVA */
                    Alternativa::create([
                        'alternativa' => str::upper($alternativa),
                        'pergunta_id' => $id,
                    ]);
                }
            }

            Alert::toast('Pergunta actualizada com sucesso!', 'success');
            return redirect()->back();
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function remover_alternativa(Request $request)
    {
        try {

            $id = $request->id;
            $pergunta_id = $request->pergunta_id;

            $pergunta = Pergunta::find($pergunta_id);
            $total_alternativas = $pergunta->total_alternativa;

            // SÓ PODE ELIMINAR SE A PERGUNTA TIVER MAIS DE 2 ALTERNATIVAS
            if ($total_alternativas > 2) {
                $alternativa = Alternativa::find($id);

                // ACTUALIZA OS VOTOS E TOTAL ALTERNATIVA, APÓS A EXCLUSÃO DA ALTERNATIVA
                $pergunta->update([
                    'voto' => $pergunta->voto - $alternativa->voto,
                    'total_alternativa' => $pergunta->total_alternativa - 1,
                ]);

                $alternativa->delete();

                Alert::toast('Alternativa removida com sucesso', 'warning');
            } else {
                Alert::toast('As perguntas devem ter no mínimo 2 alternativas', 'error');
            }

            return redirect()->back();
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function remover_pergunta(Request $request)
    {
        try {
            $id = $request->id;

            Pergunta::where('id', $id)->delete();
            Alert::toast('Pergunta removida com sucesso', 'warning');

            return redirect()->back();
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function adicionar_pergunta(Request $request)
    {
        try {
            /* ADICIONAR PERGUNTA */
            $pergunta = PerguntaTemporaria::create([
                'referencia_enquete' => $request->referencia,
                'pergunta' => $request->pergunta,
                'total_alternativa' => $request->total_alternativa,
                'modelo_id' => $request->modelo,
            ]);

            $alternativas = $request->alternativas;

            foreach ($alternativas as $alternativa) {
                /* ADICIONAR ALTERNATIVA */
                AlternativaTemporaria::create([
                    'alternativa' => str::upper($alternativa),
                    'pergunta_id' => $pergunta->id,
                ]);
            }

            $dados = [
                'pergunta' => $pergunta,
                'alternativas' => AlternativaTemporaria::where('pergunta_id', $pergunta->id)->get()->toArray(),
            ];

            return response()->json([
                'mensagem' => 'Pergunta adicionada com sucesso',
                'dados' => $dados,
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'mensagem' => 'Ocorreu algum erro durante o registo',
                'dados' => $error->getMessage(),
            ], 402);
        }
    }
}
