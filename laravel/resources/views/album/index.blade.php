@extends('partials.layout')
@section('content')

<div class="container">
    <div class="section">
        <h1 class="section-title"><span class="section-icon section-icon-galery"></span>Nos ablums photos</h1>
        <h2 class="section-sub-title">Saison {{$currentSeason}}</h2>
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
    </div>
</div>

@endsection

