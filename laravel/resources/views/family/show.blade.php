<?php $validated = 0 ?>
@foreach( Auth::user()->roles as $role )
    @if( $role->title == "AdminAll" )
        <?php $validated = 1 ?>
    @endif
@endforeach

@extends ( 'partials.layoutAdmin' )

@section ( 'content' )
    @if( !$validated )
        @include( 'partials.accessDenied' )
	@else
	<div class="jumbotron">
		<h1 class="text-center">Fiche famille&nbsp;: {{ $familyName }}</h1>
	</div>
		<div class="container">
			<div class="row col-md-5">
				<div class="col-md-12">
			        <div class="panel panel-primary">
			            <div class="panel-heading panel-primary">
							<h2 class="panel-title">Chef de famille</h2>
			            </div>
			            <div class="list-group">
							@foreach( $familyMembers as $familyMember )
							@if( $familyMember->family_chef )
								<a class="list-group-item" href="/admin/user/{{ $familyMember->id }}">{{ $familyMember->first_name }} {{ $familyMember->last_name }}</a>
							@endif
							@endforeach
						</div>
			        </div>
			    </div>
				<div class="col-md-12">
			        <div class="panel panel-primary">
			            <div class="panel-heading panel-primary">
							<h2 class="panel-title">Membres</h2>
			            </div>
			            <ul class="list-group">
							@foreach( $familyMembers as $familyMember )
								<li>
									<a  class="list-group-item" href="/admin/user/{{ $familyMember->id }}">{{ $familyMember->first_name }} {{ $familyMember->last_name }}</a>
								</li>
							@endforeach
						</ul>
			        </div>
			    </div>
			</div>
		</div>
	@endif
@endsection