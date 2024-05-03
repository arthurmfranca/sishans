@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Papéis</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Papéis</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    @can('create-user')
                        <a href="{{ route('role.create') }}" class="btn btn-success btn-sm"><i
                                class="fa-regular fa-square-plus"></i> Cadastrar</a>
                    @endcan
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($roles as $role)
                            <tr>
                                <th>{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td class="d-md-flex justify-content-center">

                                    @can('index-role-permission')
                                        <a href="{{ route('role-permission.index', ['role' => $role->id]) }}"
                                            class="btn btn-info btn-sm me-1 mb-1">
                                            <i class="fa-solid fa-list"></i> Permissões
                                        </a>
                                    @endcan

                                    @can('edit-role')
                                        <a href="{{ route('role.edit', ['role' => $role->id]) }}"
                                            class="btn btn-warning btn-sm me-1 mb-1">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                    @endcan

                                    @can('destroy-role')
                                        <form method="POST" action="{{ route('role.destroy', ['role' => $role->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm me-1 mb-1"
                                                onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum papel encontrado!</div>
                        @endforelse

                    </tbody>
                </table>

                {{ $roles->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection
