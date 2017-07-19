@extends('partials.layout')
@section('content')

<h1 class="sr-only">Conseil d'administration et assistants</h1>
<div class="container">
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-ca"></span>Notre conseil d'administration</h2>
        <div class="section-content">
            <div class="section-intro">
                <p>{{$sloganCA}}</p>
            </div>
            <div class="flex-wrap">
                @foreach($membersCA as $member)
                    <a class="idCard" href="/user/{{$member->user_id}}" title="Voir le profil de {{$member->name}}">
                        <img src="{{$member->photo}}" alt="photo de profil" class="idCard-photo">
                        <div class="idCard-content">
                            <p class="idCard-title">{{$member->name}}</p>
                            <p class="idCard-subTitle"><?php echo (count($member->roles) <= 1) ? 'Role :' : 'Roles :'; ?></p>
                            <ul class="idCard-roles">
                                @foreach($member->roles as $role)
                                    <li class="idCard-role">{{$role->title}}</li>
                                @endforeach
                            </ul>
                            <p class="idCard-phone">{{$member->phone}}</p>
                            <p class="idCard-mail">{{$member->email}}</p>
                        </div>
                        <p class="idCard-link">Plus d'infos</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-ca"></span>Nos assistants C.A.</h2>
        <div class="section-content">
            <div class="section-intro">
                <p>{{$sloganACA}}</p>
            </div>
            <div class="flex-wrap">
                @foreach($membersACA as $member)
                    <a class="idCard" href="/user/{{$member->user_id}}" title="Voir le profil de {{$member->name}}">
                        <img src="{{$member->photo}}" alt="photo de profil" class="idCard-photo">
                        <div class="idCard-content">
                            <p class="idCard-title">{{$member->name}}</p>
                            <p class="idCard-subTitle"><?php echo (count($member->roles) <= 1) ? 'Role :' : 'Roles :'; ?></p>
                            <ul class="idCard-roles">
                                @foreach($member->roles as $role)
                                    <li class="idCard-role">{{$role->title}}</li>
                                @endforeach
                            </ul>
                            <p class="idCard-phone">{{$member->phone}}</p>
                            <p class="idCard-mail">{{$member->email}}</p>
                        </div>
                        <p class="idCard-link">Plus d'infos</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</div>

@endsection

