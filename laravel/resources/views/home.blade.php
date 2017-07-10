@extends('partials.layout')
@section('content')

<header class="banner">
    <img class="banner-img" src="{{$imgSrc}}" srcset="{{$imgSrcset}}" alt="Photo du club">
    <h1 class="banner-title">{{$title}}<span class="banner-slogan">, {{$slogan}}</span></h1>
</header>
<div class="container">
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-games"></span>Matchs à venir</h2>
        <div class="section-content gameCard-container">
            @foreach($nextGames as $nextGame)
                <div class="gameCard">
                    <div class="gameCard-header">
                        <p class="gameCard-title">{{$nextGame->team_id}}</p>
                    </div>
                    <div class="gameCard-body">
                        <div class="gameCard-date">
                            <p class="gameCard-day">{{$nextGame->date}}</p>
                            <p class="gameCard-time">{{$nextGame->time}}</p>
                            @if($nextGame->appointment)
                                <p class="gameCard-appointment">Rendez-vous<span>{{$nextGame->appointment}}</span></p>
                            @endif
                        </div>
                        <div class="gameCard-teams">
                            <div class="gameCard-host">
                                <p class="gameCard-hostName">{{$nextGame->host}}</p>
                                @if($nextGame->host == 'RBC Ciney')
                                    <p class="gameCard-hostAddress">{{$addressStreet}}, {{$addressNumber}}</p>
                                    <p class="gameCard-hostAddress">{{$addressPostalCode}} {{$addressCity}}</p>
                                @endif
                                <span class="gameCard-icon"></span>
                            </div>
                            <div class="gameCard-visitor">
                                <p class="gameCard-visitorName">{{$nextGame->visitor}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="button-wrap button-wrap-center">
            <a href="/calendar#games" class="button button-primary">Voir tous nos matchs</a>
            <a href="/calendar#scores" class="button button-secondary">Voir nos résultats</a>
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-news"></span>Actualité du club</h2>
        <div class="section-content">
            
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-sponsor"></span>Nos partenaires</h2>
        <div class="section-content">
            
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-galery"></span>Nos derniers ablums photo</h2>
        <div class="section-content">
            
        </div>
    </section>
</div>

@endsection

