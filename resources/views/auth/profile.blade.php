@extends('layout.master2')


@section('content')


<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">{{Auth()->user()->name}}</a>
    </div>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Editar Perfil</h6>
                <form class="forms-sample" method="post" action="{{ route('user.me.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="name">Nome <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="name" value="{{ (!empty(Auth::user()->name) ? Auth::user()->name :old('name')) }}" />
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="email">Email <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="email" value="{{ (!empty(Auth::user()->email) ? Auth::user()->email :  old('email')) }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="phone">Telefone </label>
                            <input class="form-control" type="tel" name="phone" value="{{ (!empty(Auth::user()->phone) ? Auth::user()->phone :old('phone')) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="picture">Perfil </label>
                            <input class="form-control " type="file" id="picture" name="picture" />
                        </div>
                    </div>
                    

                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                    <a href="{{ route('admin') }}" class="btn btn-secondary"><i data-feather="x"></i>Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection