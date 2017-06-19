@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        Admninistration du site du RBC Ciney
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        @if ( Auth::user()->hasRole('Web Developer') || Auth::user()->hasRole('Web Master') || Auth::user()->hasRole('Web Communication') )
          <div class="jumbotron content-header">
            <h2 class="text-center">Bienvenu {{ Auth::user()->name }},</h2>
            <p class="text-center">C'est ici que vous pouvez gérer le contenu du site du Royal Basket Club de Ciney.</p>
          </div>
        @else
          <div class="jumbotron content-header">
            <h2 class="text-center">Bonjour {{ Auth::user()->name }},</h2>
            <p class="text-center col-md-8 col-md-offset-2">L'accès à cette partie du site du Royal Basket Club de Ciney vous est refusé. Je vous propose de retourner à la page d'accueil ou vous connecter avec un compte administrateur.</p>
            <p class="text-center col-md-8 col-md-offset-2">
              <a class="btn btn-primary" href="/"><i class="fa fa-home"></i> <span>Accueil</span></a></li>
              <a class="btn" href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
            </p>
          </div>
        @endif
    </div>
@endsection
