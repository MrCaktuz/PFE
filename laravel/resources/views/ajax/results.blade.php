@foreach($results as $result)
    <div class="resultCard">
        <div class="resultCard-header">
            <div class="resultCard-title">
                <p>{{$result->team_id}}</p>
            </div>
            <div class="resultCard-sub-title">
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
{{ $results->links() }}