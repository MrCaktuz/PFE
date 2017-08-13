@extends('partials.layout')
@section('content')

<h1 class="sr-only">Calendrier du club</h1>
<div class="container">
    <section class="section" id="games">
        <h2 class="section-title"><span class="section-icon section-icon-games"></span>Prochain matchs</h2>
        <div class="section-content flex-wrap">
        	@foreach($games as $game)
                <div class="gameCard">
                    <div class="gameCard-header">
                        <p class="gameCard-title">{{$game->team_id}}</p>
                    </div>
                    <div class="gameCard-body">
                        <div class="gameCard-date">
                            <p class="gameCard-day">{{$game->date}}</p>
                            <p class="gameCard-time">{{$game->time}}</p>
                            @if($game->appointment)
                                <p class="gameCard-appointment">Rendez-vous<span>{{$game->appointment}}</span></p>
                            @endif
                        </div>
                        <div class="gameCard-teams">
                            <div class="gameCard-host">
                                <p class="gameCard-hostName">{{$game->host}}</p>
                                @if($game->host == 'RBC Ciney')
                                    <p class="gameCard-hostAddress">{{$addressStreet}}, {{$addressNumber}}</p>
                                    <p class="gameCard-hostAddress">{{$addressPostalCode}} {{$addressCity}}</p>
                                @endif
                                <span class="gameCard-icon"></span>
                            </div>
                            <div class="gameCard-visitor">
                                <p class="gameCard-visitorName">{{$game->visitor}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="section" id="scores">
        <h2 class="section-title"><span class="section-icon section-icon-result"></span>Résultats</h2>
        <div class="section-content flex-wrap">
        	@if($results->noResult)
                <div class="section-no-content">
                    <p>{{$results->noResult}}</p>
                </div>
            @endif
            @foreach($results as $result)
                <div class="resultCard">
                    <div class="resultCard-header">
                        <div class="resultCard-title">
                            <p>{{$result->team_id}}</p>
                        </div>
                        <div class="resultCard-sub-title">
                            <p>{{$result->date}}</p>
                        </div>
                    </div>
                    <div class="resultCard-body">
                        <div class="resultCard-host">
                            <p class="resultCard-division">{{$result->host}}</p>
                            @if($result->hostScore > $result->visitorScore)
                                <p class="resultCard-score resultCard-score-won">{{$result->hostScore}}</p>
                            @else
                                <p class="resultCard-score">{{$result->hostScore}}</p>
                            @endif
                        </div>
                        <div class="resultCard-visitor">
                            <p class="resultCard-division">{{$result->visitor}}</p>
                            @if($result->visitorScore > $result->hostScore)
                                <p class="resultCard-score resultCard-score-won">{{$result->visitorScore}}</p>
                            @else
                                <p class="resultCard-score">{{$result->visitorScore}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
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

