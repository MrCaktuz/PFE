@extends('partials.layout')

@section('content')
<div class="container">
    <div class="box box-light">
        <p>Entrez votre adresse e-mail et votre mot de passe dans le formulaire ci-dessous pour vous connecter.</p>
    </div>
    <form class="form form-center" role="form" method="POST" action="/login">
        {{ csrf_field() }}
        @if (count($errors) > 0)
            <ul class="form_feedback form-feedback-errors">
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        @endif
        <fieldset class="form-fieldset">
            <label for="email" class="sr-only form-label">Adresse e-Mail</label>
            <input id="email" type="email" class="form-input{{-- {{ $errors->has('email') ? ' form-input--error' : '' }} --}}" placeholder="Adresse e-mail" name="email" value="{{ old('email') }}" required autofocus>            
        </fieldset>

        <fieldset class="form-fieldset">
            <label for="password" class="sr-only form-label">Mot de passe</label>
            <input id="password" type="password" class="form-input" placeholder="Mot de passe" name="password" required>
        </fieldset>

        <fieldset class="form-fieldset">
            <label class="form-label">
                <input class="form-input-check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
            </label>
        </fieldset>

        <fieldset class="form-fieldset button-wrap-center">
            <button type="submit" class="form-input form-input-submit button button-primary">
                Connection
            </button>
            <a class="form-reset" href="{{ route('password.request') }}">
                Oublié votre mot de passe?
            </a>
        </fieldset>
    </form>
</div>
@endsection
