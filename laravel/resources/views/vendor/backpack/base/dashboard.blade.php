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
          <div class="col-md-10 col-md-offset-1">
            <?php $auth = Auth::user()->hasRole('Web Communication'); ?>
            <div class="panel panel-default <?php echo ($auth == 1) ? 'hidden' : 'col-md-4'; ?> col-sm-12">
              <div class="panel-body">
                Vous pouvez facilement ajouter, modifier, supprimer tous les matchs du club en un clic.
              </div>
              <div class="panel-body text-center">
                <a class="btn btn-primary col-md-12" href="/admin/game"><i class="fa fa-calendar"></i> <span>Gérer les matchs</span></a>
              </div>
            </div>
            <div class="panel panel-default <?php echo ($auth == 1) ? 'col-md-6' : 'col-md-4'; ?> col-sm-12">
              <div class="panel-body">
                Vous pouvez facilement ajouter, modifier, supprimer les événements du club en un clic.
              </div>
              <div class="panel-body text-center">
                <a class="btn btn-primary col-md-12" href=""><i class="fa fa-newspaper-o"></i> <span>Gérer les événements</span></a>
              </div>
            </div>
             <div class="panel panel-default <?php echo ($auth == 1) ? 'col-md-6' : 'col-md-4'; ?> col-sm-12">
              <div class="panel-body">
                Vous pouvez facilement ajouter, modifier, supprimer tous les albums du club en un clic.
              </div>
              <div class="panel-body text-center">
                <a class="btn btn-primary col-md-12" href="/admin/album"><i class="fa fa-image"></i> <span>Gérer les albums</span></a>
              </div>
            </div>
          </div>
        @else
          <div class="jumbotron content-header">
            <h2 class="text-center">Bonjour {{ Auth::user()->name }},</h2>
            <p class="text-center col-md-8 col-md-offset-2">L'accès à cette partie du site du Royal Basket Club de Ciney vous est refusé. Je vous propose de retourner à la page d'accueil ou de vous connecter avec un compte administrateur.</p>
            <p class="text-center col-md-8 col-md-offset-2">
              <a class="btn btn-primary" href="/"><i class="fa fa-home"></i> <span>Accueil</span></a></li>
              <a class="btn" href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
            </p>
          </div>
        @endif
    </div>
@endsection
