@extends('partials.layout')
@section('content')

<div class="container">
    <header class="team-banner banner">
    <?php if($team->src == $team->default) : ?>
        <img class="team-banner-img team-banner-img-default banner-img" src="{{$team->src}}" srcset="{{$team->srcset}}" alt="Photo de l'équipe {{$team->division}}">
    <?php else : ?>
        <img class="team-banner-img banner-img" src="{{$team->src}}" srcset="{{$team->srcset}}" alt="Photo de l'équipe {{$team->division}}">
    <?php endif; ?>
        <h1 class="team-banner-title banner-title"><span class="section-icon section-icon-team"></span>Équipe {{$team->division}}</h1>
    </header>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-games"></span>Prochains matchs</h2>
        <div class="section-content flex-wrap">
            @if($games->noGame)
                <div class="section-no-content">
                    <p>{{$games->noGame}}</p>
                </div>
            @endif
            @foreach($games as $game)
                <div class="gameCard">
                    <div class="gameCard-header">
                        <p class="gameCard-title">{{$game->date}}</p>
                    </div>
                    <div class="gameCard-body">
                        <div class="gameCard-date">
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
    <section class="section">
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
        <h2 class="section-title"><span class="section-icon section-icon-team"></span>Effectif</h2>
        <div class="section-content flex-wrap">
            <div class="section-col">
                <a class="idCard" href="/userz/{{$coach->id}}" title="Voir le profil de {{$coach->name}}">
                    <img src="{{$coach->src}}" srcset="{{$coach->srcset}}" alt="photo de profil" class="idCard-photo">
                    <div class="idCard-content">
                        <p class="idCard-title">Entraineur</p>
                        <p class="idCard-subTitle">{{$coach->name}}</p>
                        <p class="idCard-phone">{{$coach->phone}}</p>
                        <p class="idCard-mail">{{$coach->email}}</p>
                    </div>
                    <p class="idCard-link">Plus d'infos</p>
                </a>
                @if($assistant != null)
                    <a class="idCard" href="/userz/{{$assistant->id}}" title="Voir le profil de {{$assistant->name}}">
                        <img src="{{$assistant->src}}" srcset="{{$assistant->srcset}}" alt="photo de profil" class="idCard-photo">
                        <div class="idCard-content">
                            <p class="idCard-title">Assistant</p>
                            <p class="idCard-subTitle">{{$assistant->name}}</p>
                            <p class="idCard-phone">{{$assistant->phone}}</p>
                            <p class="idCard-mail">{{$assistant->email}}</p>
                        </div>
                        <p class="idCard-link">Plus d'infos</p>
                    </a>
                @endif
                <div class="practices">
                    <table class="table">
                        <caption class="table-title">Entrainements</caption>
                        <tbody class="table-body">
                            <tr class="table-row">
                                <th class="table-data table-head-data">Jour</th>
                                <th class="table-data table-head-data">Heure</th>
                                <th class="table-data table-head-data">Salle</th>
                            </tr>
                            @foreach($practices as $practice)
                                <tr class="table-row">
                                    <td class="table-data">{{$practice->day}}</td>
                                    <td class="table-data">{{$practice->time}}</td>
                                    <td class="table-data">{{$practice->location}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section-col">
                <table class="table table-linked">
                    <caption class="table-title">Joueurs</caption>
                    <tbody class="table-body">
                        @foreach($players as $player)
                            <tr class="table-row">
                                <td class="table-data table-head-data"><a class="table-link" href="/user/{{$player->id}}" title="Voir le profil de {{$player->name}}">{{$player->name}}<span class="table-more table-more-infos">Plus d'infos</span></a></td>
                                <td class="table-data">N° {{$player->jersey_nbr}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-galery"></span>L'équipe en image</h2>
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

