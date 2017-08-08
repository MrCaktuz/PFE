@extends('partials.layout')
@section('content')

<div class="container">
    <div class="section">
        <h1 class="section-title"><span class="section-icon section-icon-galery"></span>{{$album->name}}</h1>
        <div class="section-content album-wrap">

        <?php $i = 1; ?>
        @foreach($album->photos as $photo)
            <img class="album-photo" src="{{URL::to('/').'/'.$photo[0]}}" srcset="{{URL::to('/').'/'.$photo[1]}}" alt="photo {{$i}} de l'album {{$album->name}}">
            <?php $i++ ?>
        @endforeach
        </div>
    </div>
</div>

@endsection

