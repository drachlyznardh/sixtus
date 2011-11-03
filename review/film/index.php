<?php
	$title = array ('Film', 'Quelli visti di recente');
	$pages[] = function ($d) {
?>
<div class="small">
	<?php if ($d->mktab('') or $d->mktab('categorie')) { ?><div class="section">
		<h2><a id="Film"></a>
			Film
		</h2><p>
			Io guardo molti film, con piacere.
		</p><p>
			Ne parlo spesso con alcuni compari, e promuovo idee strambe al
			riguardo.
		</p><p>
			E siccome spiegare il perché e il percome un film mi piace o non mi
			piace, mi sono messo a scriverne. Qui.
		</p>
	</div><?php } ?>
</div>
<?php
	};
	$sides[] = function ($d) {
?>
<div class="section">
	<h2 class="reverse">
		Film
	</h2><p>
			I. <?=$d->link('Recensioni/Film/I/', 'Thor')?> – 2011
		</p><p>
			III. <?=$d->link('Recensioni/Film/III/', 'Robocop')?> – 1987~1993
		</p><p>
			VII. <?=$d->link('Recensioni/Film/VII/', 'Dark of the Moon')?> – 2011
		</p><p>
			VIII. <?=$d->link('Recensioni/Film/VIII/', 'Capitan America')?> – 2011
		</p><p>
			X. <?=$d->link('Recensioni/Film/X/','I Puffi')?> – 2011
		</p><p>
			XVII. <?=$d->link('Recensioni/Film/XVII/', 'Rambo')?> – 1982~2008
		</p>
	</p>
</div>
<?php } ?>
