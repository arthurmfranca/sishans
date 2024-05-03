<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Http\Requests\PacienteRequest;
use App\Models\Paciente;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{

    // Executar o construct quando instanciar a classe
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:index-paciente', ['only' => ['index']]);
        $this->middleware('permission:show-paciente', ['only' => ['show']]);
        $this->middleware('permission:create-paciente', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-paciente', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-paciente', ['only' => ['destroy']]);
    }

    // Listar os cursos
    public function index()
    {

        // Recuperar os registros do banco dados
        $pacientes = Paciente::orderByDesc('created_at')->paginate(5);

        // Salvar log
        Log::info('Listar paciente.', ['action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('pacientes.index', ['menu' => 'pacientes', 'pacientes' => $pacientes]);
    }

    // Detalhes do curso
    public function show(Paciente $paciente)
{
    // Salvar log
    Log::info('Visualizar paciente.', ['id' => $paciente->id, 'action_user_id' => Auth::id()]);

    // Carregar a VIEW
    return view('pacientes.show', [
        'menu' => 'pacientes',
        'paciente' => $paciente,
        'municipio' => $paciente->municipio ?? null, // Adicionei o operador ?? para tratar nulo
        'hospital' => $paciente->hospital ?? null,
    ]);
}

    // Carregar o formulário cadastrar novo curso
    public function create()
    {
     // Recuperar os municípios do estado do Maranhão
     $municipios = Municipio::where('estado_id', 10)->pluck('municipio', 'id');

     // Definir a variável $userMunicipio como null (ou outro valor padrão, se aplicável)
     $userMunicipio = null;


    // Salvar log
    Log::info('Carregar formulário cadastrar paciente.', ['action_user_id' => Auth::id()]);

    // Carregar a VIEW com os estados
    return view('pacientes.create', ['menu' => 'pacientes', 'municipios' => $municipios]);
    }

    // Cadastrar no banco de dados o novo curso
    public function store(PacienteRequest $request)
    {
        //dd($request);
        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {
            // Adicione o usuário responsável pelo cadastro ao request
            $request->merge(['user_id' => Auth::id()]);

            //dd($request);

            // Cadastrar no banco de dados na tabela pacientes os valores de todos os campos
            $paciente = Paciente::create($request->all());

            // Salvar log
            Log::info('Paciente cadastrado.', ['id' => $paciente->id, $paciente, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('paciente.show', ['paciente' => $paciente->id])->with('success', 'Paciente cadastrado com sucesso!');
        } catch (Exception $e) {
            // Salvar log
            Log::warning('Paciente não cadastrado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            //return back()->withInput()->with('success', 'Paciente não cadastrado!');
            return back()->withInput()->with('error', 'Paciente não cadastrado! ' . $e->getMessage());

        }
    }

    // Carregar o formulário editar curso
    public function edit(Paciente $paciente)
    {
        $estadoId = 10; // ID do estado do Maranhão

        // Filtrar os municípios do estado do Maranhão
        $municipios = Municipio::where('estado_id', $estadoId)->pluck('municipio', 'id');

        // Recupera o município do usuário
        $userMunicipio = $paciente->municipio_id;
    
        // Se o estado do usuário for 10, obter municípios do estado correspondente ao usuário
        /*if ($userEstado == 10) {
            $municipios = Municipio::where('estado_id', 10)->pluck('municipio', 'id');
        } elseif ($userEstado) {
            $municipios = Estado::find($userEstado)->municipios->pluck('municipio', 'id');
        }*/
    
        // Recupera o Município do usuário
        $userMunicipio = $paciente->mun_res;
    
        // Salvar log
        Log::info('Carregar formulário editar paciente.', ['id' => $paciente->id, 'action_user_id' => Auth::id()]);

    
        // Carregar a VIEW com os estados e municípios
        return view('pacientes.edit', [
            'menu' => 'pacientes',
            'paciente' => $paciente,
            'municipios' => $municipios,
            //'hospitais' => $hospitais,
            'userMunicipio' => $userMunicipio,
            //'userEstado' => $userEstado,
        ]);
    }

    public function getHospitalsByMunicipio(Request $request)
    {
        try {
            $municipioId = $request->input('municipio_id');

            // Adicione um log para verificar o ID do município
            Log::info('Município ID: ' . $municipioId);

            //$hospitais = Hospital::where('municipios_id', $municipioId)->pluck('unidades', 'id');

            //return response()->json($hospitais);
        } catch (\Exception $e) {
            // Adicione um log para registrar o erro
            Log::error('Erro ao obter hospitais: ' . $e->getMessage());

            return response()->json(['error' => 'Erro ao obter hospitais.'], 500);
        }
    }
    

    // Atualizar no banco de dados as informações do paciente
    public function update(PacienteRequest $request, Paciente $paciente)
    {
         // Validar o formulário
         $request->validated();
         
        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {
            // Adicione o usuário responsável pelo cadastro ao request
            $user = Auth::user();

            // Editar as informações do registro no banco de dados
            $paciente->update([
                'nome_paciente' => $request->nome_paciente,
                'dt_nasc' => $request->dt_nasc,
                'sexo' => $request->sexo,
                'raca_cor' => $request->raca_cor,
                'idade' => $request->idade,
                'endereco' => $request->endereco,
                'cartao_sus' => $request->cartao_sus,
                'cpf' => $request->cpf,
                'telefone' => $request->telefone,
                'mun_res' => $request->mun_res,
                'updated_by' => $user->id,
            ]);

            // Salvar log
            Log::info('Paciente editado.', ['id' => $paciente->id, 'action_user_id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('paciente.show', ['paciente' => $paciente->id])->with('success', 'Paciente editado com sucesso!');
        } catch (Exception $e) {
            // Salvar log
            Log::warning('Paciente não editado.', ['error' => $e->getMessage(), 'action_user_id' => $paciente->id]);

            // Operação não concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('success', 'Paciente não editado!');
        }
    }

    // Excluir o curso do banco de dados
    public function destroy(Paciente $paciente)
    {
        try {
            // Excluir o registro do banco de dados
            $paciente->delete();

            // Salvar log
            Log::info('Apagar Paciente.', ['id' => $paciente->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('paciente.index')->with('success', 'Paciente excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Paciente não apagado.', ['erro' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('paciente.index')->with('error', 'Paciente não excluído!');
        }
    }

    /**
     * MÉTODO PESQUISAR
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = Paciente::query();

        if ($search) {
            $query->where('nome_paciente', 'like', "%$search%")
                ->orWhere('cartao_sus', 'like', "%$search%")
                ->orWhere('cpf', 'like', "%$search%");
        }

        $pacientes = $query->paginate(5);

        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * RETORNA MUNICÍPIOS POR ESTADO
     */
    public function getMunicipiosEstado($estadoId)
    {
    $municipios = Municipio::where('estado_id', $estadoId)->get();

    return response()->json($municipios);
    }
}
