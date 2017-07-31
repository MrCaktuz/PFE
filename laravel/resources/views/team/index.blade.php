@extends('partials.layout')
@section('content')

<div class="container">
    <section class="section">
        <h1 class="section-title"><span class="section-icon section-icon-team"></span>Découvrez nos équipes</h1>
        <h2 class="section-sub-title">Saison {{$currentSeason}}</h2>
        <div class="section-content flex-wrap">
            @foreach($teams as $team)
                <div class="albumCard-wrap">
                    <a class="albumCard" href="/equipes/{{$team->id}}" title="Accéder à la page dédié à l'équipe {{$team->division}} de la saison {{$team->season}}">
                        <img class="albumCard-img" src="{{$team->src}}" srcset="{{$team->srcset}}" alt="{{$team->division}}">
                        <h3 class="albumCard-title">{{$team->division}}</h3>
                    </a>
                    <div class="albumCard-link">
                        <p>Voir l'équipe<span class="icon-link"></span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

@endsection

