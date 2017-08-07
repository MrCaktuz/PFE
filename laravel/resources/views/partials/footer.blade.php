    <footer class="footer">
    	<div class="footer-wrap">
    		<div class="footer-contact" itemscope itemtype="https://schema.org/Organization">
	    		<a class="footer-bloc footer-info footer-info-address" href="https://www.google.be/maps/place/Rue+Saint-Quentin+10,+5590+Ciney/@50.2993422,5.0960162,17z/data=!3m1!4b1!4m5!3m4!1s0x47c1b9e9c372d78b:0x81fa797516745527!8m2!3d50.2993422!4d5.0982049" target="_blanc" title="Voir notre google map" itemscope itemtype="https://schema.org/PostalAddress" itemprop="address">
		    		<p class="footer-info-line"><span itemprop="streetAddress">{{$addressStreet}}</span>, <span itemprop="postOfficeBoxNumber">{{$addressNumber}}</span></p>
		       		<p class="footer-info-line"><span itemprop="postalCode">{{$addressPostalCode}}</span> <span itemprop="addressLocality">{{$addressCity}}</span></p>
		    	</a>
				<a class="footer-logo" href="/" title="Retour à l'accueil">Logo</a>
				<div class="footer-bloc">
					<p class="footer-info-line"><a class="footer-info footer-info-mail" href="mailto:{{$contactEmail}}?cc={{$contactCC}}" itemprop="email">{{$contactEmail}}</a></p>
					<p class="footer-info-line"><a class="footer-info footer-info-facebook" href="{{$facebook}}" target="_blanc" title="Notre page facebook">Nous suivre</a></p>
				</div>
	    	</div>
	    	<small class="footer-copy">&copy; RBC Ciney 2017 - Tous droits réservés<span class="signature">Site réalisé par <a class="signature-link" href="http://www.mathieuclaessens.be" target="_blank">Mathieu Claessens</a></span></small>
    	</div>
    </footer>