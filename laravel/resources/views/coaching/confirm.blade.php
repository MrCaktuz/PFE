@extends('partials.layout')
@section('content')

<div class="container">
    <div class="section">
        <h1 class="section-title"><span class="section-icon section-icon-coaching"></span>Espace coaching</h1>
        <div class="section-content">
        	<div class="section-intro">
                <p>Êtes-vous sûr de vouloir supprimer le fichier "{{$coaching->title}}" ?</p>   
            </div>
            <form class="form form-center" action="/coaching/{{ $coaching -> id }}/destroy" method="POST">
                {{ method_field( 'DELETE' ) }}
                {{ csrf_field() }}
                <div class="button-wrap-center">
                    <button type="submit" class="button button-secondary">Supprimer</button>
                    <a class="button button-primary" href="/coaching">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

