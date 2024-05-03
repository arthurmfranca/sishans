@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Questionário</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none"
                        href="{{ route('paciente.index') }}">Questionários</a>
                </li>
                <li class="breadcrumb-item active">Questionário</li>
            </ol>
        </div>
        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span><strong>Listar</strong></span>
                <span>

                    @can('index-paciente')
                        <a href="{{ route('paciente.index') }}" class="btn btn-info btn-sm me-1"><i
                                class="fa-solid fa-list"></i>
                            Listar</a>
                    @endcan

                    @can('create-notificacao')
                        <a href="{{ route('notificacao.create', ['paciente' => $paciente->id]) }}"
                            class="btn btn-success btn-sm">
                            <i class="fa-regular fa-square-plus"></i> Cadastrar
                        </a>
                    @endcan

                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Entrevistador</th>
                                <th>Local de Atendimento</th>
                                <th>Status</th>
                                <th>Cadastrado por</th>
                                <th>Cadastrado em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($notificacoes as $notificacao)
                                <tr>
                                    <td>{{ $notificacao->nome_profissional }}</td>
                                    <td>{{ $notificacao->local_atendimento }}</td>
                                    <td>{{ $notificacao->status }}</td>
                                    <td>{{ optional($notificacao->createdBy)->name . ' ' . optional($notificacao->createdBy)->lastname ?? 'Não disponível' }}
                                    </td>
                                    <td> {{ \Carbon\Carbon::parse($notificacao->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td class="d-md-flex justify-content-center">

                                        @can('show-notificacao')
                                            <a href="{{ route('notificacao.show', ['notificacao' => $notificacao->id]) }}"
                                                class="btn btn-primary btn-sm me-1 mb-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Visualizar">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        @endcan

                                        @can('edit-notificacao')
                                            <a href="{{ route('notificacao.edit', ['notificacao' => $notificacao->id]) }}"
                                                class="btn btn-warning btn-sm me-1 mb-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Editar">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endcan

                                        @can('destroy-notificacao')
                                            <form method="POST"
                                                action="{{ route('notificacao.destroy', ['notificacao' => $notificacao->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm me-1 mb-1"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Deletar"
                                                    onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                                        class="fa-regular fa-trash-can"></i></button>
                                            </form>
                                        @endcan

                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger" role="alert">Nenhuma notificação encontrada!</div>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            {{ $notificacoes->onEachSide(0)->links() }}
        </div>
    </div>
@endsection
