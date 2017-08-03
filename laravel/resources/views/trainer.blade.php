@extends('partials.layout')
@section('content')

<div class="container">
    <section class="section">
        <h1 class="section-title"><span class="section-icon section-icon-trainer"></span>Nos entraineurs</h1>
        <div class="section-content">
            <div class="section-intro">
                {!!$intro!!}
            </div>
            <div class="flex-wrap">
                @foreach($trainers as $trainer)
                    <a class="idCard" href="/user/{{$trainer->id}}" title="Voir le profil de {{$trainer->name}}">
                        <img src="{{$trainer->src}}" srcset="{{$trainer->srcset}}" alt="photo de profil" class="idCard-photo">
                        <div class="idCard-content">
                            <p class="idCard-title">{{$trainer->name}}</p>
                            <p class="idCard-subTitle"><?php echo (count($trainer->teams) <= 1) ? 'Équipe :' : 'Équipes :'; ?></p>
                            <ul class="idCard-roles">
                                @foreach($trainer->teams as $team)
                                    <li class="idCard-role">{{$team->division}}</li>
                                @endforeach
                            </ul>
                            <p class="idCard-phone">{{$trainer->phone}}</p>
                            <p class="idCard-mail">{{$trainer->email}}</p>
                        </div>
                        <p class="idCard-link">Plus d'infos</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection

