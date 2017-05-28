<div class="box feedback">
    <div class="feedback__content">
        <p>Désolé {{ Auth::user()->first_name }}, vous n'avez pas le droit de vous trouver ici.</p>
        <p>Cette partie du site est réservé aux administrateurs.</p>
    </div>
    <div class="button__wrap button__wrap--center">
        <a class="button button--primary" href="/" title="Retour à la page d'accueil">Retour à l'accueil</a>
        <a class="button button--secondary "href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Se déconnecter" >
            Se&nbsp;déconnecter
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>