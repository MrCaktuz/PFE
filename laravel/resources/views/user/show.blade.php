@extends('partials.layout')
@section('content')

<h1 class="sr-only">Profil</h1>
<div class="container">
    <section class="section">
    	<?php if(Auth::user()->id == $user->id) {
    		$validated = true;
    	} else {
    		$validated = false;
    	} ?>
        <h2 class="section-title"><span class="section-icon section-icon-profil"></span><?php echo $validated ? 'Mon profil' : 'Profil'; ?></h2>
        <div class="section-content profil">
        	<div class="profil-head">
        		<p class="profil-name">{{$user->name}}</p>
        		<p class="profil-birth profil-data">{{$user->birthday}}</p>
        	</div>
        	<div class="profil-photo">
	        	<img src="{{$user->src}}" srcset="{{$user->srcset}}" alt="">
		    	<?php if($validated) : ?>
					<a href="/user/{{$user->id}}/edit" class="profil-edit button button-primary">Modifier mon profil</a>
		    	<?php endif; ?>
        	</div>
        	<div class="profil-body">
	        	<?php if($user->phone) : ?>
		        	<div class="profil-sub-section">
		        		<h3 class="profil-sub-title">Téléphone</h3>
		        		<p class="profil-data">{{$user->phone}}</p>
		        	</div>
		    	<?php endif; ?>
	        	<div class="profil-sub-section">
	        		<h3 class="profil-sub-title">E-mail</h3>
	        		<p class="profil-data">{{$user->email}}</p>
	        	</div>
	        	<?php if($validated) : ?>
	        		<div class="profil-sub-section">
		        		<h3 class="profil-sub-title">Adresse</h3>
		        		<p class="profil-data">{{$user->address}}</p>
		        		<p class="profil-data">{{$user->postal_code}} - {{$user->city}}</p>
		        	</div>
		    	<?php endif; ?>
				<?php if($validated) : ?>	        	
			    	<div class="profil-sub-section">
		        		<h3 class="profil-sub-title">Famille</h3>
		        		<p class="profil-data">{{$user->family}}</p>
		        	</div>
		    	<?php endif; ?>
	        	<?php if(count($user->roles) > 0) : ?>
		        	<div class="profil-sub-section">
		        		<h3 class="profil-sub-title">Roles dans le club</h3>
		        		<ul class="profil-list">
			        		@foreach($user->roles as $role)
			        			<p class="profil-data profil-list-elt">{{$role->title}}</p>
			        		@endforeach
			        	</ul>
		        	</div>
		    	<?php endif; ?>
	        	<?php if(count($user->teams) > 0) : ?>
	        		<div class="profil-sub-section">
		        		<h3 class="profil-sub-title"><?php echo count($user->teams) > 1 ? 'Équipes entrainées' : 'Équipe entrainée'; ?></h3>
		        		<ul class="profil-list">
			        		@foreach($user->teams as $team)
			        			<li class="profil-data profil-list-elt">{{$team->division}}</li>
			        		@endforeach
			        	</ul>
		        	</div>
		    	<?php endif; ?>
		    </div>
        </div>
    </section>
</div>

@endsection

