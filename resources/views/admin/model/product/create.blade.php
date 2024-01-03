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
                <h6 class="card-title">Novo Registro</h6>
                <form class="forms-sample" method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="name">Nome <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label for="quantyty">Quantidade <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="quantyty" value="{{ old('quantyty') }}" />
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label for="value">Valor <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="value" value="{{ old('value') }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Marca<b class="text-danger">*</b></label>
                            <select name="brand_id" class="form-select" id="brand_id">
                                @if(!empty($brands))
                                @foreach($brands as $brand)
                                <option @if(old('brand_id')==$brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="picture">Imagem </label>
                            <input class="form-control " type="file" id="picture" name="picture" />
                        </div>
                    </div>
                    <br>
                    <div class="form-floating">
                        <textarea class="form-control" id="description" name="description" style="height: 100px"></textarea>
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