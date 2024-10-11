  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            {{config ('app.name')}}
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link @if (Request::route()->getName() == 'app_accueil') active @endif" aria-current="page" href="{{route ('app_accueil') }}">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::route()->getName() == 'app_a-propos') active @endif" aria-current="page" href="{{route ('app_a-propos') }}">À Propos</a>  </li>
          </li>
        </ul>
        <div class="btn-group">
            @guest
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Mon Compte
                </button>
                <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('register')}}">Créer un Compte</a></li>
                        <li><a class="dropdown-item" href="{{ route('login')}}">Se Connecter</a></li>
                </ul>
                @endguest
                @auth
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}}
                </button>
                <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('app_logout')}}">Déconnexion</a></li>
                </ul>
                @endauth
          </div>
      </div>
    </div>
  </nav>
