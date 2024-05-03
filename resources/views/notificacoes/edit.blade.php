@extends('layouts.admin')

@section('content')
<div class="container-fluid px-5">
    <div class="mb-1 space-between-elements">
        <h2 class="ms-2 mt-3 me-3">Questionário</h2>
        <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Paciente</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('notificacao.index', ['paciente' => $notificacao->paciente_id]) }}">Notificacao</a>
            </li>
            <li class="breadcrumb-item active">Notificacao</li>
        </ol>
    </div>

    <div class="card mb-4 border-light shadow">
        <div class="card-header space-between-elements">
            <span>Editar</span>
            <span class="d-flex">

                @can('index-notificacao')
                <a href="{{ route('notificacao.index', ['paciente' => $notificacao->paciente_id]) }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i> Listar</a>
                @endcan

            </span>
        </div>
        <div class="card-body">

            <x-alert />

            <form id="notificacaoForm" action="{{ route('notificacao.update', ['notificacao' => $notificacao->id]) }}" method="POST" class="g-3">
                @csrf
                @method('PUT')

                <div class="card card-default">
                    <div class="card-header space-between-elements">
                        <span><strong>Dados do Entrevistador</strong></span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="nome_profissional" class="form-label">Nome Completo do Profissonal:</label>
                                    <input type="text" class="form-control" id="nome_profissional" name="nome_profissional" value="{{ old('nome_profissional', $notificacao->nome_profissional) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="categoria" class="form-label">Categoria:</label>
                                    <input type="text" class="form-control" id="categoria" name="categoria" value="{{ old('categoria', $notificacao->categoria) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="cbo" class="form-label">CBO:</label>
                                    <input type="text" class="form-control" id="cbo" name="cbo" value="{{ old('cbo', $notificacao->cbo) }}">
                                </div>
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
                                        <input class="list-group-item-check pe-none" type="checkbox" name="dormencia" id="listGroupCheckableCheckbox1" value="{{ old('dormencia', $notificacao->dormencia)  }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox1">
                                            1.Sente dormência nas mãos ou nos pés?
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="formigamento" id="listGroupCheckableCheckbox2" value="{{ old('formigamento', $notificacao->formigamento) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox2">
                                            2.Formigamentos?
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="area_ador" id="listGroupCheckableCheckbox3" value="{{ old('area_ador', $notificacao->area_ador) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox3">
                                            3.Áreas adormecidas na pele?
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="caimbra" id="listGroupCheckableCheckbox4" value="{{ old('caimbra', $notificacao->caimbra) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox4">
                                            4.Cãimbras?
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="picadas" id="listGroupCheckableCheckbox5" value="{{ old('picadas', $notificacao->picadas) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox5">
                                            5.Sensação de picadas/agulhadas?
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="manchas" id="listGroupCheckableCheckbox6" value="{{ old('manchas', $notificacao->manchas) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox6">
                                            6.Manchas na pele?
                                            <span class="d-block small opacity-50">Obs: Não considerar as de nascença</span>
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="dor_nervo" id="listGroupCheckableCheckbox7" value="{{ old('dor_nervo', $notificacao->dor_nervo) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox7">
                                            7.Dor nos nervos?
                                        </label>
                           
                                        <input class="list-group-item-check pe-none" type="checkbox" name="carocos" id="listGroupCheckableCheckbox8" value="{{ old('carocos', $notificacao->carocos) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox8">
                                            8.Caroços no corpo?
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="inchaco_mao_pe" id="listGroupCheckableCheckbox9" value="{{ old('inchaco_mao_pe', $notificacao->inchaco_mao_pe) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox9">
                                            9.Inchaço nas mãos e nos pés?
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="inchaco_rosto" id="listGroupCheckableCheckbox10" name="inchaco_rosto" value="{{ old('inchaco_rosto', $notificacao->inchaco_rosto) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox10">
                                            10.Inchaço no rosto?
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="fraqueza_pe" id="listGroupCheckableCheckbox11" value="{{ old('fraqueza_pe', $notificacao->fraqueza_pe) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox11">
                                            11.Fraqueza nos pés?
                                            <span class="d-block small opacity-50">Dificuldade de calçar e/ou manter chinelos?</span>
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="fraqueza_mao" id="listGroupCheckableCheckbox12" value="{{ old('fraqueza_mao', $notificacao->fraqueza_mao) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox12">
                                            12.Fraqueza nas mãos?
                                            <span class="d-block small opacity-50">Dificuldade de abotoar a camisa? Por os óculos? De escrever? Segurar Panelas?</span>
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="perda_cilios" id="listGroupCheckableCheckbox13" value="{{ old('perda_cilios', $notificacao->perda_cilios) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox13">
                                            13.Perda dos cílios e/ou sobrancelhas?
                                        </label>

                                        <input class="list-group-item-check pe-none" type="checkbox" name="historico_fam" id="listGroupCheckableCheckbox14" value="{{ old('$historico_fam', $notificacao->historico_fam) }}">
                                        <label class="list-group-item rounded-3 py-3" for="listGroupCheckableCheckbox14">
                                            14.Há história de hanseníase na família?
                                        </label>
                                    </div>
                                </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status:</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Não Examinado" {{ old('status', $notificacao->status) == 'Não Examinado' ? 'selected' : '' }}>Não Examinado</option>
                                        <option value="Examinado" {{ old('status', $notificacao->status) == 'Examinado' ? 'selected' : '' }}>Examinado</option>
                                        <option value="Diagnosticado" {{ old('status', $notificacao->status) == 'Diagnosticado' ? 'selected' : '' }}>Diagnosticado</option>
                                        <option value="Descartado" {{ old('status', $notificacao->status) == 'Descartado' ? 'selected' : '' }}>Descartado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tipo_local" class="form-label">Tipo de local de Atendimento?</label>
                                        <select class="form-control" id="tipo_local" name="tipo_local" required>
                                            <option value="Unidade de Saúde" {{ old('tipo_local', $notificacao->tipo_local) == 'Unidade de Saúde' ? 'selected' : '' }}>Unidade de Saúde</option>
                                            <option value="Unidade Prisional" {{ old('tipo_local', $notificacao->tipo_local) == 'Unidade Prisional' ? 'selected' : '' }}>Unidade Prisional</option>
                                            <option value="Campanha/Multirão" {{ old('tipo_local', $notificacao->tipo_local) == 'Campanha/Multirão' ? 'selected' : '' }}>Campanha/Multirão</option>
                                            <option value="Outros" {{ old('tipo_local', $notificacao->tipo_local) == 'Outros' ? 'selected' : '' }}>Outros</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="local_atendimento" class="form-label">Local de Atendimento?</label>
                                    <input type="text" class="form-control" id="local_atendimento" name="local_atendimento" value="{{ old('local_atendimento', $notificacao->local_atendimento) }}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-md-end justify-content-end">
                        <button type="submit" class="btn btn-success bt-sm">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        var checkboxes = document.querySelectorAll('.list-group-item-check');

        checkboxes.forEach(function(checkbox) {
            // Converta o valor para string antes de comparar
            if (checkbox.value.toString() === '1') {
                checkbox.checked = true;
                checkbox.classList.add('checked');
            }

            checkbox.addEventListener('change', function() {
                checkbox.classList.toggle('checked', checkbox.checked);
            });

            // Adicione a classe 'checked' se o checkbox estiver marcado inicialmente
            checkbox.classList.toggle('checked', checkbox.checked);
        });
    });
</script>

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
</script> -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var checkboxes = document.querySelectorAll('.list-group-item-check');

        checkboxes.forEach(function(checkbox) {
            // Converta o valor para string antes de comparar
            if (checkbox.value.toString() === '1') {
                checkbox.checked = true;
                checkbox.classList.add('checked');
            }

            checkbox.addEventListener('change', function() {
                atualizarValoresCheckbox();
            });

            // Adicione a classe 'checked' se o checkbox estiver marcado inicialmente
            checkbox.classList.toggle('checked', checkbox.checked);
        });
    });

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