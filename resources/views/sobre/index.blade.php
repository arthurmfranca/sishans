@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Sobre o Questionário</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('paciente.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Sobre</li>
            </ol>
        </div>

        <div class="card mt-5 border-light shadow">
            <div class="card-body">
                <p class="fs-5 text-muted">
                    Para ajudar na avaliação e diagnóstico precoce dos casos novos de hanseníase, 
                    foi elaborado o Questionário de Suspeição de Hanseníase (QSH). O QSH é um conjunto de questões com sinais e 
                    sintomas relacionados à doença, além da indagação sobre história familiar da doença.
                </p>
                <p class="fs-5 text-muted">
                    Para os autores do questionário, Dr. Fred Bernardes Filho e Prof. Dr. Marco Andrey Cipriani Frade, a implementação 
                    do questionário tem se mostrado um importante instrumento de educação em saúde sobre hanseníase na comunidade e entre 
                    os profissionais e estudantes da área da saúde.
                </p>               
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="d-flex justify-content-left">
                        <span>
                            Saiba mais acessando o link <a href="https://www.qsh-hcrp.com.br/" target="_blank"
                                style="color: #007bff; text-decoration: none;">https://www.qsh-hcrp.com.br/</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
