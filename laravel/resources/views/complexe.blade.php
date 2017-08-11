@extends('partials.layout')
@section('content')

<div class="container">
    <div class="section">
        <h1 class="section-title"><span class="section-icon section-icon-complexe"></span>Notre complexe sportif</h1>
        <div class="section-content complexe">
			<div class="complexe-intro section-intro">
				<p>{{$intro}}</p>
				<div class="box">
					<p>{{$details}}</p>
					<div class="button-wrap button-wrap-center">
						<a href="mailto:{{$contactEmail}}?cc={{$contactCC}}" class="button button-primary">Réserver maintenant</a>
					</div>
				</div>
			</div>
			<div class="complexe-tables">
				<div class="complexe-hourRent">
		            <table class="table table-rent">
		                <caption class="table-title">Location à l'heure</caption>
		                <tbody class="table-body">
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$hr_small->name}}</td>
		                        <td class="table-data">{{$hr_small->value}} €</td>
		                    </tr>
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$hr_big->name}}</td>
		                        <td class="table-data">{{$hr_big->value}} €</td>
		                    </tr>
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$hr_bar->name}}</td>
		                        <td class="table-data">{{$hr_bar->value}} €</td>
		                    </tr>
		                </tbody>
		            </table>
		        </div>
		        <div class="complexe-dayRent">
		            <table class="table table-rent">
		                <caption class="table-title">Location à la journée</caption>
		                <tbody class="table-body">
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$dr_small->name}}</td>
		                        <td class="table-data">{{$dr_small->value}} €</td>
		                    </tr>
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$dr_big->name}}</td>
		                        <td class="table-data">{{$dr_big->value}} €</td>
		                    </tr>
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$dr_bar->name}}</td>
		                        <td class="table-data">{{$dr_bar->value}} €</td>
		                    </tr>
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$dr_bar_funeral->name}}</td>
		                        <td class="table-data">{{$dr_bar_funeral->value}} €</td>
		                    </tr>
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$dr_bar_kitchen->name}}</td>
		                        <td class="table-data">{{$dr_bar_kitchen->value}} €</td>
		                    </tr>
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$dr_bar_kitchen_small->name}}</td>
		                        <td class="table-data">{{$dr_bar_kitchen_small->value}} €</td>
		                    </tr>
		                    <tr class="table-row">
		                        <td class="table-data table-head-data">{{$dr_bar_kitchen_private->name}}</td>
		                        <td class="table-data">{{$dr_bar_kitchen_private->value}} €</td>
		                    </tr>
		                </tbody>
		            </table>
		        </div>
			</div>
			<div class="complexe-album">
				<div class="complexe-album-flex">
	        		<?php $i = 1; ?>
			        @foreach($albumComplexe->photos as $photo)
	                    <a class="complexe-photo" href="/{{$photo[0]}}" data-lightbox="complexe sportif" title="Agrandir l'image">
				            <img  src="{{URL::to('/').'/'.$photo[0]}}" srcset="{{URL::to('/').'/'.$photo[1]}}" alt="photo {{$i}} du complexe sportif">
				            <?php $i++ ?>
				        </a>
			        @endforeach
		        </div>
        	</div>
        </div>
    </div>
    <div class="gmap" id="gmap">
        <a href="https://www.google.be/maps/place/Rue+Saint-Quentin+10,+5590+Ciney/@50.2993422,5.0960162,17z/data=!3m1!4b1!4m5!3m4!1s0x47c1b9e9c372d78b:0x81fa797516745527!8m2!3d50.2993422!4d5.0982049" class="gmap-link" title="Lien vers la google map" target="_blanc">
            <img src="/img/gmap.jpg" srcset="/img/gmap_1280.jpg 1280w, /img/gmap_980.jpg 980w, /img/gmap_768.jpg 768w, /img/gmap_640.jpg 640w, /img/gmap_480.jpg 480w, /img/gmap_320.jpg 320w, " alt="Photo de la Google map">
        </a>
    </div>
</div>

@endsection

