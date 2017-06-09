{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('division', 'Division:') !!}
			{!! Form::text('division') !!}
		</li>
		<li>
			{!! Form::label('coach_id', 'Coach_id:') !!}
			{!! Form::text('coach_id') !!}
		</li>
		<li>
			{!! Form::label('assistant_id', 'Assistant_id:') !!}
			{!! Form::text('assistant_id') !!}
		</li>
		<li>
			{!! Form::label('season', 'Season:') !!}
			{!! Form::text('season') !!}
		</li>
		<li>
			{!! Form::label('photo', 'Photo:') !!}
			{!! Form::text('photo') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}