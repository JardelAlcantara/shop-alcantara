@extends('layout.master2')


@section('content')


<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Usuários</a>
    </div>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Novo Registro</h6>
                <form class="forms-sample" method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="name">Nome <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="email">Email <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="email" value="{{ old('email') }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="type">Tipo <b class="text-danger">*</b> </label>
                            <select name="type" class="form-select ">
                                <option value="ADMIN">Administrador</option>
                                <option value="CLI">Cliente</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label for="phone">Telefone </label>
                            <input class="form-control" type="tel" name="phone" value="{{ old('phone') }}" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="picture">Perfil </label>
                            <input class="form-control " type="file" id="picture" name="picture" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="password">Senha <b class="text-danger">*</b></label>
                            <input class="form-control" type="password" name="password" value="{{ old('password') }}" />
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="password">Confirme a Senha <b class="text-danger">*</b></label>
                            <input class="form-control" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary"><i data-feather="x"></i>Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection