@extends('irct-hd')
@section('title', 'Login')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 align-self-center mx-auto">
                <h1 class="text-center text-muted mb-5 mt-5">Connectez-vous</h1>
                <form method="POST" action="{{route('login') }}">
                    @csrf
                    @include('alerts.alert-message')
                    @error('email')
                        <div class="alert alert-danger text-center" role="alert">
                        {{ $message }}
                        </div>
                    @enderror
                    @error('password')
                        <div class="alert alert-danger text-center" role="alert">
                        {{ $message }}
                        </div>
                    @enderror
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control mb-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="password">Mot de Passe:</label>
                    <input type="password" name="password" id="password" class="form-control mb-3 @error('password') is-invalid @enderror" required autocomplete="current-password">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="remember" name="remember"{{ old('remember') ? 'cheked': ''}}>
                                <label class="form-check-label" for="remember">Se souvenir de moi</label>
                              </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="#">Mot de passe oublier?</a>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mx-auto">
                        <button class="btn btn-primary" type="submite">Se Connecter</button>
                      </div>
                      <p class="text-center text-muted mt-5">Pas encore inscrit ? <a href="{{ route('register')}}">Créer un compte</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection
