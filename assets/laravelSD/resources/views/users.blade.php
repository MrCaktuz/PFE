{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('civility', 'Civility:') !!}
			{!! Form::text('civility') !!}
		</li>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
		</li>
		<li>
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email') !!}
		</li>
		<li>
			{!! Form::label('birthday', 'Birthday:') !!}
			{!! Form::text('birthday') !!}
		</li>
		<li>
			{!! Form::label('birth_location', 'Birth_location:') !!}
			{!! Form::text('birth_location') !!}
		</li>
		<li>
			{!! Form::label('password', 'Password:') !!}
			{!! Form::text('password') !!}
		</li>
		<li>
			{!! Form::label('phone', 'Phone:') !!}
			{!! Form::text('phone') !!}
		</li>
		<li>
			{!! Form::label('national_id', 'National_id:') !!}
			{!! Form::text('national_id') !!}
		</li>
		<li>
			{!! Form::label('photo', 'Photo:') !!}
			{!! Form::text('photo') !!}
		</li>
		<li>
			{!! Form::label('job', 'Job:') !!}
			{!! Form::text('job') !!}
		</li>
		<li>
			{!! Form::label('address', 'Address:') !!}
			{!! Form::text('address') !!}
		</li>
		<li>
			{!! Form::label('postal_code', 'Postal_code:') !!}
			{!! Form::text('postal_code') !!}
		</li>
		<li>
			{!! Form::label('city', 'City:') !!}
			{!! Form::text('city') !!}
		</li>
		<li>
			{!! Form::label('family_id', 'Family_id:') !!}
			{!! Form::text('family_id') !!}
		</li>
		<li>
			{!! Form::label('jersey_nbr', 'Jersey_nbr:') !!}
			{!! Form::text('jersey_nbr') !!}
		</li>
		<li>
			{!! Form::label('remember_token', 'Remember_token:') !!}
			{!! Form::text('remember_token') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}