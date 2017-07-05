@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Import de plusieurs matchs
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="http://rbcciney.dev/admin/game" class="text-capitalize">Matchs</a></li>
	    <li class="active">Import</li>
	  </ol>
	</section>
@endsection

@section('content')
	{{-- @if ($crud->hasAccess('list'))
		<a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
	@endif --}}

	<!-- Default box -->
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<a href="http://rbcciney.dev/admin/game"><i class="fa fa-angle-double-left"></i> Retour à la liste <span>matchs</span></a><br>
			<form action="{{ URL::to('admin/importExcel') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="box">
				    <div class="box-header with-border">
				    	<h3 class="box-title">
			            	Import des matchs via un fichier Excel
			        	</h3>
				    </div>
				    <div class="box-body">
						<div class="form-group col-md-12">
						    <label>Fichier Excel</label>
							<input type="file" id="file_file_input" name="import_file" value="" class="form-control" >
						</div>
				    </div><!-- /.box-body -->
				    <div class="box-footer">
						<div id="saveActions" class="form-group">
							<input type="hidden" name="save_action" value="save_and_back">
							<div class="btn-group">
						        <button type="submit" class="btn btn-success">
						            <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
						            <span data-value="save_and_back">Enregistrer et retour</span>
						        </button>
				    		</div>
	    					<a href="http://rbcciney.dev/admin/game" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Annuler</a>
						</div>
			    </div><!-- /.box-footer-->
				</div><!-- /.box -->
			</form>
		</div><!-- /.col -->
	</div><!-- /.row -->

@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/show.css') }}">
@endsection

@section('after_scripts')
	<script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
	<script src="{{ asset('vendor/backpack/crud/js/show.js') }}"></script>
@endsection