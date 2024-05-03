@extends('layouts.admin')

@section('content')
<div class="container-fluid px-5">
    <div class="mt-3 mb-4 space-between-elements">
        <h2 class="ms-2 mt-3 me-3">Paciente</h2>
        <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Pacientes</a>
            </li>
            <li class="breadcrumb-item active">Paciente</li>
        </ol>
    </div>

    <x-alert />

    <form action="{{ route('paciente.update', ['paciente' => $paciente->id]) }}" method="POST" class="g-3">
        @csrf
        @method('PUT')

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span class="d-none d-sm-block d-md-block d-lg-block"><strong>Editar</strong></span>
                <span class="d-flex">

                    <a href="{{ route('paciente.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

                    @can('show-paciente')
                    <a href="{{ route('paciente.show', ['paciente' => $paciente->id]) }}" class="btn btn-primary btn-sm me-1"><i class="fa-regular fa-eye"></i> Visualizar
                    </a>
                    @endcan

                </span>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nome_paciente" class="form-label">Nome Completo do Paciente:</label>
                        <input type="text" name="nome_paciente" id="nome_paciente" class="form-control" placeholder="" value="{{ old('nome_paciente', $paciente->nome_paciente) }}">
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco', $paciente->endereco) }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="" class="form-label">Data de nascimento:</label>
                            <input type="date" class="form-control" id="dt_nasc" name="dt_nasc" maxlength="15" value="{{ old('dt_nasc', $paciente->dt_nasc) }}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label for="idade" class="form-label">Idade: </label>
                        <input type="text" name="idade" id="idade" class="form-control" placeholder="" value="{{ old('idade', $paciente->idade) }}">
                    </div>
                    
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cartao_sus" class="form-label">Cartão do SUS:</label>
                            <input type="text" class="form-control" id="cartao_sus" name="cartao_sus" value="{{ old('cartao_sus', $paciente->cartao_sus) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cpf" class="form-label">CPF:</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $paciente->cpf) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(99) 99999-9999&quot;" data-mask id="telefone" name="telefone" maxlength="15" value="{{ old('telefone', $paciente->telefone) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mun_res" class="form-label">Município:</label>
                            <select class="form-control select2" style="width: 100%;" id="mun_res" name="mun_res">
                                <option>Selecione uma opção</option>
                                @foreach ($municipios as $id => $municipio)
                                <option value="{{ $id }}" {{ old('mun_res', $userMunicipio) == $id ? 'selected' : '' }}>
                                    {{ $municipio }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-label">Sexo:</label>
                            <select class="form-control" id="sexo" name="sexo">
                                <option value="Masculino" {{ old('sexo', $paciente->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Feminino" {{ old('sexo', $paciente->sexo) == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="raca_cor" class="form-label">Raça/Cor:</label>
                            <select class="form-control" id="raca_cor" name="raca_cor">
                                <option value="Branco" {{ old('raca_cor', $paciente->raca_cor) === 'Branco' ? 'selected' : '' }}>Branco</option>
                                <option value="Negro" {{ old('raca_cor', $paciente->raca_cor) === 'Negro' ? 'selected' : '' }}>Negro</option>
                                <option value="Pardo" {{ old('raca_cor', $paciente->raca_cor) === 'Pardo' ? 'selected' : '' }}>Pardo</option>
                                <option value="Amarelo" {{ old('raca_cor', $paciente->raca_cor) === 'Amarelo' ? 'selected' : '' }}>Amarelo</option>
                                <option value="Indígena" {{ old('raca_cor', $paciente->raca_cor) === 'Indígena' ? 'selected' : '' }}>Indígena</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Inicialize o Inputmask para CPF
    Inputmask("999.999.999-99").mask("#cpf");

    // Inicialize o Inputmask para telefone
    Inputmask("(99) 99999-9999").mask("#tel");

    // Inicialize o Inputmask para Data de Nascimento
    Inputmask("99/99/9999", {
        placeholder: "dd/mm/aaaa"
    }).mask("#data_nasc");
</script>


<script>
    $(document).ready(function() {
        // Adicione um evento de alteração ao campo de município
        $('#mun_res').on('change', function() {
            var municipioId = $(this).val();

            // Selecione o campo de und_saude_id
            var undSaudeSelect = $('#und_saude_id');

            // Limpe as opções atuais
            undSaudeSelect.empty();

            // Adicione uma opção padrão
            undSaudeSelect.append('<option>Selecione uma opção</option>');

            // Se o município não for selecionado, pare aqui
            if (!municipioId) {
                return;
            }

            // Faça uma solicitação AJAX para obter hospitais com base no município selecionado
            $.ajax({
                url: '/get-hospitals-by-municipio',
                method: 'GET',
                data: {
                    mun_res: municipioId
                },
                success: function(data) {
                    // Adicione dinamicamente as opções do hospital com base na resposta AJAX
                    $.each(data, function(id, hospital) {
                        undSaudeSelect.append('<option value="' + id + '">' + hospital + '</option>');
                    });
                }
            });
        });
    });
</script>
@endsection