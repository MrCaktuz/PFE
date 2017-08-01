@extends('partials.layout')
@section('content')

<h1 class="sr-only">Fichiers à télécharger</h1>
<div class="container">
    <section class="section">
        <h2 class="section-title"><span class="section-icon section-icon-download"></span>Fichier à télécharger</h2>
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
    </section>
</div>

@endsection

