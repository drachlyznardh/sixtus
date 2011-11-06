<?php
	$d = $this->d;
	if ($this->addmeta ()) {
		$this->addtitle ('Due storie', 'Entrambe tristi', 'i');
		$this->addprev ('Storie/2010/IX/', 'Attenzione');
		$this->addnext ('Storie/2010/XI/', 'Tre storie');
	} if ($this->addside ()) {
?><div class="section">
	<h2>
		Due storie
	</h2><ol><li>
			<?=$d->mktid('La prima', 'i')?>
		</li><li>
			<?=$d->mktid('La seconda', 'ii')?>
	</li></ol>
</div><?php
	} if ($this->addpage ()) {
?><div class="small">
	<?php if ($d->mktab('i')) { ?><div class="section">
		<p>
			Due cose interessanti. No, non interessanti. Però due.
		</p><h2>
			La tastiera muta, grazie ai MotörHead
		</h2><h2 class="reverse">
			17 novembre 2010
		</h2><p>
			Mentre scrivo ascolto musica. Spesso quando uno ascolta canzoni
			mentre scrive non ha gran voglia di ascoltare sempre la stessa
			robe, e vorrebbe invece passare tra la propria galleria in modo
			vario.
		</p><p>
			Avrei anche potuto farlo installando uno dei decilioni di client
			musicali disponibili, uno di quelli che t'indicizzano gli album,
			ti scaricano le copertine, ti puliscono l'audio e fanno molte
			altre cose utili e sgaggiose.
		</p><p>
			Ma io sono un dannato hakker e un h4x0r, quindi prefirisco di
			gran lunga avere un client leggero e testuale. MPlayer. E non
			solo, l'ho scriptato per avere più varietà nella mia musica:
			FPlayer.
		</p><p>
			Lo script utilizza l'utility find per scansionare la mia musica
			e trovare le corrispondenze al modello che inserisco. Ed io
			spesso inserisco soltanto due o tre lettere, di modo da scoprire
			associazioni casuali di canzoni.
		</p><p>
			Ieri sera avevo voglia di un rock un po' più energico, ho scelto
			i Motorhead e li ho cercati. Ma non c'erano. Perché li tengo
			salvati con il loro vero nome: Motörhead.
		</p><p>
			Abilita il compositing sul tasto RALT per scrivere l'umlaut. E
			poi toglilo. Ma commetti un piccolo errore nel secondo comando e
			ottieni una tastiera quasi completamente inerte...
		</p><p>
			L'ho risolta reinserendo i comandi corretti dal primo terminale
			virtuale. Disonore.
		</p>
	</div><?php } if ($d->mktab('ii')) { ?><div class="section">
		<p>
			Questa invece è per autocommiserazione.
		</p><h2>
			E questi sono problemi da donne
		</h2><p>
			$<span class="mitch">ReDelGossip</span>, un caro amico quì a fianco,
			sta evidentemente avendo problemi nel chattare con l'altro sesso.
		</p><p>
			Il problema, che secondo il sottoscritto esiste soltanto nella
			testa di lei (o di chi per lei, non ho ben capito).
		</p><div class="outside"><p>
			Il mio amico, rispondendo alla domanda <?=$d->inline('em', 'Come
			stai?')?> rispose, malauguratamente qualcosa del tipo <?=$d->inline
			('mitch', 'Bene')?> anziché <?=$d->inline ('mitch', 'Bene, grazie
			d&apos;averlo chiesto')?>
		</p></div><p>
			Se ci fossero ragazze a leggere questo post, chiederei loro di
			scrivere in merito, ma so che non ce ne sono. ;_;
		</p>
	</div><div class="section">
		<p>
			Tentando di consolare il poveretto, gli ho proposto di adottare
			il mio metodo:
		</p><div class="outside"><p>
			io mi avvicino a lei e chiedo <?=$d->inline('gods', 'Scusa…')?> e
			lei <?=$d->inline('em', 'No')?>
		</p></div><p>
			Storia vera.
		</p><p>
			$rossa, finirà così anche con te?
		</p>
	</div><?php } ?>
</div><?php } ?>
