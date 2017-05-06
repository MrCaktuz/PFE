@extends ( 'partials.layout' )

@section ( 'content' )
		<h2> Bonjour à vous :</h2>
		<ul>
			@foreach( $users as $user )
				<li>
					<p>{{ $user -> first_name }}&nbsp;<small>{{ $user -> last_name }}</small></p>
				</li>
			@endforeach
		</ul>
@endsection