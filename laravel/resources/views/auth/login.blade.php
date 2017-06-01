@extends('partials.layout')

@section('content')
<div class="container">
    <div class="box box--light">
        <p>Entrez votre adresse e-mail et votre mot de passe dans le formulaire ci-dessous pour vous connecter.</p>
    </div>
    <form class="form form--center" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        @if (count($errors) > 0)
            <ul class="form__feedback form__feedback--errors">
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        @endif
        <fieldset class="form__fieldset">
            <label for="email" class="sr-only form__label">Adresse e-Mail</label>
            <input id="email" type="email" class="form__input{{-- {{ $errors->has('email') ? ' form__input--error' : '' }} --}}" placeholder="Adresse e-mail" name="email" value="{{ old('email') }}" required autofocus>            
        </fieldset>

        <fieldset class="form__fieldset">
            <label for="password" class="sr-only form__label">Mot de passe</label>
            <input id="password" type="password" class="form__input" placeholder="Mot de passe" name="password" required>
        </fieldset>

        <fieldset class="form__fieldset">
            <label class="form__label">
                <input class="form__input--check" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir de moi
            </label>
        </fieldset>

        <fieldset class="form__fieldset button__wrap--center">
            <button type="submit" class="form__input form__input--submit button button--primary">
                Connection
            </button>
            <a class="form__reset" href="{{ route('password.request') }}">
                Oublié votre mot de passe?
            </a>
        </fieldset>
    </form>
</div>
@endsection
