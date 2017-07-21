@extends('partials.layout')
@section('content')

<div class="container">
    <div class="section">
        <h1 class="section-title"><span class="section-icon section-icon-rule"></span>Notre règlement</h1>
        <div class="section-content flex-wrap flex-reverse">
            <div class="inner-nav" role="navigation">
                <h2 class="inner-nav-title">Navigation</h2>
                <ul class="inner-nav-list">
                    @foreach($rules as $rule)
                        <li class="inner-nav-item">
                            <a class="inner-nav-link" href="#rule-{{$rule->id}}" title="Saut de page jusqu'à la section {{'"'.$rule->title.'"'}}">{{$rule->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="rules">
                @foreach($rules as $rule)
                    <article class="rule" id="rule-{{$rule->id}}">
                        <h2 class="rule-title">{{$rule->title}}</h2>
                        <div class="rule-body">
                            {!!$rule->body!!}
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
