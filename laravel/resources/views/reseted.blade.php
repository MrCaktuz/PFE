@extends('partials.layout')
@section('content')

<div class="container">
    <div class="title">
        <h1>Bienvenu {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
    </div>
    <div class="box box--succes">
    	<p>Votre mot de passe à bien été mis à jours !</p>
    </div>
</div>

@endsection

