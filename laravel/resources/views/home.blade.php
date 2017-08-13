@extends('partials.layout')
@section('content')

<div class="container">
    <header class="banner">
        <img class="banner-img" src="{{$imgSrc}}" srcset="{{$imgSrcset}}" alt="Photo du club">
        <h1 class="banner-title">{{$title}}<span class="home-banner-slogan">, {{$slogan}}</span></h1>
    </header>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-games"></span>Matchs à venir</h2>
        <div class="section-content flex-wrap">
            @foreach($nextGames as $game)
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
        <div class="button-wrap button-wrap-center">
            <a href="/calendrier#games" class="button button-primary" title="Accéder à la page calendrier sur la section matchs">Voir tous nos matchs</a>
            <a href="/calendrier#scores" class="button button-secondary" title="Accéder à la page calendrier sur la section résultats">Voir nos résultats</a>
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-news"></span>Actualité du club</h2>
        <div class="section-content flex-wrap">
            @foreach($nextEvents as $event)
                <div class="eventCard">
                    <img class="eventCard-img" src="{{$event->src}}" srcset="{{$event->srcset}}" alt="Photo illustrant l'événement">
                    <a class="eventCard-header" href="/evenements/{{$event->id}}" title="Lien vers la page de l'événement">
                        <div class="eventCard-icon">
                            <img src="/img/icons/news-icon-white.png" alt="icon" width="20" height="20">
                        </div>
                        <p class="eventCard-date">{{$event->date}}</p>
                        <p class="eventCard-title">{{$event->title}}</p>
                    </a>
                    <div class="eventCard-description">
                        <p>Pour avoir plus d'info sur cette événement, rendez-vous sur la page qui lui est dédiée via le lien ci-dessous</p>
                    </div>
                    <div class="eventCard-more button-wrap button-wrap-center">
                        <a href="/evenements/{{$event->id}}" class="button button-primary" title="Lien vers la page de l'événement">Plus d'infos</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-sponsor"></span>Nos partenaires</h2>
        <div class="section-content flex-wrap sponsor-slider sponsor-wrap">
            @foreach($sponsors as $sponsor)
                <a class="sponsor" href="{{$sponsor->url}}" target="_blanc" title="Accéder au site du partenaire">
                    <img class="sponsor-img" src="{{$sponsor->image}}" srcset="{{$sponsor->srcset}}" alt="{{$sponsor->name}}">
                </a>
            @endforeach
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-galery"></span>Nos derniers ablums photo</h2>
        <div class="section-content flex-wrap">
        @foreach($albums as $album)
            <div class="albumCard-wrap">
                <a class="albumCard" href="/albums/{{$album->id}}" title="Accéder ">
                    <img class="albumCard-img" src="{{$album->src[0]}}" srcset="{{$album->srcset[0]}}" alt="{{$album->name}}">
                    <h3 class="albumCard-title">{{$album->name}}</h3>
                </a>
                <div class="albumCard-link">
                    <p>Voir l'album<span class="icon-link"></span></p>
                </div>
            </div>
        @endforeach
        </div>
    </section>
</div>

@endsection

