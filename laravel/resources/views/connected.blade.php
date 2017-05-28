@extends('partials.layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Bienvenu {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

