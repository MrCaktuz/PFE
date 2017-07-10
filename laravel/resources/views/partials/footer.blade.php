    <footer class="footer">
    	<div class="footer__wrap">
    		<div class="footer__contact" itemscope itemtype="https://schema.org/Organization">
	    		<a class="footer__bloc footer__info footer__info--address" href="/contact" title="Voir notre google map" itemscope itemtype="https://schema.org/PostalAddress" itemprop="address">
		    		<p class="footer__info--line"><span itemprop="streetAddress">{{$addressStreet}}</span>, <span itemprop="postOfficeBoxNumber">{{$addressNumber}}</span></p>
		       		<p class="footer__info--line"><span itemprop="postalCode">{{$addressPostalCode}}</span> <span itemprop="addressLocality">{{$addressCity}}</span></p>
		    	</a>
				<a class="footer__logo" href="/" title="Retour à l'accueil">Logo</a>
				<div class="footer__bloc">
					<p class="footer__info--line"><a class="footer__info footer__info--mail" href="mailto:{{$contactEmail}}?cc={{$contactCC}}" itemprop="email">{{$contactEmail}}</a></p>
					<p class="footer__info--line"><a class="footer__info footer__info--facebook" href="{{$facebook}}" target="_blanc" title="Notre page facebook">Nous suivre</a></p>
				</div>
	    	</div>
	    	<small class="footer__copy">&copy; RBC Ciney 2017 - Tous droits réservés<span class="signature">Site réalisé par <a class="signature__link" href="http://www.mathieuclaessens.be" target="_blank">Mathieu Claessens</a></span></small>
    	</div>
    </footer>