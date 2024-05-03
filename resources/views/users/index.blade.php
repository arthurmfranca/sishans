@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Usuários</li>
            </ol>
        </div>

        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <form action="{{ route('user.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control shadow" placeholder="Pesquisar por Nome ou Sobrenome"
                            name="search" required>
                        <button type="submit" class="btn btn-success shadow"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    @can('create-user')
                        <a href="{{ route('user.create') }}" class="btn btn-success btn-sm"><i
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
                            <th>E-mail</th>
                            <th>Permissão</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($users as $user)
                            <tr>
                                <th>{{ $user->id }}</th>
                                <td>{{ $user->name . ' ' . $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($users->isEmpty())
                                        <div class="alert alert-danger" role="alert">Nenhum usuário encontrado!</div>
                                    @else
                                        @foreach ($user->getRoleNames() as $role)
                                            {{ $role }}
                                        @endforeach
                                    @endif

                                </td>
                                <td>{{ $user->status }}</td>
                                <td class="d-md-flex justify-content-center">

                                    @can('show-user')
                                        <a href="{{ route('user.show', ['user' => $user->id]) }}"
                                            class="btn btn-primary btn-sm me-1 mb-1">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>
                                    @endcan

                                    @can('edit-user')
                                        <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                                            class="btn btn-warning btn-sm me-1 mb-1">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                    @endcan

                                    @can('destroy-user')
                                        <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
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
                            <div class="alert alert-danger" role="alert">Nenhum usuário encontrado!</div>
                        @endforelse

                    </tbody>
                </table>

                {{ $users->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection
