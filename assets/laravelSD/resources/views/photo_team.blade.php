{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('photo_id', 'Photo_id:') !!}
			{!! Form::text('photo_id') !!}
		</li>
		<li>
			{!! Form::label('team_id', 'Team_id:') !!}
			{!! Form::text('team_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}