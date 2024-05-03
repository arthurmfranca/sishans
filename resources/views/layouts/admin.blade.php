<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SisHans</title>

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5/dist/inputmask.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .filled {
            background-color: #f0f8ff;
            /* Adapte a cor de destaque conforme necessário */
        }
    </style>

</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-nav">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-2" href="#"><img class="img-fluid" src="{{ asset('images/marca ses horizontal em branco.png') }}" alt="Logo Gov MA"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fa-regular fa-user"></i>
                            Perfil</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('login.destroy') }}"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Sair</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-five" id="sidenavAccordion">
                <div class="sb-sidenav-menu mt-3">
                    <div class="nav">

                        @can('index-paciente')
                        <a @class(['nav-link', 'active'=> isset($menu) && $menu == 'pacientes']) class="nav-link" href="{{ route('paciente.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user-injured"></i></i></div>
                            Pacientes
                        </a>
                        @endcan

                        <!-- @can('index-notificacoes')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'notificacoes']) class="nav-link" href="{{ route('paciente.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-bullhorn"></i></i></div>
                                Notificações
                            </a>
                        @endcan -->

                        @can('index-user')
                        <a @class(['nav-link', 'active'=> isset($menu) && $menu == 'users']) class="nav-link" href="{{ route('user.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Usuários
                        </a>
                        @endcan

                        @can('index-papel')
                        <a @class(['nav-link', 'active'=> isset($menu) && $menu == 'roles']) class="nav-link" href="{{ route('role.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-network-wired"></i></div>
                            Papéis
                        </a>
                        @endcan

                        @can('index-permission')
                        <a @class(['nav-link', 'active'=> isset($menu) && $menu == 'permissions']) class="nav-link" href="{{ route('permission.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></div>
                            Páginas
                        </a>
                        @endcan

                       
                        <a @class(['nav-link', 'active'=> isset($menu) && $menu == 'sobre']) class="nav-link" href="{{ route('sobre.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-info"></i></div>
                            Sobre
                        </a>


                        <a class="nav-link" href="{{ route('login.destroy') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-right-to-bracket"></i></div>
                            Sair
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logado:
                        @if (auth()->check())
                        {{ auth()->user()->name }}
                        @endif
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main>
                @yield('content')
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <a href="https://www.saude.ma.gov.br/" class="text-decoration-none">Secretaria de Estado da Saúde - MA</a>
                        <div>
                            <div class="text-muted">SisHans 1.0 - {{ date('Y') }}</div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
