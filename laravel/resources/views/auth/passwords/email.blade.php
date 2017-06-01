@extends('partials.layout')

@section('content')
<div class="container">
    <div class="box box--light">
        <p>Entrez votre adresse e-mail dans le champ ci-dessous pour recevoir un e-mail avec le lien à suivre pour réinitialiser votre mot de passe.</p>
    </div>
    <form class="form form--center" role="form" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
         @if (count($errors) > 0)
            <ul class="form__feedback form__feedback--errors">
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        @endif
        <fieldset class="form__fieldset{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="sr-only form__label">E-Mail Address</label>
            <input id="email" type="email" class="form__input" placeholder="Adresse e-mail" name="email" value="{{ old('email') }}" required autofocus>
        </fieldset>

        <div class="form__fieldset button__wrap--center">
            <button type="submit" class="button button--primary">
                Envoyer
            </button>
        </div>
    </form>
</div>
@endsection
