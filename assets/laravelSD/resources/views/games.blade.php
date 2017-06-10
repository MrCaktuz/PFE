{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('division', 'Division:') !!}
			{!! Form::text('division') !!}
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
			{!! Form::label('time', 'Time:') !!}
			{!! Form::text('time') !!}
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
			{!! Form::label('day_id', 'Day_id:') !!}
			{!! Form::text('day_id') !!}
		</li>
		<li>
			{!! Form::label('location', 'Location:') !!}
			{!! Form::text('location') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}