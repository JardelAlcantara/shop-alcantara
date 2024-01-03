@extends('layout.master2')


@section('content')


<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Marcas</a>
    </div>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Editar Registro</h6>
                <form class="forms-sample" method="post" action="{{ route('admin.brand.update',$model->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12 mb-2">
                            <label for="name">Nome <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="name" value="{{ (!empty($model->name) ? $model->name :old('name')) }}" />
                        </div>
                    </div>                   

                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                    <a href="{{ route('admin.brand.index') }}" class="btn btn-secondary"><i data-feather="x"></i>Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection