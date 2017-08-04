@extends('partials.layout')
@section('content')

<h1 class="sr-only">Coaching</h1>
<div class="container">
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-coaching"></span>Espace coaching</h2>
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
    </section>
</div>

@endsection

