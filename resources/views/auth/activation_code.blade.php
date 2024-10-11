@extends('irct-hd')
@section('title', 'Account_activation')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 align-self-center mx-auto">
                <h1 class="text-center text-muted mb-5 mt-5">Activation du compte</h1>
                <form method="POST" action="{{route('app_activation_code',['token' => $token]) }}">
                    @csrf
                    @include('alerts.alert-message')
                    <label for="activation-code">Votre code d'activation:</label>
                    <input type="text" name="activation-code" id="activation-code" class="form-control mb-3 @if(Session::has('danger')) is-invalid @endif" value="@if(Session::has('activation_code')){{ Session::get('activation_code')}} @endif" required autofocus>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <a href="{{ route('app_activation_account_change_email',['token'=> $token])}}"><small>Modifier l'adresse E-mail</small></a>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('app_resend_activation_code', ['token' => $token]) }}"><small>Réenvoyer le code d'activation</small></a>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mx-auto">
                        <button class="btn btn-primary" type="submite">Activation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
