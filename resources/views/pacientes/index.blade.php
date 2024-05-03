@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Pacientes</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Pacientes</li>
            </ol>
        </div>

        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <form action="{{ route('paciente.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control shadow"
                            placeholder="Pesquisar por Nome, Cartão SUS ou CPF" name="search" required>
                        <button type="submit" class="btn btn-success shadow"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span><strong>Listar</strong></span>
                <span>
                    @can('create-paciente')
                        <a href="{{ route('paciente.create') }}" class="btn btn-success btn-sm"><i
                                class="fa-regular fa-square-plus"></i> Cadastrar</a>
                    @endcan
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th class="">CPF</th>
                                <th class="">Cartão SUS</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente->nome_paciente }}</td>
                                    <td>{{ $paciente->cpf }}</td>
                                    <td>{{ $paciente->cartao_sus }}</td>
                                    <td class="d-md-flex justify-content-center">

                                        @can('index-notificacao')
                                            <a href="{{ route('notificacao.index', ['paciente' => $paciente->id]) }}"
                                                class="btn btn-info btn-sm me-1 mb-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Questionários">
                                                <i class="fa-solid fa-bullhorn"></i>
                                            </a>
                                        @endcan

                                        @can('show-paciente')
                                            <a href="{{ route('paciente.show', ['paciente' => $paciente->id]) }}"
                                                class="btn btn-primary btn-sm me-1 mb-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Visualizar">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        @endcan

                                        @can('edit-paciente')
                                            <a href="{{ route('paciente.edit', ['paciente' => $paciente->id]) }}"
                                                class="btn btn-warning btn-sm me-1 mb-1" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Editar">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endcan

                                        @can('destroy-paciente')
                                            <form method="POST"
                                                action="{{ route('paciente.destroy', ['paciente' => $paciente->id]) }}">
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
                                <div class="alert alert-danger" role="alert">Nenhum paciente encontrado!</div>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{ $pacientes->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection
