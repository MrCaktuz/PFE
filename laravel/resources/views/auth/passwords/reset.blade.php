@extends('partials.layout')

@section('content')
<div class="container">
    <div class="box box--light">
        <p>Entrez votre adresse e-mail et votre nouveau mot de passe de le formulaire ci-dessous.</p>
    </div>
    <form class="form form--center" role="form" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        @if (count($errors) > 0)
            <ul class="form__feedback form__feedback--errors">
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        @endif

        <input type="hidden" name="token" value="{{ $token }}">
        
        <fieldset class="form__fieldset">
            <label for="email" class="sr-only form__label">Adresse e-Mail</label>
            <input id="email" type="email" class="form__input" placeholder="Adresse e-mail" name="email" value="{{ $email or old('email') }}" required autofocus>
        </fieldset>
        
        <fieldset class="form__fieldset">
            <label for="password" class="sr-only form__label">Mot de passe</label>
            <input id="password" type="password" class="form__input" placeholder="Mot de passe" name="password" required>
        </fieldset>

        <fieldset class="form__fieldset">
            <label for="password-confirm" class="sr-only form__label">Mot de passe</label>
            <input id="password-confirm" type="password" class="form__input" placeholder="Confirmation du mot de passe" name="password_confirmation" required>
        </fieldset>

        <fieldset class="form__fieldset button__wrap--center">
            <button type="submit" class="button button--primary">
                Enregistrer
            </button>
        </fieldset>
    </form>
</div>
@endsection
