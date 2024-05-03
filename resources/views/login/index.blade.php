@extends('layouts.login')

@section('content')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <a class="navbar-brand ps-2"><img class="img-fluid" src="{{ asset('images/NOVA_SES_PRETA_HOR.png') }}" alt="Logo Gov MA"></a>
                            </div>
                            <div class="card-body">

                                <x-alert />

                                <form action="{{ route('login.process') }}" method="POST">
                                    @csrf

                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail de usuário" value="{{ old('email') }}">
                                        <label for="email">E-mail</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Senha" value="{{ old('password') }}">
                                        <label for="password">Senha</label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <!-- <a class="small text-decoration-none" href="{{ route('forgot-password.show')}}">Esqueceu a senha?</a> -->
                                        <button type="submit" class="btn btn-primary">Acessar</button>
                                    </div>

                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img class="img-fluid" src="{{ asset('images/logo_hans.png') }}" alt="Logo Hans" style="max-width: 50%;">
                                </div>
                                <div class="large">Solicite seu acesso para o e-mail abaixo:</div>
                                <span>sishans@saude.ma.gov.br</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
