{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('url', 'Url:') !!}
			{!! Form::text('url') !!}
		</li>
		<li>
			{!! Form::label('album_id', 'Album_id:') !!}
			{!! Form::text('album_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}