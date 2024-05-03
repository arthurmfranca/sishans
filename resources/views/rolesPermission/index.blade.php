@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Permissões do Papel - {{ $role->name }}</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('role.index') }}">Papéis</a></li>
                <li class="breadcrumb-item active">Papéis</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    @can('index-role')
                        <a href="{{ route('role.index') }}" class="btn btn-info btn-sm"><i class="fa-solid fa-list"></i>
                            Papéis</a>
                    @endcan
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Nome</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($permissions as $permission)
                            <tr>
                                <th>{{ $permission->id }}</th>
                                <td>{{ $permission->title }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>

                                    @if (in_array($permission->id, $rolePermissions ?? []))
                                        <a
                                            href="{{ route('role-permission.update', ['role' => $role->id, 'permission' => $permission->id]) }}">
                                            <span class="badge text-bg-success">Liberado</span>
                                        </a>
                                    @else
                                        <a
                                            href="{{ route('role-permission.update', ['role' => $role->id, 'permission' => $permission->id]) }}">
                                            <span class="badge text-bg-danger">Bloqueado</span>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhuma permissão para o papel encontrado!</div>
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
