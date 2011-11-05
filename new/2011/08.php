<?
	$d = $this->d;
	if ($this->addmeta()) {
		$this->addtitle ('Agosto', 'Notizie al caldo');
		$this->addprev ('News/2011/07/', 'Luglio');
		$this->addnext ('News/2011/09/', 'Settembre');
	} if ($this->addpage ()) {
		if ($d->manypages) {
			echo ('<div class="section">');
			echo ('<h2>Notizie</h2>');
			echo ('<h2 class="reverse">Agosto 2011</h2>');
			echo ('</div>');
		}
?><div class="small">
	<div class="section">
		<p>
			<span class="em">30/08/2011</span> – E siccome ancora la dovevo
			scrivere e tra un po' finisco anche quello dopo, ecco la recensione
			del <?=$d->link('Recensioni/Libri/XII/','terzo volume','IV')?> della serie fuffa.
		</p><p>
			<span class="em">30/08/2011</span> – Ero là che me ne facevo un
			pentolone (ancora sto cercando l'ispirazione per piegare lo stelo
			per il nuovo fiore…) e mi son detto che le modalità alternative del
			sito posson uscir di mente con facilità. Ed ecco che quindi mi son
			messo a realizzare un pannellino in cima, con dei comodi linkilli.
		</p>
	</div><div class="section">
		<p>
			<span class="em">29/08/2011</span> – Uhm, non succede niente.
			Riempio i buchi con <?=$d->link('Storie/2011/LX/','questa')?>.
		</p><p>
			<span class="em">21/08/2011</span> – Ah! Un po' che non scrivo,
			vero? È perché me ne sono stato impegnato a scrivere il report per
			sgaggio. Intanto, ho letto
			<?=$d->link('Recensioni/Libri/XII/','questo','III')?>.
		</p><p>
			<span class="em">15/08/2011</span> – Siccome piove che Thor la
			manda, me ne sto a casa e scrivo. Ecco
			<?=$d->link('Storie/2011/LIX','qualcosa')?> che doveva arrivare una
			settimana fa ed una
			<?=$d->link('Recensioni/Libri/XII/','lettura')?> appena
			cominciata.
		</p><p>
			<span class="em">10/08/2011</span> – Mentre ero lì che me ne facevo
			un pentolone, proprio ieri, ho finito di leggere
			<?=$d->link('Recensioni/Libri/XI/', 'Nessun Dove')?> di quel
			mattacchione di Neil Gaiman. Non sono deluso.
		</p><p>
			<span class="em">06/08/2011</span> – Senza nessuna aspettativa,
			senza nessuna vera speranza, mi sono guardato il film dei
			<?=$d->link('Recensioni/Film/X/','Puffi')?>, e me ne sono stupito.
		</p><p>
			<span class="em">05/08/2011</span> – Mi sono messo a scrivere
			l'ultimo tab del progetto. <?=$d->link('Storie/2011/LII/','Eccolo','XXI')?>.
		</p><p>
			<span class="em">05/08/2011</span> – Mi sono appena visto
			<?=$d->link('Recensioni/Show/IX/','Angel Beats!')?>, un'allegra
			serie dell'anno scorso che, purtroppo, non è affatto allegra.
			Mentivo.
		</p>
	</div>
</div><?php } if ($this->addside ()) { ?><div class="section">
	<h2 class="reverse">
		Agosto 2011
	</h2><p>
		<span class="em">30/08</span> –
		<?=$d->link('Recensioni/Libri/XII/', 'Il Prigioniero di Azkaban', 'III')?>
	</p><p>
		<span class="em">30/08</span> – Modi e stili
	</p><p>
		<span class="em">29/08</span> –
		<?=$d->link('Storie/2011/LX/', 'Filler')?>
	</p><p>
		<span class="em">21/08</span> –
		<?=$d->link('Recensioni/Libri/XII/','La Camera dei Segreti','II')?>.
	</p><p>
		<span class="em">15/08</span> –
		<?=$d->link('Storie/2011/LIX', 'Violenza&amp;Soddisfazione')?>
	</p><p>
		<span class="em">15/08</span> –
		<?=$d->link('Recensioni/Libri/XII/','Harry Potter &amp; …')?> 
	</p><p>
		<span class="em">10/08</span> – 
		<?=$d->link('Recensioni/Libri/XI/', 'Nessun Dove')?>
	</p><p>
		<span class="em">06/08</span> –
		<?=$d->link('Recensioni/Film/X/','I Puffi')?>
	</p><p>
		<span class="em">05/08</span> – 
		Sgaggio [<?=$d->link('Storie/2011/LII/', 'E infine…', 'XXI')?>]
	</p><p>
		<span class="em">05/08</span> –
		<?=$d->link('Recensioni/Show/IX/', 'Angel Beats!')?>
	</p>
</div><?php } ?>
