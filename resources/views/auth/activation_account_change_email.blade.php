@extends('irct-hd')
@section('title', 'Changement Email')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 align-self-center mx-auto">
                <h1 class="text-center text-muted mb-5 mt-5">Changez voute adresse Email</h1>
                <form method="POST" action="{{route('app_activation_account_change_email',['token' => $token]) }}">
                    @csrf
                    @include('alerts.alert-message')
                    <label for="new-email">Votre nouvelle adresse e-mail:</label>
                    <input type="text" name="new-email" id="new-email" class="form-control mb-3 @if(Session::has('danger')) is-invalid @endif" value="@if(Session::has('new_email')){{ Session::get('new_email')}} @endif" placeholder="Enregistrer une nouvelle adresse" required autofocus>
                    <div class="d-grid gap-2 mx-auto">
                        <button class="btn btn-primary" type="submite">Changer E-mail</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
