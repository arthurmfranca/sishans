@extends('layouts.admin')

@section('content')
       <div class="container-fluid px-5">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('user.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">Usuário</li>
            </ol>
        </div>


        <div class="card card-default">
            <div class="card-header space-between-elements">
                <span>Editar</span>
                <span class="d-flex">

                    @can('index-user')
                        <a href="{{ route('user.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                            Listar</a>
                    @endcan

                    @can('show-user')
                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-primary btn-sm me-1"><i
                                class="fa-regular fa-eye"></i> Visualizar
                        </a>
                    @endcan

                    @can('destroy-user')
                        <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
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
                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" class="g-3">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder=""
                                value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Sobrenome:</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder=""
                                value="{{ old('lastname', $user->lastname) }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder=""
                                value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipio_id" class="form-label">Município:</label>
                                <select class="form-control select2" style="width: 100%;" id="municipio_id"
                                    name="municipio_id">
                                    <option>Selecione uma opção</option>
                                    @foreach ($municipios as $id => $municipio)
                                        <option value="{{ $id }}" {{ old('municipio_id', $userMunicipio) == $id ? 'selected' : '' }}>
                                            {{ $municipio }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="form-label">Status:</label>
                                <select class="form-control select2" style="width: 100%;" id="status" name="status">
                                    <option value="Ativo" {{ old('status', $user->status) == 'Ativo' ? 'selected' : '' }}>
                                        Ativo</option>
                                    <option value="Inativo"
                                        {{ old('status', $user->status) == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="roles" class="form-label">Papel: </label>
                                <select name="roles" class="form-select" id="roles">
                                    <option value="">Selecione uma opção</option>
                                    @forelse ($roles as $role)
                                        @if ($role != 'Super Admin')
                                            <option value="{{ $role }}"
                                                {{ old('roles') == $role || $role == $userRoles ? 'selected' : '' }}>
                                                {{ $role }} </option>
                                        @else
                                            @if (Auth::user()->hasRole('Super Admin'))
                                                <option value="{{ $role }}"
                                                    {{ old('roles') == $role || $role == $userRoles ? 'selected' : '' }}>
                                                    {{ $role }} </option>
                                            @endif
                                        @endif
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer d-flex justify-content-md-end">
                <button type="submit" class="btn btn-success bt-sm">Salvar</button>
            </div>
        </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Adicione um evento de alteração ao campo de município
            $('#municipio_id').on('change', function () {
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
                    data: { municipio_id: municipioId },
                    success: function (data) {
                        // Adicione dinamicamente as opções do hospital com base na resposta AJAX
                        $.each(data, function (id, hospital) {
                            undSaudeSelect.append('<option value="' + id + '">' + hospital + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
