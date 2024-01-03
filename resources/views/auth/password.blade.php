@extends('layout.master2')

@section('content')
<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Alterar Senha</a>
    </div>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" method="post" action="{{ route('admin.update.password', $model->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <label for="">Senha antiga <b class="text-danger">*</b></label>
                            <input class="form-control" type="password" name="passwordOld" />
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label for="">Nova senha <b class="text-danger">*</b></label>
                            <input class="form-control" type="password" name="password" />
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label for="">Confirme a senha <b class="text-danger">*</b></label>
                            <input class="form-control" type="password" name="password_confirmation" />
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
