@extends('partials.layout')
@section('content')

<div class="container">
    <div class="section">
    	<?php if(Auth::user()->id == $user->id) {
    		$validated = true;
    	} else {
    		$validated = false;
    	} ?>
	    <h1 class="section-title"><span class="section-icon section-icon-profil"></span>Modification de profil</h1>
	    @if(!$validated)
    		<div class="box feedback">
			    <div class="feedback-content">
			        <p>Désolé {{ Auth::user()->name }}, vous n'avez pas le droit de modifier ce profil.</p>
			        <p>Redirigez vous sur votre profil ou sur la page d'accueil.</p>
			    </div>
			    <div class="button-wrap button-wrap-center">
			        <a class="button button-primary "href="/user/{{Auth::user()->id}}" title="Voir votre profil" >Votre profil</a>
			        <a class="button button-secondary" href="/" title="Retour à la page d'accueil">Retour à l'accueil</a>
			        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			            {{ csrf_field() }}
			        </form>
			    </div>
			</div>
    	@else
	        <div class="section-content profil">
	        	<div class="profil-head">
	        		<p class="profil-name">{{$user->name}}</p>
	        	</div>
	        	<div class="profil-photo">
		        	<img src="{{$user->src}}" srcset="{{$user->srcset}}" alt="">
	        	</div>
	        	<div class="profil-body">
		        	<form class="form form-center profil-form" role="form" method="POST" action="/user/{{$user->id}}" enctype="multipart/form-data">
		                {{ csrf_field() }}
		                @if (count($errors) > 0)
		                    <ul class="form-feedback form-feedback-errors">
		                        @foreach ($errors->all() as $error)
		                            <li>{!! $error !!}</li>
		                        @endforeach
		                    </ul>
		                @endif
		                <fieldset class="form-fieldset">
		                    <label for="civility" class="sr-only form-label">Civilité</label>
		                    <input id="civility" type="text" class="form-input" name="civility" placeholder="Monsieur, Madame, Mademoiselle" value="{{$user->civility}}">            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="name" class="sr-only form-label">Nom</label>
		                    <input id="name" type="text" class="form-input" placeholder="Votre nom" name="name" value="{{$user->name}}" required>            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="email" class="sr-only form-label">E-mail</label>
		                    <input type="email" name="email" id="email" class="form-input" placeholder="Votre adresse e-mail" value="{{$user->email}}" required>
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="birthday" class="sr-only form-label">Date de naissance</label>
		                    <input id="birthday" type="date" class="form-input" placeholder="Votre date de naissance" name="birthday" value="{{$user->birthday}}">            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="birthLocation" class="sr-only form-label">Lieu de naissance</label>
		                    <input id="birthLocation" type="text" class="form-input" placeholder="Votre lieu de naissance" name="birthLocation" value="{{$user->birth_location}}">            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="phone" class="sr-only form-label">N° de téléphone</label>
		                    <input id="phone" type="phone" class="form-input" placeholder="Votre numéro de téléphone" name="phone" value="{{$user->phone}}">            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="address" class="sr-only form-label">Adresse</label>
		                    <input id="address" type="text" class="form-input" placeholder="Votre adresse" name="address" value="{{$user->address}}">            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="postalCode" class="sr-only form-label">Code postal</label>
		                    <input id="postalCode" type="text" class="form-input" placeholder="Votre code postal" name="postalCode" value="{{$user->spostal_code}}">            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="city" class="sr-only form-label">Ville</label>
		                    <input id="city" type="text" class="form-input" placeholder="Votre ville" name="city" value="{{$user->city}}">            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="nationalID" class="sr-only form-label">Numéro de registre national</label>
		                    <input id="nationalID" type="text" class="form-input" placeholder="Votre numéro de registre national" name="nationalID" value="{{$user->national_id}}">            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="job" class="sr-only form-label">Profession</label>
		                    <input id="job" type="text" class="form-input" placeholder="Votre profession" name="job" value="{{$user->job}}">            
		                </fieldset>
		                <fieldset class="form-fieldset">
		                    <label for="jersey" class="sr-only form-label">N° de maillot</label>
		                    <input id="jersey" type="text" class="form-input" placeholder="Votre n° de maillot" name="jersey" value="{{$user->jersey_nbr}}">            
		                </fieldset>
		                {{-- <fieldset class="form-fieldset">
		                    <div class="form-input">
		                    	<label for="img" class="form-label form-label-photo">Votre photo de profil</label>
			                    <input id="img" type="file" class="form-input-float" placeholder="Votre photo" name="img" value="{{$user->photo}}">            
		                    </div>
		                </fieldset> --}}

		                <fieldset class="form-fieldset button-wrap-right">
		                    <button type="submit" class="form-input form-input-submit button button-primary">Enregistrer</button>
		                </fieldset>
		            </form>
			    </div>
	        </div>
    	@endif
    </div>
</div>

@endsection

