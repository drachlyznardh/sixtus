<?php
	$title = array ('Film brutti', 'Una ristretta selezione');
	$pages[] = function ($d) {
?>
<div class="small">
	<?php if ($d->mktab('') or $d->mktab('categorie')) { ?><div class="section">
		<h2><a id="Brutti"></a>
			Film brutti
		</h2><p>
			Insomma, io che ho visto TUTTI i film di Godzilla, di film brutti ne
			so qualcosa. Non ne so quanto War, o quanto <a 
			href="mecharete.blogspot.com">Luber</a>, ma ne so.
		</p><p> 
			Quindi elencherò un po' di schifezze, così che non vi capiti di
			andarle a cercare o meglio, trovandole, sappiate evitarle.
		</p><p> 
			Ma non tutto fa schifo schifo. Alcune cose, che spero di arrivare ad
			elencare, sono tanto brutte da far ridere, altre tanto brutte da
			diventare apprezzabili. Altre invece sono solo brutte.	
		</p>
	</div><?php } ?>
</div>
<?php
	};
	$sides[] = function ($d) {
?>
<div class="section">
	<h2 class="reverse">
		Film brutti
	</h2><p>
			XVI. <?=$d->link('Recensioni/Film/Brutti/XVI/','Bitch Slap')?> – 2009
	</p>
</div>
<?php } ?>
