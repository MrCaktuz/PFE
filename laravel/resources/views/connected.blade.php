@extends('partials.layout')
@section('content')

<div class="container">
    <div class="title">
        <h1>Bienvenu {{ Auth::user()->name }}</h1>
    </div>
</div>

@endsection

