<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>

    <link rel="stylesheet" href="{{ asset('site/style.css') }}">
</head>

<body>

    <div class="main-wrapper" id="app">
        <div class="page-wrapper full-page">
            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                            <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                <span class="fs-5 d-none d-sm-inline">Shop Alcantara</span>
                            </a>
                            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start " id="menu">
                                <li class="nav-item">
                                    <a href="{{ route('admin') }}" class="nav-link px-0 text-white">
                                        <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline ">Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.product.index') }}" class="nav-link px-0 text-white">
                                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Produtos</span> </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.user.product.index') }}" class="nav-link px-0 text-white">
                                    <i class="fs-4 bi-bag"></i> <span class="ms-1 d-none d-sm-inline">Compras</span> </a>
                                </li>
                                @if(auth()->user()->type == 'ADMIN')
                                <li>
                                    <a href="{{ route('admin.brand.index') }}" class="nav-link px-0 text-white">
                                        <i class="fs-4 bi-filter-square-fill"></i> <span class="ms-1 d-none d-sm-inline">Marcas</span> </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.user.index') }}" class="nav-link px-0 text-white">
                                        <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Usuários</span> </a>
                                </li>
                                @endif
                            </ul>
                            <hr>
                            <div class="dropdown pb-4">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(Auth::user()->picture() != null)
                                    <img src="{{ Auth::user()->picture }}" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                    @else
                                    <img src="{{ url('img/placeholder.png') }}" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                    @endif
                                    <span class="d-none d-sm-inline mx-1 text-truncate">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                    <li><a class="dropdown-item" href="{{ route('admin.user.me') }}">Perfil</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.change.password', auth()->user()->id) }} ">Alterar Senha</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Sair</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col py-1">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('site/jquery.js') }}"> </script>
    <script src="{{ asset('site/bootstrap.js') }}"> </script>

</body>

</html>