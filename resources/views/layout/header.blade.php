<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    @yield('nav-content-left')

    <ul class="navbar-nav">
      @yield('nav-content')
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(Auth::user()->picture() != null)
          <img class="wd-30 ht-30 rounded-circle" src="{{ Auth::user()->picture }}" alt="" />
          @else
          <img class="wd-30 ht-30 rounded-circle" src="{{ url('img/placeholder.png') }}" alt="">
          @endif
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
          <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
            <div class="mb-3">
              @if(Auth::user()->picture() != null)
              <img class="wd-80 ht-80 rounded-circle" src="{{ Auth::user()->picture }}" alt="" />
              @else
              <img class="wd-80 ht-80 rounded-circle" src="{{ url('img/placeholder.png') }}" alt="">
              @endif
            </div>
            <div class="text-center">
              <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
              <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
            </div>
          </div>
          <ul class="list-unstyled p-1">
            <li class="dropdown-item py-2 d-none">
              <a href="{{ }}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="user"></i>
                <span>Perfil</span>
              </a>
            </li>

            <li class="dropdown-item py-2">
              <a href="{{}}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="edit"></i>
                <span>Editar Perfil</span>
              </a>
            </li>
            <li class="dropdown-item py-2">
              <a href="{{ }}" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="repeat"></i>
                <span>Alterar Senha</span>
              </a>
            </li>
          
           
            <li class="dropdown-item py-2">
              <a type="button" data-bs-toggle="modal" data-bs-target="#modallogout" class="text-body ms-0">
                <i class="me-2 icon-md" data-feather="log-out"></i>
                <span>Sair do Sistema</span>
              </a>
            </li>

          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>
<form action="{{ route('logout') }}" method="POST">
  @csrf
  <div class="modal fade" id="modallogout" tabindex="-1" aria-labelledby="modallogouttitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modallogouttitle">Sair do sistema</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
          <p>Você tem certeza disso?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
          <button type="submit" class="btn btn-primary">Sim</button>
        </div>
      </div>
    </div>
  </div>
</form>