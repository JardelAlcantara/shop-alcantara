@extends('layout.master')
@section('content')
<section class="vh-100 bg-dark">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{ asset('img/abstract.jpg') }}" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form class="forms-sample" action="{{ route('admin.login') }}" method="post">
                  @csrf
                  @if($errors->all())
                  @foreach($errors->all() as $error)
                  <div class="alert alert-danger" role="alert">
                    {{ $error }}
                  </div>
                  @endforeach
                  @endif
                  <h3>Shop Alcantara</h3>

                  <h5>Informe suas credenciais</h5>

                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                    <label for="floatingInput">Email</label>
                  </div>
                  <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="floatingPassword">Senha </label>
                  </div>
                  <br>
                  <div>
                    <button type="submit" class="btn btn-primary btn-lg" type="button">Entrar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection