<?php

	$title=array('404 Not Found','There is no such file here');

	function mkpage ($d) {
?>
<div class="small">
	<div class="section">
		<h2>
			404 Not Found
		</h2><p>
			La tua richiesta ( <span
			class="em"><?=urldecode($_SERVER['REQUEST_URI'])?></span> ) non ha prodotto
			alcun risultato.
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
