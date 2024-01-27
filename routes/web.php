<?php

use App\Events\MessageCreated;
use App\Events\VotoRegistado;
use App\Mail\PartilhaURLEnquete;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Painel\Home;
use App\Http\Controllers\Painel\Site;
use Illuminate\Support\Facades\Route;
use App\Models\Enquete as Questionario;
use App\Http\Controllers\Painel\Enquete;
use App\Models\Enquete as ModelsEnquete;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\Painel\Utilizador;
use App\Http\Controllers\Painel\Estatistica;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('site.')->group(function () {
    Route::get('/enquetes/{id}', [Site::class, 'visualizar'])->name('enquetes.perguntas.visualizacao');
    Route::post('/enquetes/perguntas/alternativas/escolha-unica/votacao', [Site::class, 'votar'])->name('enquetes.perguntas.votacao');
    Route::post('/enquetes/perguntas/alternativas/escolha-multipla/votacao', [Site::class, 'votar_escolha_multipla']);
});


Route::get('/', function () {
    return to_route('sys.dashboard');
});

Route::get('auth/google', [Utilizador::class, 'redirect'])->name('google.auth');
Route::get('sys/auth/google/call-back', [Utilizador::class, 'callbackGoogle']);

Route::middleware(['auth'])->prefix('sys')->name('sys.')->group(function () {
    Route::get('dashboard', [Home::class, 'home'])->middleware('auth')->name('dashboard');

    Route::get('utilizadores/{id}/perfil', [Utilizador::class, 'perfil'])->middleware('auth')->name('utilizadores.perfil');
    Route::post('utilizadores/remocao', [Utilizador::class, 'remover_conta'])->middleware('auth')->name('utilizadores.remocao.conta');
    Route::post('utilizadores/senha/actualizacao', [Utilizador::class, 'actualizar_senha'])->middleware('auth')->name('utilizadores.actualizacao.senha');
    Route::post('utilizadores/info-pessoal/actualizacao', [Utilizador::class, 'actualizar_info_pessoal'])->middleware('auth')->name('utilizadores.actualizacao.info.pessoal');
    Route::get('enquetes/{id}/visualizacao', [Enquete::class, 'visualizar_enquete'])->name('enquete.visualizacao');
    Route::get('enquetes/{enquete}/notificacao/{alternativa}/leitura', [Enquete::class, 'ler_notificacao'])->name('enquete.notificacao.leitura');
    Route::post('enquetes/registo', [Enquete::class, 'registar_enquete'])->name('enquete.registo');
    Route::post('enquetes/remocao', [Enquete::class, 'remover_enquete'])->name('enquete.remocao');
    Route::post('enquetes/perguntas/remocao', [Enquete::class, 'remover_pergunta'])->name('enquete.pergunta.remocao');
    Route::post('enquetes/perguntas/alternativas/remocao', [Enquete::class, 'remover_alternativa'])->name('enquete.pergunta.alternativa.remocao');
    Route::post('enquetes/perguntas/actualizacao-de-cabecalho', [Enquete::class, 'actualizar_enquete_cabecalho']);
    Route::post('enquetes/perguntas/actualizacao-de-alternativa', [Enquete::class, 'actualizar_enquete_alternativa']);
    Route::post('enquetes/perguntas/actualizacao-de-anexo', [Enquete::class, 'actualizar_enquete_anexo']);
    Route::post('enquetes/perguntas/anexo', [Enquete::class, 'adicionar_pergunta']);
    Route::post('enquetes/partilha-por-email', [Enquete::class, 'partilhar_por_email']);

    Route::get('estatisticas/enquetes/perguntas', [Estatistica::class, 'pergunta']);
    Route::post('perguntas/alternativas/popula', [Estatistica::class, 'popular_alternativas_perguntas']);
});
