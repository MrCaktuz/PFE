@extends ( 'partials.layout' )

@section ( 'content' )
	<h1>Profil</h1>
	<h2>{{ $user -> first_name }} {{ $user -> last_name }}</h2>
	<p>{{ $user -> birth_date }}</p>
	<p></p>
	<ul>
		@foreach ( $user->roles as $role )
			<li>{{ $role->title }}</li>
		@endforeach
	</ul>
@endsection