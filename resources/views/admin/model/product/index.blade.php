@extends('layout.master2')


@section('content')

<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Produtos</a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                </li>

            </ul>
            <form class="d-flex" role="search">
                <input type="text" class="form-control me-2" id="name" placeholder="Buscar" name="search" autofocus value="{{ request()->get('search') }}">
                <button class="btn btn-outline-secondary me-2" type="submit">Filtrar</button>
            </form>
            @if(auth()->user()->type == 'ADMIN')
            <a class="btn btn-outline-secondary" href="{{ route('admin.product.create') }}"> Novo</a>
            @endif
        </div>
    </div>
</nav>


<div class="row">
    <div class="col-lg-12">
        @foreach($models as $model)
        <div class="card shadow-none mb-2">
            <div class="card-body row p-2">

                <div class="col text-truncate">
                    @if($model->picture() != null)
                    <img class="d-flex align-items-center text-white text-decoration-none">
                    <img src="{{ $model->picture }}" alt="hugenerd" width="50" height="50" class="rounded-circle"></img>
                    @else
                    <img class="d-flex align-items-center text-white text-decoration-none">
                    <img src="{{ url('img/placeholder.png') }}" alt="hugenerd" width="50" height="50" class="rounded-circle"></img>
                    @endif
                    <span class="card-text mb-0">{{ $model->name }}</span><br>

                </div>
                <div class="col text-truncate">
                    <span class="card-text mb-0">
                        {{ $model->brand->name }}
                    </span>
                    <p class="card-text mb-0 text-secondary"> Disponíveis: {{ $model->quantyty }} </p>
                </div>

                <div class="col text-truncate">
                    <span class="card-text mb-0">
                        Preço: R${{(number_format($model->value,2,',','.')) }}
                    </span>
                </div>


                <div class="col d-flex justify-content-end">
                    <div>
                        <a href="{{ route('admin.product.view',$model->id) }}" class="btn btn-default">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        @if(auth()->user()->type == 'ADMIN')
                        <a href="{{ route('admin.product.edit',$model->id) }}" class="btn btn-default">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button" class="btn btn-default" data-bs-toggle="modal" data-bs-target="#modaldelete{{$model->id}}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                        @endif
                        <form action="{{ route('admin.product.destroy',$model->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal fade" id="modaldelete{{$model->id}}" tabindex="-1" aria-labelledby="modaldeletetitle{{$model->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modaldeletetitle{{$model->id}}">Apagar Registro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Você tem certeza disso?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                            <button type="submit" class="btn btn-primary">Sim, apagar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@if ($models->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="{{ $models->previousPageUrl() }}">Previous</a>
        </li>
        
        <li class="page-item">
            <a class="page-link" href="{{ $models->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
@endif

@endsection