@extends('partials.layout')
@section('content')

<div class="container">
    <div class="section section-contact">
        <h1 class="section-title"><span class="section-icon section-icon-contact"></span>Contactez-nous</h1>
        <div class="section-content contact">
        	<div class="section-intro contact-intro">
                <p>{{$intro}}</p>
                <p>Vous pouvez aussi nous contacter via cette adresse mail&nbsp;:</p>
                <p><a class="contact-link contact-mail" href="mailto:{{$contactEmail}}?cc={{$contactCC}}">{{$contactEmail}}</a></p>
                <p>Vous nous trouverez à cette adresse&nbsp;:</p>
                <a class="contact-link contact-address" href="https://www.google.be/maps/place/Rue+Saint-Quentin+10,+5590+Ciney/@50.2993422,5.0960162,17z/data=!3m1!4b1!4m5!3m4!1s0x47c1b9e9c372d78b:0x81fa797516745527!8m2!3d50.2993422!4d5.0982049" target="_blanc" title="Voir notre google map" itemscope itemtype="https://schema.org/PostalAddress" itemprop="address">
		    		<p class="contact-address-line"><span itemprop="streetAddress">{{$addressStreet}}</span>, <span itemprop="postOfficeBoxNumber">{{$addressNumber}}</span></p>
		       		<p class="contact-address-line"><span itemprop="postalCode">{{$addressPostalCode}}</span> <span itemprop="addressLocality">{{$addressCity}}</span></p>
		    	</a>
            </div>
            <form class="form contact-form" id="contactForm" role="form" method="POST" action="/contact">
                {{ csrf_field() }}
                @if (count($errors) > 0)
                    <ul class="form-feedback form-feedback-errors">
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                @endif
                <fieldset class="form-fieldset">
                    <label for="name" class="sr-only form-label">Nom</label>
                    <input id="name" type="text" class="form-input" placeholder="Votre nom ici" name="name" value="{{ old('name') }}" required>            
                </fieldset>
                <fieldset class="form-fieldset">
                    <label for="email" class="sr-only form-label">Adresse e-mail</label>
                    <input id="email" type="email" class="form-input" placeholder="Votre adresse e-mail ici" name="email" value="{{ old('email') }}">            
                </fieldset>
                <fieldset class="form-fieldset">
                    <label for="obj" class="sr-only form-label">Sujet du message</label>
                    <input id="obj" type="text" class="form-input" placeholder="Le sujet de votre message ici" name="obj" value="{{ old('obj') }}">            
                </fieldset>
                <fieldset class="form-fieldset">
                    <label for="msg" class="sr-only form-label">Message</label>
                    <textarea type="text" name="msg" id="msg" placeholder="Votre message ici" value="" class="form-input form-textarea" rows="5" cols="30" required>{{ old( 'msg' ) }}</textarea>
                </fieldset>
                @if(isset($success))
                	<div class="form-feedback form-feedback-success">
                		{{$success}}
                	</div>
                @endif
                <fieldset class="form-fieldset button-wrap-right">
                    <button type="submit" class="form-input form-input-submit button button-primary">
                        Envoyer
                    </button>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="contact-gmap">
        <a href="https://www.google.be/maps/place/Rue+Saint-Quentin+10,+5590+Ciney/@50.2993422,5.0960162,17z/data=!3m1!4b1!4m5!3m4!1s0x47c1b9e9c372d78b:0x81fa797516745527!8m2!3d50.2993422!4d5.0982049" class="gmap-link" title="Lien vers la google map" target="_blanc">
            <img src="/img/gmap.jpg" srcset="/img/gmap_1280.jpg 1280w, /img/gmap_980.jpg 980w, /img/gmap_768.jpg 768w, /img/gmap_640.jpg 640w, /img/gmap_480.jpg 480w, /img/gmap_320.jpg 320w, " alt="Photo de la Google map">
        </a>
    </div>
</div>
@endsection

