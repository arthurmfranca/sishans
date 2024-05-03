<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class LoginController extends Controller
{
    // Login
    public function index()
    {
        // Carregar a VIEW
        return view('login.index');
    }

    // Validar os dados do usuário no login
    public function loginProcess(LoginRequest $request){
        
    // Validar o formulário
    $request->validated();

    // Validar o usuário e a senha com as informações do banco de dados
    $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

    // Verificar se o usuário foi autenticado
    if (!$authenticated) {
        // Salvar log
        Log::warning('E-mail ou senha inválido.', ['email' => $request->email]);

        // Redirecionar o usuário para página anterior "login", enviar a mensagem de erro
        return back()->withInput()->with('error', 'E-mail ou senha inválido!');
    }

    // Obter o usuário autenticado
    $user = Auth::user();

    // Verificar o status do usuário (Ativo ou Inativo)
    if ($user->status === 'Inativo') {
        // Se o usuário estiver inativo, fazer logout e redirecionar com mensagem de erro
        Auth::logout();
        return back()->withInput()->with('error', 'Usuário inativo. Entre em contato com o administrador.');
    }

    // Verificar se a permissão é Super Admin, tem acesso a todas as páginas
    if ($user->hasRole('Super Admin')) {
        // O usuário tem todas as permissões
        $permissions = Permission::pluck('name')->toArray();
    } else {
        // Recuperar no banco de dados as permissões que o papel possui
        $permissions = $user->getPermissionsViaRoles()->pluck('name')->toArray();
    }

    // Atribuir as permissões ao usuário
    $user->syncPermissions($permissions);

    // Salvar log
    Log::info('Login realizado', ['email' => $request->email, 'action_user_id' => Auth::id()]);

    // Redirecionar o usuário
    return redirect()->route('paciente.index');
    }
    
    // Deslogar o usuário
    public function destroy(){

        // Salvar log
        Log::warning('Logout', ['action_user_id' => Auth::id()]);

        // Deslogar o usuário
        Auth::logout();

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');
    }
}
