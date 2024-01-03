@extends('layout.master2')


@section('content')


<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Produtos</a>
    </div>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Editar Registro</h6>
                <form class="forms-sample" method="post" action="{{ route('admin.product.update',$model->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="name">Nome <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="name" value="{{ (!empty($model->name) ? $model->name :old('name')) }}" />
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label for="quantyty">Quantidade <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="quantyty" value="{{ (!empty($model->quantyty) ? $model->quantyty :old('quantyty')) }}" />
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label for="value">Valor <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="value" value="{{ (!empty($model->value) ? $model->value :old('value')) }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Marca<b class="text-danger">*</b></label>
                            <select name="brand_id" class="form-select" id="brand_id">
                                @foreach ($brands as $brand)
                                <option @if($brand->id==$model->brand_id) selected @endif value="{{ $brand->id }}">
                                    {{ $brand->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="picture">Imagem </label>
                            <input class="form-control " type="file" id="picture" name="picture" />
                        </div>
                    </div>
                    <br>
                    <div class="form-floating">
                        <textarea class="form-control" id="description" name="description" style="height: 100px"> {{ (!empty($model->description) ? $model->description :old('description')) }}</textarea>
                        <label for="description">Descrição</label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary"><i data-feather="x"></i>Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection