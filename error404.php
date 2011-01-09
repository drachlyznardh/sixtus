<?php

	$m->mkpage('404 Not Found', 'There is no such file here');

	function mkpage ($d) {
?>
<div class="small">
	<div class="section">
		<h2>
			404 Not Found
		</h2><p>
			La pagina che stai cercando non esiste su questo server.
		</p><p>
			Forse l'URL che hai inserito non è corretto, prova a correggerlo. Se sei
			giunto qui seguendo un link interno, allora la colpa potrebbe essere
			mia: segnalamelo scrivendomi all'indirizzo
		</p><div class="outside"><p>
			&lt;ivanDOTsimoniniATroundhousecodeDOTcom&gt;
		</p></div><p>
			Grazie.
		</p><p>
			Se sei finito qui intenzionalmente, benvenuto. Ora puoi anche <a
			href="http://4chan.org/b/">andartene</a>.
		</p>
	</div>
</div>

<?php } ?>
