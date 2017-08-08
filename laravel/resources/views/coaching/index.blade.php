@extends('partials.layout')
@section('content')

<h1 class="sr-only">Coaching</h1>
<div class="container">
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-coaching"></span>Espace coaching</h2>
        <div class="section-content flex-wrap">
        	@foreach($shared as $share)
        		<div class="coaching-box">
                    <div class="coaching-head">
                        <h3 class="coaching-title {{(Auth::user()->id == $share->user_id) ? "coaching-deletable" : ""}}">{{$share->title}}</h3>
                        @if(Auth::user()->id == $share->user_id)
                            <a href="/coaching/{{ $share -> id }}/confirm" class="coaching-delete" title="Supprimer ce fichier partagé">Supprimer</a>
                        @endif
                    </div>
    				<div class="coaching-body">			
	        			<p class="coaching-description">{{$share->description}}</p>
	        			<p class="coaching-date">{{$share->date}}</p>
	        			<p class="coaching-author">{{$share->author}}</p>
	        		</div>
        			<div class="coaching-links button-wrap-center">
        				@if($share->site)
	        				<a href="{{$share->site}}" target="_blanc" class="coaching-site button button-primary">Accès au site</a>
	        			@endif
	        			@if($share->file)
	        				<a href="/coaching/{{$share->id}}" class="coaching-file button button-primary">Télécharger</a>
	        			@endif
        			</div>
        		</div>
        	@endforeach
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-upload"></span>Partager ici</h2>
        <div class="section-content">
        	<div class="section-intro">
                <p>{{$intro}}</p>   
            </div>
            <form class="form form-center coaching-form" role="form" method="POST" action="/coaching">
                {{ csrf_field() }}
                @if (count($errors) > 0)
                    <ul class="form-feedback form-feedback-errors">
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                @endif
                <fieldset class="form-fieldset">
                    <label for="title" class="sr-only form-label">Titre</label>
                    <input id="title" type="text" class="form-input" placeholder="Titre ici" name="title" value="{{ old('title') }}" required>            
                </fieldset>

                <fieldset class="form-fieldset">
                    <label for="description" class="sr-only form-label">Description</label>
                    <textarea type="text" name="description" id="description" placeholder="Description courte ici" value="" class="form-input form-textarea" rows="3" cols="30" required>{{ old( 'description' ) }}</textarea>
                </fieldset>

                <fieldset class="form-fieldset">
                    <label for="site" class="sr-only form-label">Lien du site</label>
                    <input id="site" type="url" class="form-input" placeholder="Lien vers le site ici" name="site" value="{{ old('site') }}">            
                </fieldset>

                <fieldset class="form-fieldset form-fieldset-float">
                    <label class="form-label">
                        <input class="form-file" type="file" name="file">
                    </label>
                </fieldset>

                <fieldset class="form-fieldset button-wrap-right">
                    <button type="submit" class="form-input form-input-submit button button-primary">
                        Partager
                    </button>
                </fieldset>
            </form>
        </div>
    </section>
</div>

@endsection

