@extends('layouts.admin')

@section('content')
<div class="container-fluid px-5">
    <div class="mt-3 mb-4 space-between-elements">
        <h2 class="ms-2 mt-3 me-3">Paciente</h2>
        <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Pacientes</a>
            </li>
            <li class="breadcrumb-item active">Cadastrar</li>
        </ol>
    </div>

    <x-alert />

    <form action="{{ route('paciente.store') }}" method="POST">
        @csrf
        @method('POST')
        <!-- Informações Paciente -->
        <div class="card mt-3">
            <div class="card-header space-between-elements">
                <strong>Cadastrar</strong>

                @can('index-paciente')
                <a href="{{ route('paciente.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                    Listar</a>
                @endcan

            </div>
            <div class="card-body border">
                <div class="row mb-3">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="nome_paciente" class="form-label">Nome Completo do
                                Paciente:</label>
                            <input type="text" class="form-control" id="nome_paciente" name="nome_paciente" value="{{ old('nome_paciente') }}">
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="endereco" class="form-label">Endereço:</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="form-group">
                            <label for="" class="form-label">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="dt_nasc" name="dt_nasc" maxlength="15" value="{{ old('dt_nasc') }}">
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="idade" class="form-label">Idade:</label>
                            <input type="text" class="form-control" id="idade" name="idade" value="{{ old('idade') }}">
                        </div>
                    </div>
                  
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cartao_sus" class="form-label">Cartão do SUS:</label>
                            <input type="text" class="form-control" id="cartao_sus" name="cartao_sus" maxlength="15" value="{{ old('cartao_sus') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cpf" class="form-label">CPF:</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(99) 99999-9999&quot;" data-mask id="telefone" name="telefone" maxlength="15" value="{{ old('telefone') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mun_res" class="form-label">Município:</label>
                            <select class="form-control" id="mun_res" name="mun_res">
                                <option>Selecione uma opção</option>
                                @foreach ($municipios as $id => $municipio)
                                <option value="{{ $id }}" {{ old('mun_res') == $id ? 'selected' : '' }}>
                                    {{ $municipio }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-label">Semana Epidemiologica:</label>
                            <input type="number" class="form-control" id="se" name="se" value="{{ old('se') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-label">Sexo:</label>
                            <select class="form-control" id="sexo" name="sexo">
                                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Feminino" {{ old('sexo') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" class="form-label">Raça/Cor:</label>
                            <select class="form-control" id="raca_cor" name="raca_cor">
                                <option value="Branco" {{ old('raca_cor') == 'Branco' ? 'selected' : '' }}>Branco</option>
                                <option value="Negro" {{ old('raca_cor') == 'Negro' ? 'selected' : '' }}>Negro</option>
                                <option value="Pardo" {{ old('raca_cor') == 'Pardo' ? 'selected' : '' }}>Pardo</option>
                                <option value="Amarelo" {{ old('raca_cor') == 'Amarelo' ? 'selected' : '' }}>Amarelo</option>
                                <option value="Indígena" {{ old('raca_cor') == 'Indígena' ? 'selected' : '' }}>Indígena</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div><!-- Fim Informações Paciente -->
    </form>
</div>

<script>
    $(document).ready(function() {
        // Adicione um evento de alteração ao campo de município
        $('#municipio_id').on('change', function() {
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
                data: {
                    municipio_id: municipioId
                },
                success: function(data) {
                    // Adicione dinamicamente as opções do hospital com base na resposta AJAX
                    $.each(data, function(id, hospital) {
                        undSaudeSelect.append('<option value="' + id + '">' +
                            hospital + '</option>');
                    });
                }
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

<script>
    $(document).ready(function() {
    function calcularSemanaEpidemiologica() {
        var dataInicial = new Date("2023-12-31");
        var dataNotificacao = new Date(document.getElementById("dt_nasc").value);

        var diffInTime = dataNotificacao.getTime() - dataInicial.getTime();
        var diffInDays = diffInTime / (1000 * 3600 * 24);
        var week = Math.floor(diffInDays / 7);

        $('se').val(week);

    }
});
</script>


<script>
    // Inicialize o Inputmask para CPF
    Inputmask("999.999.999-99").mask("#cpf");

    // Inicialize o Inputmask para telefone
    Inputmask("(99) 99999-9999").mask("#telefone");

    // Inicialize o Inputmask para Data de Nascimento
    $(document).ready(function() {
        $('#dt_nasc').inputmask('dd/mm/yyyy', {
            placeholder: "dd/mm/aaaa"
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Função para calcular a idade com base na data de nascimento
        function calcularIdade() {
            // Obtenha a data de nascimento do campo
            var dataNascimento = new Date($('#dt_nasc').val() + 'T00:00:00');

            // Obtenha a data atual
            var dataAtual = new Date();

            // Calcule a diferença em milissegundos
            var diferenca = dataAtual - dataNascimento;

            // Converta a diferença de milissegundos para anos
            var idade = Math.floor(diferenca / (365.25 * 24 * 60 * 60 * 1000));

            // Preencha automaticamente o campo de idade
            $('#idade').val(idade);
        }

        // Adicione um ouvinte de evento para o campo de data de nascimento
        $('#dt_nasc').change(function() {
            calcularIdade();
        });

        // Chame a função uma vez para preencher a idade inicialmente, se a data de nascimento já estiver preenchida
        if ($('#dt_nasc').val() !== '') {
            calcularIdade();
        }
    });
</script>
@endsection