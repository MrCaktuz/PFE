{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('team_id', 'Team_id:') !!}
			{!! Form::text('team_id') !!}
		</li>
		<li>
			{!! Form::label('game_id', 'Game_id:') !!}
			{!! Form::text('game_id') !!}
		</li>
		<li>
			{!! Form::label('date', 'Date:') !!}
			{!! Form::text('date') !!}
		</li>
		<li>
			{!! Form::label('appointment', 'Appointment:') !!}
			{!! Form::text('appointment') !!}
		</li>
		<li>
			{!! Form::label('host', 'Host:') !!}
			{!! Form::text('host') !!}
		</li>
		<li>
			{!! Form::label('visitor', 'Visitor:') !!}
			{!! Form::text('visitor') !!}
		</li>
		<li>
			{!! Form::label('score', 'Score:') !!}
			{!! Form::text('score') !!}
		</li>
		<li>
			{!! Form::label('duty', 'Duty:') !!}
			{!! Form::text('duty') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}