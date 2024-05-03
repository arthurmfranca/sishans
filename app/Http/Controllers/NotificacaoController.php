<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificacaoRequest;
use Illuminate\Http\Request;
use App\Models\Notificacao;
use App\Models\Paciente;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificacaoController extends Controller
{

    // Executar o construct quando instanciar a classe
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:index-notificacao', ['only' => ['index']]);
        $this->middleware('permission:show-notificacao', ['only' => ['show']]);
        $this->middleware('permission:create-notificacao', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-notificacao', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-notificacao', ['only' => ['destroy']]);
    }

    public function index(Paciente $paciente)
    {
        // Obtém as notificações relacionadas ao paciente
        $notificacoes = Notificacao::where('paciente_id', $paciente->id)->orderByDesc('created_at')->paginate(5);

        // Salvar log
        Log::info('Listar notificações.', ['id' => $paciente->id, 'action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('notificacoes.index', ['menu' => 'pacientes', 'notificacoes' => $notificacoes, 'paciente' => $paciente]);
    }

    // Detalhes da notificação
    public function show(Notificacao $notificacao)
    {

        // Salvar log
        Log::info('Visualizar notificação.', ['id' => $notificacao->id, 'action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('notificacoes.show', ['menu' => 'pacientes', 'notificacao' => $notificacao]);
    }

    // Carregar o formulário cadastrar novo questionário
    public function create(Paciente $paciente)
    {
        // Salvar log
        Log::info('Carregar formulário cadastrar questionário.', ['id' => $paciente->id, 'action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('notificacoes.create', ['menu' => 'pacientes', 'paciente' => $paciente]);
    }

    // Cadastrar no banco de dados a nova Notificação
    public function store(NotificacaoRequest $request)
    {
        try {
            // Validar o formulário
            $validatedData = $request->validated();

            // dd($request);

            // Marca o ponto inicial de uma transação
            DB::beginTransaction();

            // Adicione o usuário responsável pelo cadastro ao request
            $request->merge(['user_id' => Auth::id()]);

            // Mapear os campos para garantir que são do tipo inteiro
            $intFields = ['paciente_id', 'dormencia', 'formigamento', 'area_ador', 'caimbra', 'picadas', 'manchas', 'dor_nervo', 'carocos', 'inchaco_mao_pe', 'inchaco_rosto', 'fraqueza_mao', 'fraqueza_pe', 'perda_cilios', 'historico_fam'];

            foreach ($intFields as $field) {
                $request->merge([$field => (int) $request->input($field)]);
            }

            // Cadastrar no banco de dados na tabela notificações
            $notificacao = Notificacao::create($request->all());

            // Salvar log
            Log::info('Questionário cadastrado.', ['id' => $notificacao->id, 'notificacao' => $notificacao, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('notificacao.index', ['paciente' => $request->paciente_id])->with('success', 'Questionário cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Salvar log com detalhes do erro
            Log::error('Erro ao cadastrar questionário', [
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'action_user_id' => Auth::id(),
            ]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->back()->with('error', 'Erro ao cadastrar questionário. Consulte os logs para mais informações.');
        }
    }

    // Carega View Editar Questionário
    public function edit($id)
    {
        // Recupere o paciente para edição
        $notificacao = Notificacao::find($id);

        if (!$notificacao) {
            abort(404); // Ou redirecione para uma página de erro 404, se preferir
        }

        // Renderize a view de edição e passe o notificação para a view
        return view('notificacoes.edit', compact('notificacao'));
    }


    // Editar no banco de dados a notificação
    public function update(NotificacaoRequest $request, Notificacao $notificacao){

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();
        
        try {
            // Adicione o usuário responsável pelo cadastro ao request
            $request->merge(['user_id' => Auth::id()]);

            // Adicione o paciente_id ao request
            $request->merge(['paciente_id' => $notificacao->paciente_id]);

            // Mapear os campos para garantir que são do tipo inteiro
            $intFields = ['paciente_id', 'dormencia', 'formigamento', 'area_ador', 'caimbra', 'picadas', 'manchas', 'dor_nervo', 'carocos', 'inchaco_mao_pe', 'inchaco_rosto', 'fraqueza_mao', 'fraqueza_pe', 'perda_cilios', 'historico_fam'];

            foreach ($intFields as $field) {
                $request->merge([$field => (int) $request->input($field)]);
            }
        
            // Editar as informações do registro no banco de dados usando o método update
            $notificacao->update($request->all());
            
            // dd($notificacao);   
            
            // Salvar log
            Log::info('Notificação editada.', ['id' => $notificacao->id, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();           
            
            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('notificacao.index', ['paciente' => $notificacao->paciente_id])->with('success', 'Notificação editada com sucesso!');
            // return redirect()->route('notificacao.index', ['paciente' => $notificacao->paciente_id])->with('success', $notificacao);
        
        } catch (Exception $e) {
            // Salvar log
            Log::warning('Notificação não editada', ['erro' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            // return redirect()->back()->with('error', 'Erro ao editar notificação.');
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    // Excluir a aula do banco de dados
    public function destroy(Notificacao $notificacao)
    {
        try {
            // Excluir o registro do banco de dados
            $notificacao->delete();

            // Salvar log
            Log::info('Apagar notificação.', ['id' => $notificacao->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('notificacao.index', ['paciente' => $notificacao->paciente_id])->with('success', 'Notificação apagada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Notificação não apagada.', ['erro' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('notificacao.index', ['paciente' => $notificacao->paciente_id])->with('error', 'Notificação não excluída!');
        }
    }
}
