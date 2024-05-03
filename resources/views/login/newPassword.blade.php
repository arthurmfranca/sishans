@extends('layouts.login')

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Nova Senha</h3>
                                </div>
                                <div class="card-body">

                                    <x-alert />

                                    <form action="{{ route('user.storeNewPassword') }}" method="POST">
                                        @csrf

                                        @method('PUT')

                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Senha" value="{{ old('password') }}">
                                            <label for="password">Digite a nova senha</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="password" name="repeatPassword" class="form-control" id="repeatPassword"
                                                placeholder="Senha" value="{{ old('repeatPassword') }}">
                                            <label for="repeatPassword">Repita a nova senha</label>
                                        </div>
                                        
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small text-decoration-none" href="#"></a>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
