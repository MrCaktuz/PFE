{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title') !!}
		</li>
		<li>
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description') !!}
		</li>
		<li>
			{!! Form::label('author', 'Author:') !!}
			{!! Form::text('author') !!}
		</li>
		<li>
			{!! Form::label('site', 'Site:') !!}
			{!! Form::text('site') !!}
		</li>
		<li>
			{!! Form::label('file', 'File:') !!}
			{!! Form::text('file') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}