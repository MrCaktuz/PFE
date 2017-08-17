@extends('partials.layout')
@section('content')

<h1 class="sr-only">Calendrier du club</h1>
<div class="container">
    <section class="section" id="games">
        <h2 class="section-title"><span class="section-icon section-icon-games"></span>Prochain matchs</h2>
        <div class="section-content flex-wrap gameCard-wrap">
        	@if($games->noGame)
                <div class="section-no-content">
                    <p>{{$games->noGame}}</p>
                </div>
            @else
                @include('ajax.games')
            @endif
        </div>
    </section>
    <section class="section" id="scores">
        <h2 class="section-title"><span class="section-icon section-icon-result"></span>Résultats</h2>
        <div class="section-content flex-wrap resultCard-wrap">
        	@if($results->noResult)
                <div class="section-no-content">
                    <p>{{$results->noResult}}</p>
                </div>
            @else
                @include('ajax.results')
            @endif
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-games"></span>Activités du club</h2>
        <div class="section-content flex-wrap">
        	@if($activities->noActivity)
                <div class="section-no-content">
                    <p>{{$activities->noActivity}}</p>
                </div>
            @endif
            @foreach($activities as $activity)
                <div class="activityCard">
                    <div class="activityCard-date">
                    	<p><span class="activityCard-day">{{$activity->date[0]}}</span><span class="activityCard-month">{{$activity->date[1]}}</span></p>
                    </div>
                    <div class="activityCard-content">
                    	<p class="activityCard-title">{{$activity->title}}</p>
                    	<p class="activityCard-duty">Service assuré par</p>
                    	<p class="activityCard-duty">{{$activity->duty}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

@endsection

