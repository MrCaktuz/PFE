@extends('partials.layout')
@section('content')

<div class="container">
    <div class="section">
        <h1 class="section-title"><span class="section-icon section-icon-galery"></span>{{$album->name}}</h1>
        <div class="section-content album-wrap">
            <div class="masonry">
                <?php $i = 1; ?>
                @foreach($album->photos as $photo)
                    <a href="/{{$photo[0]}}" data-lightbox="{{$album->name}}" title="Agrandir l'image">
                        <img class="album-photo masonry-item" src="{{URL::to('/').'/'.$photo[0]}}" srcset="{{URL::to('/').'/'.$photo[1]}}" alt="photo {{$i}} de l'album {{$album->name}}">
                        <?php $i++ ?>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

