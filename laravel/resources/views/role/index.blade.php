@extends ( 'partials.layout' )

@section ( 'content' )
		<h2> Roles :</h2>
		<ul>
			@foreach ( $roles as $role )
				<li>
					{{ $role -> title }}
				</li>
			@endforeach
		</ul>
@endsection