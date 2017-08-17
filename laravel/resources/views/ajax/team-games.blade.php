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
{{ $games->links() }}