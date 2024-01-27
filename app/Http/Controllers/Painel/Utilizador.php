<?php

namespace App\Http\Controllers\Painel;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Enquete;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class Utilizador extends Controller
{
    public function perfil($user_id)
    {
        try {
            $pagina = 'Utilizadores / Ficha';
            // VERIFICA SE O USER LOGADO PERTENCE ESTA ENQUETE
            if ($user_id != Auth::user()->id) {
                Alert::toast('Não conseguimos processar esta requisição...', 'error');
                return redirect()->back();
            }

            $utilizador = User::find($user_id);
            $notificacao_votacao = Enquete::mostrar_notificacao($user_id);

            return view('painel.utilizadores.perfil', compact('utilizador', 'pagina', 'notificacao_votacao'));
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function actualizar_senha(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'password' => 'required|string|confirmed|min:8',
                'password_confirmation' => 'required|string',
            ]);

            if ($validator->fails()) {

                Alert::toast('Verifique os campos e tenta novamente.', 'error');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }


            $id = $request->id;

            $senha_actual = $request->current_password;
            $nova_senha = $request->password;
            $password_confirmation = $request->password_confirmation;

            $utilizador = User::find($id);

            if (Hash::check($senha_actual, $utilizador->password)) {
                if ($nova_senha == $password_confirmation) {
                    User::where('id', $id)->update([
                        'password' => Hash::make($nova_senha)
                    ]);

                    Alert::toast('Senha actualizada com sucesso!', 'success');
                } else {
                    Alert::toast('Senhas não coencidem.', 'error');
                }
            } else {

                $validator->errors()->add(
                    'current_password',
                    'Current password incorrect'
                );
                Alert::toast('Verifique os campos e tenta novamente.', 'error');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            return redirect()->back();
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function actualizar_info_pessoal(Request $request)
    {
        try {
            $id = Auth::user()->id;

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:3',
                'email' => 'email|unique:users,email,'. Auth::user()->id .',id',
            ]);

            if ($validator->fails()) {

                Alert::toast('Verifique os campos e tenta novamente.', 'error');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }


            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            Alert::toast('Utilizador actualizado com sucesso!', 'success');
            return redirect()->back();
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function remover_conta(Request $request)
    {
        try {
            $id = Auth::user()->id;
            User::where('id', $id)->delete();
            return redirect()->to('sys/login');
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();

            $role = Role::where('role', 'owner')->first();

            if (!$user) {
                $novo_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'role_id' => $role->id,
                    'google_id' => $google_user->getId(),
                ]);

                Auth::login($novo_user);

                return redirect()->intended('sys/dashboard');
            }

            Auth::login($user);
            return redirect()->intended('sys/dashboard');
        } catch (Exception $error) {
            Alert::toast('Não conseguimos processar esta requisição...', 'error');
            dd($error->getMessage());
            return redirect()->back();
        }
    }
}
