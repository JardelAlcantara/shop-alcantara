@extends('layout.master2')

@section('content')
<div class="row">
  <div class="col-sm-12 d-flex justify-content-center py-5 text-secondary text-center">
    <div>
      <h1 class="mb-0">Olá, {{ Auth::user()->name }}!</h1>
      <span class="text-secondary">{{ Auth::user()->email }}!</span>
    </div>
  </div>
</div>
@endsection