@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Paciente</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Pacientes</a></li>
                <li class="breadcrumb-item active">Paciente</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span class="d-none d-sm-block d-md-block d-lg-block"><strong>Visualizar</strong></span>
                <span class="d-flex">

                    @can('index-notificacao')
                        <a href="{{ route('notificacao.index', ['paciente' => $paciente->id]) }}" class="btn btn-info btn-sm me-1">
                            <i class="fa-solid fa-bullhorn"></i> Notificações</a>
                    @endcan

                    @can('index-paciente')
                        <a href="{{ route('paciente.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                            Listar</a>
                    @endcan

                    @can('edit-paciente')
                        <a href="{{ route('paciente.edit', ['paciente' => $paciente->id]) }}" class="btn btn-warning btn-sm me-1"><i
                                class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                    @endcan

                    @can('destroy-paciente')
                        <form method="POST" action="{{ route('paciente.destroy', ['paciente' => $paciente->id]) }}">
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

                <dl class="row">

                    <dt class="col-sm-3">ID: </dt>
                    <dd class="col-sm-9">{{ $paciente->id }}</dd>

                    <dt class="col-sm-3">Nome: </dt>
                    <dd class="col-sm-9">{{ $paciente->nome_paciente }}</dd>

                    <dt class="col-sm-3">Idade: </dt>
                    <dd class="col-sm-9">{{ $paciente->idade }}</dd>

                    <dt class="col-sm-3">Endereço: </dt>
                    <dd class="col-sm-9">{{ $paciente->endereco }}</dd>

                    <dt class="col-sm-3">Cartão SUS: </dt>
                    <dd class="col-sm-9">{{ $paciente->cartao_sus }}</dd>

                    <dt class="col-sm-3">CPF: </dt>
                    <dd class="col-sm-9">{{ $paciente->cpf }}</dd>

                    <dt class="col-sm-3">Telefone: </dt>
                    <dd class="col-sm-9">{{ $paciente->telefone }}</dd>
                
                    <dt class="col-sm-3">Município: </dt>
                    <dd class="col-sm-9">{{ optional($paciente->municipio)->municipio ?? 'NULL'  }}</dd>

                    <dt class="col-sm-3">Data de Nascimento: </dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($paciente->dt_nasc)->tz('America/Sao_Paulo')->format('d/m/Y')  }}</dd>

                    <dt class="col-sm-3">Sexo: </dt>
                    <dd class="col-sm-9">{{ $paciente->sexo }}</dd>

                    <dt class="col-sm-3">Raça/Cor: </dt>
                    <dd class="col-sm-9">{{ $paciente->raca_cor }}</dd>

                    <dt class="col-sm-3">Cadastrado por: </dt>
                    <dd class="col-sm-9">{{ optional($paciente->createdBy)->name ?? 'Não disponível' }}</dd>

                    <dt class="col-sm-3">Cadastrado em: </dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($paciente->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                    </dd>

                    <dt class="col-sm-3">Atualizado por: </dt>
                    <dd class="col-sm-9">{{ optional($paciente->updatedBy)->name ?? 'Não disponível' }}</dd>

                    <dt class="col-sm-3">Atualizado em: </dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($paciente->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                    </dd>

                </dl>
            </div>
        </div>
    </div>
@endsection
