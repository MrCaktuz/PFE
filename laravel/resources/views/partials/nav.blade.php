<div class="mainNav" role="navigation">
	<a class="mainNav__link mainNav__link--logo" href="/" title="Retour à l'accueil">Logo</a>
	<div class="mainNav__burgerButton" title="Ouvrir le menu">
		Menu
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</div>
	<ul class="mainNav__list">
		<li class="mainNav__elt{{ Request::is('/') ? ' active' : '' }}">
			<a class="mainNav__link" href="/" title="Retour à l'accueil">
				Accueil
			</a>
		</li>
		<li class="mainNav__elt mainNav__dropdown{{ Request::is('/conseil') || Request::is('/trainer') || Request::is('/team') || Request::is('/rules') ? ' active' : '' }}">
				<span class="mainNav__dropdownButton">Club</span>
				<ul class="mainNav__subList mainNav__subList--club">
					<li class="mainNav__elt">
						<a href="/conseil" title="Voir notre conseil d'administration" class="mainNav__link mainNav__link--admin">
							Administration
						</a>
					</li>
					<li class="mainNav__elt">
						<a href="/trainer" title="Voir nos entraineur" class="mainNav__link mainNav__link--trainer">
							Entraineur
						</a>
					</li>
					<li class="mainNav__elt">
						<a href="/team" title="Voir nos équipes" class="mainNav__link mainNav__link--team">
							Équipes
						</a>
					</li>
					<li class="mainNav__elt">
						<a href="/rules" title="Voir notre règlement" class="mainNav__link mainNav__link--rule">
							Règlement
						</a>
					</li>
				</ul>
		</li>
		<li class="mainNav__elt{{ Request::is('/calendar') ? ' active' : '' }}">
			<a class="mainNav__link " href="/calendar" title="Voir notre calendrier">
				Calendrier
			</a>
		</li>
		<li class="mainNav__elt mainNav__dropdown{{ Request::is('/album') || Request::is('/download') ? ' active' : '' }}">
			<span class="mainNav__dropdownButton">Multimédia</span>
			<ul class="mainNav__subList mainNav__subList--multimedia">
				<li class="mainNav__elt">
					<a href="/album" title="Voir nos albums photo" class="mainNav__link mainNav__link--album">
						Albums&nbsp;photo
					</a>
				</li>
				<li class="mainNav__elt">
					<a href="/download" title="Voir nos fichier à télécharger" class="mainNav__link mainNav__link--download">
						Téléchargements
					</a>
				</li>
			</ul>
		</li>
		<li class="mainNav__elt{{ Request::is('/calendar') ? ' active' : '' }}">
			<a class="mainNav__link " href="/complexe" title="Voir notre complexe sportif">
				Complexe
			</a>
		</li>
		@if (Auth::check())
			@foreach( Auth::user()->roles as $role )
				@if( $role->title == "Entraineur" )
					<li class="mainNav__elt{{ Request::is('/coach') ? ' active' : '' }}">
						<a class="mainNav__link " href="/coach" title="Voir la page réservé au coach">
							Coaching
						</a>
					</li>
				@endif
			@endforeach
		@endif
		<li class="mainNav__elt{{ Request::is('/contact') ? ' active' : '' }}">
			<a class="mainNav__link " href="/contact" title="Nous contacter">
				Contact
			</a>
		</li>
		@if (Auth::guest())
			<li class="mainNav__elt mainNav__elt--auth mainNav__elt--login">
				<a class="mainNav__link" href="/login" title="Se connecter">
					Se&nbsp;connecter
				</a>
			</li>
		@else
			<li class="mainNav__elt mainNav__elt--auth  mainNav__dropdown">
				<span class="mainNav__dropdownButton">{{ Auth::user()->first_name }}</span>
				<ul class="mainNav__subList mainNav__subList--auth mainNav__subList--multimedia">
					<li class="mainNav__elt">
						<a href="/users/{{ Auth::user()->id }}" title="Voir mon profil" class="mainNav__link mainNav__link--profil">
							Mon&nbsp;profil
						</a>
					</li>
					<li class="mainNav__elt">
						<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Se déconnecter" class="mainNav__link mainNav__link--logout">
							Se&nbsp;déconnecter
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        	{{ csrf_field() }}
                        </form>
					</li>
				</ul>
			</li>
		@endif
	</ul>
</div>
