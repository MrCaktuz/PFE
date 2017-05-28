<?php $validated = 0 ?>
@foreach( Auth::user()->roles as $role )
    @if( $role->title == "AdminAll" )
        <?php $validated = 1 ?>
    @endif
@endforeach

@if( !$validated )
	<div class="mainNav" role="navigation">
		<a class="mainNav__link mainNav__link--logo mainNav__link--logoCenter" href="/" title="Retour à l'accueil">Logo</a>
	</div>
@else
	<div class="mainNav" role="navigation">
		<a class="mainNav__link mainNav__link--logo" href="/admin/" title="Retour à l'accueil de l'administration">Logo</a>
		<div class="mainNav__burgerButton" title="Ouvrir le menu">
			Menu
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</div>
		<ul class="mainNav__list">
			<li class="mainNav__elt">
				<a class="mainNav__link " href="/admin/family" title="Nous contacter">
					Familles
				</a>
			</li>
			<li class="mainNav__elt">
				<a class="mainNav__link" href="/admin/users" title="Retour à l'accueil">
					Utilisateurs
				</a>
			</li>
			<li class="mainNav__elt">
				<a class="mainNav__link " href="/admin/teams" title="Nous contacter">
					Équipes
				</a>
			</li>
			<li class="mainNav__elt">
				<a class="mainNav__link " href="/admin/games" title="Nous contacter">
					Matchs
				</a>
			</li>
			<li class="mainNav__elt">
				<a class="mainNav__link " href="/admin/events" title="Nous contacter">
					Albums photo
				</a>
			</li>
			<li class="mainNav__elt">
				<a class="mainNav__link " href="/admin/events" title="Nous contacter">
					Événements
				</a>
			</li>
			<li class="mainNav__elt mainNav__elt--auth mainNav__elt--logout">
				<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Se déconnecter" class="mainNav__link mainNav__link--logout">
					Se&nbsp;déconnecter
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            	{{ csrf_field() }}
	            </form>
			</li>
		</ul>
	</div>
@endif