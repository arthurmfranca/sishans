@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="mt-4 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Questionário - {{ $notificacao->paciente->nome_paciente }}</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Pacientes</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none"
                        href="{{ route('notificacao.index', ['paciente' => $notificacao->paciente_id]) }}">Questionários</a>
                </li>
                <li class="breadcrumb-item active">Questionário</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements bg-secondary">
                <span class="d-none d-sm-block d-md-block d-lg-block text-white"><strong>Visualizar</strong></span>
                <span class="d-flex">

                    @can('index-notificacao')
                        <a href="{{ route('notificacao.index', ['paciente' => $notificacao->paciente_id]) }}"
                            class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i> Listar</a>
                    @endcan

                    @can('edit-notificacao')
                        <a href="{{ route('notificacao.edit', ['notificacao' => $notificacao->id]) }}"
                            class="btn btn-warning btn-sm me-1"><i class="fa-solid fa-pen-to-square"></i>Editar
                        </a>
                    @endcan

                    @can('destroy-notificacao')
                        <form method="POST" action="{{ route('notificacao.destroy', ['notificacao' => $notificacao->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm me-1"
                                onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                        </form>
                    @endcan

                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <div class="table-responsive">
                <table class="table table-responsive table-sm align-middle mb-5 mt-3">

                    <thead>
                        <tr class="table-secondary">
                            <th>Entrevistador</th>
                            <th>Local de Atendimento</th>
                            <th>Status</th>
                            <th>Cadastrado por</th>
                            <th>Cadastrado em</th>
                            <th>Editado por</th>
                            <th>Editado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $notificacao->nome_profissional }}</td>
                            <td>{{ $notificacao->local_atendimento }}</td>
                            <td>{{ $notificacao->status }}</td>
                            <td>{{ optional($notificacao->createdBy)->name . ' ' . optional($notificacao->createdBy)->lastname ?? 'Não disponível' }}</td>
                            <td> {{ \Carbon\Carbon::parse($notificacao->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                            <td>{{ optional($notificacao->updatedBy)->name . ' ' . optional($notificacao->updatedBy)->lastname ?? 'Não disponível' }}</td>
                            <td> {{ \Carbon\Carbon::parse($notificacao->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <div class="table-responsive">
                <table class="table table-responsive table-sm table-striped table-hover">
                    <thead>
                        <tr class="table-secondary">
                            <th>Perguntas</th>
                            <th>Respostas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sente dormência nas mãos ou nos pés?</td>
                            <td>{{ $notificacao->dormencia == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Formigamentos?</td>
                            <td>{{ $notificacao->formigamento == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Áreas adormecidas na pele?</td>
                            <td>{{ $notificacao->area_ador == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Cãimbras?</td>
                            <td>{{ $notificacao->caimbra == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Sensação de picadas/agulhadas?</td>
                            <td>{{ $notificacao->picadas == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Manchas na pele? Obs: Não considerar as de nascença</td>
                            <td>{{ $notificacao->manchas == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>


                        <tr>
                            <td>Dor nos nervos?</td>
                            <td>{{ $notificacao->dor_nervo == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Caroços no corpo?</td>
                            <td>{{ $notificacao->carocos == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Inchaço nas mãos e nos pés?</td>
                            <td>{{ $notificacao->inchaco_mao_pe == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Inchaço no rosto?</td>
                            <td>{{ $notificacao->inchaco_rosto == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Fraqueza nos pés? (Dificuldade de calçar e/ou manter chinelos?)</td>
                            <td>{{ $notificacao->fraqueza_pe == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Fraqueza nas mãos? (Dificuldade de abotoar a camisa? Por os óculos? De escrever? Segurar
                                Panelas?)</td>
                            <td>{{ $notificacao->fraqueza_mao == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Perda dos cílios e/ou sobrancelhas?</td>
                            <td>{{ $notificacao->perda_cilios == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>

                        <tr>
                            <td>Há história de hanseníase na família?</td>
                            <td>{{ $notificacao->historico_fam == 1 ? 'Sim' : 'Não' }}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
