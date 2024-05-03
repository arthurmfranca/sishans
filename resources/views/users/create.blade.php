@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('user.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">Cadastrar</li>
            </ol>
        </div>
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="card card-default">
                <div class="card-header space-between-elements">
                    <span>Cadastrar</span>
                    <span class="d-flex">

                        @can('index-user')
                            <a href="{{ route('user.index') }}" class="btn btn-info btn-sm me-1"><i
                                    class="fa-solid fa-list"></i>
                                Listar</a>
                        @endcan

                    </span>
                </div>

                <div class="card-body">

                    <x-alert />

                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="" value="{{ old('name') }}">
                        </div>

                        <div class="col-6">
                            <label for="lastname" class="form-label">Sobrenome:</label>
                            <input type="text" name="lastname" id="lastname" class="form-control"
                                placeholder="" value="{{ old('lastname') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="" value="{{ old('email') }}">
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="municipio_id" class="form-label">Município:</label>
                                <select class="form-control" id="municipio_id"
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status" class="form-label">Papel:</label>
                                <select name="roles" class="form-select" id="roles">
                                    <option value="">Selecione uma opção</option>
                                    @forelse ($roles as $role)
                                        @if ($role != "Super Admin")
                                            <option value="{{ $role }}" {{ old('roles') == $role ? 'selected' : ''}}>{{ $role }} </option>
                                        @else
                                            @if (Auth::user()->hasRole('Super Admin'))
                                                <option value="{{ $role }}" {{ old('roles') == $role ? 'selected' : ''}}>{{ $role }} </option>
                                            @endif
                                        @endif
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status" class="form-label">Status:</label>
                                <select class="form-control" id="status" name="status"
                                    value="{{ old('status') }}">
                                    <option>Selecione uma opção</option>
                                    <option value="Ativo">Ativo</option>
                                    <option value="Inativo">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="password" class="form-label"><E-mail></E-mail>Senha:</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="" value="{{ old('password') }}">
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
