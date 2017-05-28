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
		<div class="col-md-2">
	        <div class="panel panel-primary">
	            <div class="panel-heading panel-primary">
					<h2 class="panel-title">Les familles du club</h2>
	            </div>
	            <ul class="list-group">
					@foreach( $families as $family )
						<li>
							<a  class="list-group-item" href="/admin/family/{{ $family->family_slug }}">{{ $family->family_name }}</a>
						</li>
					@endforeach
				</ul>
	        </div>
	    </div>
	@endif
@endsection