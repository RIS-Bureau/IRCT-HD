@extends('irct-hd')
@section('title', 'Register')
@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-5 mx-auto">
            <h1 class="text-center text-muted mt-5 mb-3">Inscrivez-vous</h1>
            <form method="POST" action="{{route('register')}}" id="form-register">
                @csrf
                <div class="row g-2">
                    <div class="col">
                        <label for="firstname" class="form-label">Nom:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{old('firstname')}}" required autocomplete="firstname" autofocus>
                        <small class="text-danger fw-bold" id="error-register-firstname"></small>
                    </div>
                    <div class="col">
                        <label for="lastname" class="form-label">Prénom:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname')}}" required autocomplete="lastname">
                        <small class="text-danger fw-bold" id="error-register-lastname"></small>
                    </div>
                </div>
                <div class="row g-1">
                    <div class="col">
                        <label for="email" class="form-label">Votre Adresse E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="user@domaine.com" value="{{old('email')}}" required autocomplete="email" url-emailExist="{{ route('app_exist_email') }}" token="{{ csrf_token() }}">
                        <small class="text-danger fw-bold" id="error-register-email"></small>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col">
                            <label for="password" class="form-label">Votre mot de passe:</label>
                            <input type="text" class="form-control" id="password" name="password" value="{{old('password')}}" required autocomplete="password">
                            <small class="text-danger fw-bold" id="error-register-password"></small>
                    </div>
                    <div class="col">
                            <label for="password-confirm" class="form-label">Confirmation du mot de passe:</label>
                            <input type="password" class="form-control" id="password-confirm" name="password-confirm" value="{{old('password-confirm')}}" required autocomplete="password-confirm">
                            <small class="text-danger fw-bold" id="error-register-password-confirm"></small>
                    </div>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" value="" id="agreeTerms">
                    <label class="form-check-label" for="agreeTerms">Accepter les conditions</label><br>
                    <small class="text-danger fw-bold" id="error-register-agreeTerms"></small>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button" id="register-user">Inscrivez-vous</button>
                  </div>
                  <p class="text-center text-muted mt-5">Vous avez déja un compte ? <a href="{{ route('login')}}">Connectez-vous</a></p>
            </form>
        </div>
    </div>
</div>
@endsection
