<?php $validated = 0 ?>
@foreach( Auth::user()->roles as $role )
    @if( $role->title == "AdminAll" )
        <?php $validated = 1 ?>
    @endif
@endforeach

@extends ( 'partials.layoutAdmin' )

@section ( 'content' )
    @if( !$validated )
    	<h1 class="sr-only">Accès non autorisé</h1>
        @include( 'partials.accessDenied' )
	@else

		<div class="jumbotron">
	    	<h1 class="text-center">Gestion des familles</h1>		
		</div>

		<div class="pageWrap">
			@include( 'partials.adminAside' )
	        <div class="col-sm-8">
	        	<div class="panel panel-primary">
		            <div class="panel-heading">
						<h2 class="panel-title">Liste des familles du club</h2>
		            </div>
		            <ul class="list-group">
						@foreach( $families as $family )
							<li class="list-group-item d-flex justify-between">
								<a class="list-group-item" title="Voir la liste des membres de la famille" href="/admin/family/{{ $family->family_slug }}">{{ $family->family_name }}</a>
							</li>
						@endforeach
					</ul>
		        </div>
	        </div>
		</div>
	@endif
@endsection