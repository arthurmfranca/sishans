@extends('layouts.admin')

@section('content')
<div class="container-fluid px-5">
    <div class="mt-3 mb-4 space-between-elements">
        <h2 class="ms-2 mt-3 me-3">Notificação</h2>
        <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Pacientes</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('notificacao.index', ['paciente' => $paciente->id]) }}">Notificações</a>
            </li>
            <li class="breadcrumb-item active">Cadastrar</li>
        </ol>
    </div>

    <x-alert />

    <form id="notificacaoForm" action="{{ route('notificacao.store') }}" method="POST" class="g-3" onsubmit="return atualizarValoresCheckbox()">
        @csrf
        @method('POST')

        <input type="hidden" name="paciente_id" id="paciente_id" value="{{ $paciente->id }}">

        <div class="card card-default">
            <div class="card-header space-between-elements">
                <span><strong>Dados do Profissional de Saúde</strong></span>
                <span class="d-flex">
                    @can('index-paciente')
                    <a href="{{ route('notificacao.index', ['paciente' => $paciente->id]) }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i> Listar</a>
                    @endcan
                </span>
            </div>

            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Cham:wght@554&display=swap" rel="stylesheet">

            <div class="card-body">
                <div class="row mb-3">
                    <div class="form-group">
                        <label class="form-label" for="nome_profissional" class="form-label">Nome Completo do Profissonal:</label>
                        <input type="text" class="form-control" id="nome_profissional" name="nome_profissional" value="{{ old('nome_profissional') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="categoria" class="form-label">Categoria:</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" value="{{ old('categoria') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="cbo" class="form-label">CBO:</label>
                        <input type="text" class="form-control" id="cbo" name="cbo" value="{{ old('cbo') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-default mt-4">
            <div class="card-header space-between-elements">
                <span><strong>Questionário</strong></span>
            </div>

            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="list-group list-group-checkable gap-2 border-0 ">
                        <input class="list-group-item-check pe-none custom-checkbox" type="checkbox" name="dormencia" id="listGroupCheckableCheckbox1" value="0">
                        <label class="list-group-item rounded-3 py-3 px-4" for="listGroupCheckableCheckbox1">
                            1. Sente dormência nas mãos ou nos pés?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="formigamento" id="listGroupCheckableCheckbox2" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox2">
                            2. Formigamentos?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="area_ador" id="listGroupCheckableCheckbox3" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox3">
                            3. Áreas adormecidas na pele?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="caimbra" id="listGroupCheckableCheckbox4" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox4">
                            4. Cãimbras?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="picadas" id="listGroupCheckableCheckbox5" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox5">
                            5. Sensação de picadas/agulhadas?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="manchas" id="listGroupCheckableCheckbox6" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox6">
                            6. Manchas na pele?
                            <span class="d-block small opacity-50">Obs: Não considerar as de nascença</span>
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="dor_nervo" id="listGroupCheckableCheckbox7" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox7">
                            7. Dor nos nervos?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="carocos" id="listGroupCheckableCheckbox8" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox8">
                            8. Caroços no corpo?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="inchaco_mao_pe" id="listGroupCheckableCheckbox9" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox9">
                            9. Inchaço nas mãos e nos pés?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="inchaco_rosto" id="listGroupCheckableCheckbox10" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox10">
                            10. Inchaço no rosto?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="fraqueza_mao" id="listGroupCheckableCheckbox12" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox12">
                            11. Fraqueza nas mãos?
                            <span class="d-block small opacity-50">Dificuldade de abotoar a camisa? Por os óculos? De escrever? Segurar Panelas?</span>
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="fraqueza_pe" id="listGroupCheckableCheckbox11" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox11">
                            12. Fraqueza nos pés?
                            <span class="d-block small opacity-50">Dificuldade de calçar e/ou manter chinelos?</span>
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="perda_cilios" id="listGroupCheckableCheckbox13" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox13">
                            13. Perda dos cílios e/ou sobrancelhas?
                        </label>

                        <input class="list-group-item-check pe-none" type="checkbox" name="historico_fam" id="listGroupCheckableCheckbox14" value="0">
                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox14">
                            14. Há história de hanseníase na família?
                        </label>
                    </div>
                </div>



                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="form-label">Status:</label>
                            <select class="form-control" id="status" name="status">
                                <option>Selecione uma opção</option>
                                <option value="Não Examinado">Não Examinado</option>
                                <option value="Examinado">Examinado</option>
                                <option value="Diagnosticado">Diagnosticado</option>
                                <option value="Descartado">Descartado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="tipo_local" class="form-label">Tipo de local de atendimento?</label>
                            <select class="form-control" id="tipo_local" name="tipo_local">
                                <option>Selecione uma opção</option>
                                <option value="Unidade de Saúde">Unidade de Saúde</option>
                                <option value="Unidade Prisional">Unidade Prisional</option>
                                <option value="Campanha/Multirão">Campanha/Multirão</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label class="form-label" for="local_atendimento" class="form-label">Local de Atendimento?</label>
                            <input type="text" class="form-control" id="local_atendimento" name="local_atendimento">
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer d-flex justify-content-md-end">
                <button type="submit" class="btn btn-success bt-sm">Cadastrar</button>
            </div>
        </div>
    </form>
</div>

<script>
    function atualizarValoresCheckbox() {
        // Percorre todos os checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            // Adiciona um campo oculto para cada checkbox
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = checkbox.name;
            hiddenInput.value = checkbox.checked ? 1 : 0;

            // Remove o campo oculto anterior, se existir
            var existingHiddenInput = document.querySelector('input[type="hidden"][name="' + checkbox.name + '"]');
            if (existingHiddenInput) {
                existingHiddenInput.remove();
            }

            // Adiciona o campo oculto ao formulário
            document.getElementById('notificacaoForm').appendChild(hiddenInput);
        });

        // Retorna true para permitir o envio do formulário
        return true;
    }
</script>



@endsection