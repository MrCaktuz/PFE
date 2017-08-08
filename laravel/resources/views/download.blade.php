@extends('partials.layout')
@section('content')

<div class="container">
    <div class="section">
        <h1 class="section-title"><span class="section-icon section-icon-download"></span>Fichier à télécharger</h1>
        <div class="section-content">
	        <div class="section-intro">
                {!!$intro!!}
            </div>
        	<table class="table table-linked table-download">
                <caption class="table-title">Liste des fichiers</caption>
                <tbody class="table-body">
                    @foreach($files as $file)
                        <tr class="table-row">
                            <td class="table-data table-head-data"><a class="table-link" href="/telechargements/{{$file->id}}" title="Télécharger le fichier">{{$file->title}}<span class="table-more table-more-download">Télécherger</span></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

