@extends('partials.layout')
@section('content')

<h1 class="sr-only">Événement</h1>
<div class="container">
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-news"></span>{{$event->title}}</h2>
        <div class="section-content event flex-wrap">
        	<div class="event-photo">
	        	<img src="{{$event->src}}" srcset="{{$event->srcset}}" alt="Photo de l'event">
        	</div>
        	<div class="event-body">
		        {!!$event->description!!}
		        <div class="event-sub-section">
        			<h3>Quand ?</h3>
        			<p>{{$event->date}}</p>
        		</div>
		        <div class="event-sub-section">
        			<h3>Où ?</h3>
        			<p>{{$event->location}}</p>
        		</div>
		        <div class="event-sub-section">
        			<h3>Réservation</h3>
        			<p>{{$event->reservation}}</p>
        		</div>
		    </div>
        </div>
    </section>
</div>

@endsection

