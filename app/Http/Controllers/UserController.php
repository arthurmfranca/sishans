<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Municipio;
use App\Models\Hospital;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    // Executar o construct quando instanciar a classe
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:index-user', ['only' => ['index']]);
        $this->middleware('permission:show-user', ['only' => ['show']]);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:edit-user-password', ['only' => ['editPassword', 'updatePassword']]);
        $this->middleware('permission:destroy-user', ['only' => ['destroy']]);
    }

    // Listar os usuários
    public function index()
    {

        // Recuperar os registros do banco dados
        $users = User::orderByDesc('created_at')->paginate(5);

        // Salvar log
        Log::info('Listar usuários.', ['action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('users.index', ['menu' => 'users', 'users' => $users]);
    }

    // Detalhes do usuario
    public function show(User $user)
    {
        // Carregar o relacionamento 'municipio'
        //$user->load('municipio');

        // Salvar log
        Log::info('Visualizar usuário.', ['action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('users.show', ['menu' => 'users', 'user' => $user]);
    }

    /**
     * Carregar o formulário cadastrar novo usuário
     */
    public function create()
    {
        try {
            // Recuperar os papéis
            $roles = Role::pluck('name')->all();

            // Recuperar os municípios do estado do Maranhão
            $municipios = Municipio::where('estado_id', 10)->pluck('municipio', 'id');

            // Definir a variável $userMunicipio como null (ou outro valor padrão, se aplicável)
            $userMunicipio = null;

            // Salvar log
            Log::info('Carregar formulário cadastrar usuário.', ['action_user_id' => Auth::id()]);

            // Carregar a VIEW
            return view('users.create', [
                'menu' => 'users',
                'roles' => $roles,
                'municipios' => $municipios,
                'hospitais' => [], // Inicialize com um array vazio, pois você preencherá dinamicamente com AJAX
                'userMunicipio' => $userMunicipio, // Passar a variável para a view
            ]);
        } catch (\Exception $e) {
            // Trate a exceção conforme necessário
            Log::error('Erro ao carregar formulário cadastrar usuário.', ['action_user_id' => Auth::id(), 'error' => $e->getMessage()]);
            abort(500, 'Erro interno do servidor');
        }
    }
    /**
     * MÉTODO PARA CADASTRAR O USUÁRIO NA TABELA USERS
     */
    public function store(UserRequest $request){

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {
            // Adicione o usuário responsável pelo cadastro ao request
            $request->merge(['created_by' => Auth::id()]);

             // Gerar senha padrão
            $password = Str::random(8);

            // Adicionar a senha ao request
            $request->merge(['password' => $password]);


            // Crie o usuário
            $user = User::create($request->all());

            // Atribuir papel para o usuário
            $user->assignRole($request->roles);

            // Salvar log com informações adicionais, se necessário
            Log::info('Usuário cadastrado.', [
                'id' => $user->id,
                'action_user_id' => Auth::id(),
                // Adicione mais informações, se necessário
            ]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
        } catch (Exception $e) {
            // Salvar log com informações adicionais, se necessário
            Log::warning('Usuário não cadastrado.', [
                'error' => $e->getMessage(),
                'action_user_id' => Auth::id(),
                // Adicione mais informações, se necessário
            ]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }

    /**
     * MÉTODO CARREGA A VIEW EDIT
     */
    // Carregar o formulário editar usuário
    public function edit(User $user)
    {
        $estadoId = 10; // ID do estado do Maranhão

        // Filtrar os municípios do estado do Maranhão
        $municipios = Municipio::where('estado_id', $estadoId)->pluck('municipio', 'id');

        // Recupera o município do usuário
        $userMunicipio = $user->municipio_id;

        // Inicializar hospitais como array vazio
        $hospitais = [];

        // Verificar se o usuário tem um município antes de buscar os hospitais
        /*if ($user->municipio_id) {
            // Recuperar as unidades de saúde relacionadas ao município do usuário
            $hospitais = Hospital::where('municipios_id', $user->municipio_id)->pluck('unidades', 'id');
        }

        // Recupera a unidade de saúde do usuário
        $userHospital = $user->und_saude_id;*/

        // Recupera o status do usuário
        $userStatus = $user->status;

        // Recuperar os papéis
        $roles = Role::pluck('name')->all();

        // Recuperar o papel do usuário
        $userRoles = $user->roles->pluck('name')->first();

        // Salvar log
        Log::info('Carregar formulário editar usuário.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('users.edit', [
            'menu' => 'users',
            'user' => $user,
            'municipios' => $municipios,
            'userMunicipio' => $userMunicipio,
            'hospitais' => $hospitais,
            //'userHospital' => $userHospital,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Lida com a solicitação AJAX para obter hospitais
     */

    public function getHospitalsByMunicipio(Request $request)
    {
        try {
            $municipioId = $request->input('municipio_id');

            // Adicione um log para verificar o ID do município
            Log::info('Município ID: ' . $municipioId);

            $hospitais = Hospital::where('municipios_id', $municipioId)->pluck('unidades', 'id');

            return response()->json($hospitais);
        } catch (\Exception $e) {
            // Adicione um log para registrar o erro
            Log::error('Erro ao obter hospitais: ' . $e->getMessage());

            return response()->json(['error' => 'Erro ao obter hospitais.'], 500);
        }
    }

    // Editar no banco de dados o usuário
    public function update(UserRequest $request, User $user)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Adicione o usuário responsável pelo cadastro ao request
            $request->merge(['updated_by' => Auth::id()]);

            // Editar as informações do registro no banco de dados
            $user->update([
                'name' => $request->name,
                'lastname' => $request->input('lastname'),
                'municipio_id' => $request->input('municipio_id'),
                'und_saude_id' => $request->input('und_saude_id'),
                'email' => $request->email,
                'status' => $request->input('status'),
                'updated_by' => $request->input('updated_by'),
            ]);

            // Editar o papel do usuário
            $user->syncRoles($request->roles);

            // Salvar log
            Log::info('Usuário editado.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Usuário editado com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Usuário não editado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não editado!');
        }
    }

    // Carregar o formulário editar senha do usuário
    public function editPassword(User $user)
    {

        // Salvar log
        Log::info('Carregar formulário editar senha do usuário.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('users.editPassword', ['menu' => 'users', 'user' => $user]);
    }

    // Editar no banco de dados a senha do usuário
    public function updatePassword(Request $request, User $user)
    {

        // Validar o formulário
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $user->update([
                'password' => $request->password,
            ]);

            // Salvar log
            Log::info('Senha do usuário editada.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Senha do usuário editada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Senha do usuário não editada.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Senha do usuário não editada!');
        }
    }

    // Excluir o usuário do banco de dados
    public function destroy(User $user)
    {
        try {
            // Excluir o registro do banco de dados
            $user->delete();

            // Remove todos os papéis atribuídos ao usuário
            $user->syncRoles([]);

            // Salvar log
            Log::info('Usuário excluído.', ['id' => $user->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Usuário não excluído.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('course.index')->with('error', 'Usuário não excluído!');
        }
    }

    /**
     * MÉTODO PESQUISAR
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = User::query();

        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orwhere('lastname', 'like', "%$search%");
            //->orWhere('email', 'like', "%$search%");
            //->orWhere('cpf', 'like', "%$search%");
        }

        $users = $query->paginate(5);

        return view('users.index', compact('users'));
    }
}
