@extends ( 'partials.layout' )

@section ( 'content' )
	<h2> Bonjour {{ $user -> first_name }}</h2>
@endsection