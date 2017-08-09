
<div class="nav" role="navigation">
	<a class="logo" href="/" title="Retour à l'accueil">Logo</a>
	<div class="burgerButton">
		<a class="" href="#" title="Ouvrir le menu">
			Menu
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
	</div>
	<nav>
		<ul class="nav-menu">
			<li class="nav-item{{ Request::is('/') ? ' active' : '' }}">
				<a class="" href="/" title="Retour à l'accueil">Accueil</a>
			</li>
			<li class="nav-item">
				<a class="dropdown" href="#" title="Voir les liens de la rubrique club">Club</a>
				<div class="sub-nav">
	                <ul class="sub-nav-group">
	                    <li class="sub-nav-item{{Request::is('conseil-administration') ? ' active' : ''}}">
	                    	<a class="icon icon-admin" href="/conseil-administration" title="Voir notre conseil d'administration">Administration</a>
	                    </li>
	                    <li class="sub-nav-item{{Request::is('entraineurs') ? ' active' : ''}}">
	                    	<a class="icon icon-trainer" href="/entraineurs" title="Voir nos entraineur">Entraineurs</a>
	                    </li>
	                    <li class="sub-nav-item{{Request::is('/equipes') ? ' active' : ''}}">
	                    	<a class="icon icon-team" href="/equipes" title="Voir nos équipes">Équipes</a>
	                    </li>
	                    <li class="sub-nav-item{{Request::is('/regles') ? ' active' : ''}}">
	                    	<a class="icon icon-rule" href="/regles" title="Voir notre règlement">Règlement</a>
	                    </li>
	                </ul>
	            </div>
			</li>
			<li class="nav-item{{Request::is('calendrier') ? ' active' : ''}}">
				<a class="" href="/calendrier" title="Voir notre calendrier">Calendrier</a>
			</li>

			<li class="nav-item">
				<a class="dropdown" href="#" title="Voir les liens de la rubrique multimédia">Multimédia</a>
				<div class="sub-nav">
	                <ul class="sub-nav-group">
	                    <li class="sub-nav-item{{Request::is('albums') ? ' active' : ''}}">
	                    	<a class="icon icon-album" href="/albums" title="Voir nos albums photo">Albums&nbsp;photo</a>
	                    </li>
	                    <li class="sub-nav-item{{Request::is('telechargements') ? ' active' : ''}}">
	                    	<a class="icon icon-download" href="/telechargements" title="Voir nos fichiers à télécharger">Téléchargements</a>
	                    </li>
	                </ul>
	            </div>
			</li>
			<li class="nav-item{{ Request::is('complexe') ? ' active' : '' }}">
				<a class="" href="/complexe" title="Voir notre complexe sportif">Complexe</a>
			</li>
			@if (Auth::check())
				@foreach( Auth::user()->roles as $role )
					@if( $role->title == "Entraineur" )
						<li class="nav-item{{ Request::is('coaching') ? ' active' : '' }}">
							<a class="" href="/coaching" title="Voir la page réservé au coach">Coaching</a>
						</li>
					@endif
				@endforeach
			@endif
			<li class="nav-item{{ Request::is('contact') ? ' active' : '' }}">
				<a class="" href="/contact" title="Nous contacter">Contact</a>
			</li>
			@if (Auth::guest())
				<li class="nav-item nav-item-footer nav-item-auth">
					<a class="icon icon-login" href="/login" title="Se connecter">Se&nbsp;connecter</a>
				</li>
			@else
				<?php
					$userID = Auth::user()->id;
					$userRequest = '/user/'.$userID;
				?>
				<li class="nav-item nav-item-auth">
					<a class="dropdown" href="#" title="Voir les liens de la rubrique profil">{{ Auth::user()->shortName( Auth::user() ) }}</a>
					<div class="sub-nav">
		                <ul class="sub-nav-group">
		                    <li class="sub-nav-item{{ Request::is('user/*') ? ' active' : '' }}">
		                    	<a class="icon icon-profil" href="{{$userRequest}}" title="Voir mon profil">Mon&nbsp;profil</a>
		                    </li>
		                    <li class="sub-nav-item nav-item-footer nav-item-footer-logout">
		                    	<a class="icon icon-logout" href="/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Se déconnecter">Se&nbsp;Déconnecter</a>
		                    	<form id="logout-form" action="/logout" method="POST" style="display: none;">
		                        	{{ csrf_field() }}
		                        </form>
		                    </li>
		                </ul>
		            </div>
				</li>
			@endif
		</ul>
	</nav>
</div>