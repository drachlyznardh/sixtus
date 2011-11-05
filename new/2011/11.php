<?php
	$p->addtitle ('Novembre', 'Piove, ma fa ancora caldo');
	$p->addprev ('News/2011/10/', 'Ottobre');
	$p->addpage (function ($d) {
?><div class="small">
	<div class="section">
		<p>
			Una cosa bella!
		</p><p id="05/00:35">
			<span class="em"><?=$d->link($d->self, '05/11/2011 00:35', 0, '05/0035')?>
			[<?=$d->link('Extra/GUIDA/', 'MiniStorie', 'CONTENUTI', 'MiniStorie')?>] </span>
		</p><h2 class="cat-heart">
			KitKat gratis!
		</h2><p>
			Questa è una cosa nuova e bella.
		</p><div class="inside"><p>
				Ero lì al baretto che mi facevo un caffé in compagnia (non
				tanta, recentemente, ma qualcuno è ancora in zona…) e mentre
				aspetto al bancone, mi guardo attorno.
			</p><p>
				Vedo alla mia sinistra una bimba alta così (beh, doveva essere
				una matricola di qualcosa, ma – poverella – era alta un
				barattolo e una banana) che regge un pacchetto di KitKat.
			</p><p>
				Il mio cervello va in pappa, tentando di capire, visto che il
				bar non vende quella roba. Il mio ragionamento è, ovviamente, ad
				alta voce; e la ragazza mia sente.
		</p></div><p>
			Ma ecco la cosa bella.
		</p><div class="outside"><p>
				«Oh, no: l'ho preso alle macchinette» mi spiega lei, e
				gentilmente «Ne vuoi un pezzo?»
		</p></div><p>
			Awwwwww. Non solo non si è spaventata, come succede sempre, ma m'ha
			pure offerto da mangiare. Quale rara circostanza.
		</p><p>
			Non spero di ritrovare questo angioletto una seconda volta, ma di
			certo la salverò nella lista delle <span
			class="code">@Ragazza-__SUFFIX__</span>, per sempre nel mio cuore.
		</p>
	</div><div class="section">
		<p id="03/00:00">
			<span class="em"><?=$d->link($d->self, '03/11/2011 00:00', 0, '03/00:00')?></span>
		</p><h2>
			Rinnovo! Spostamento! Restauro!
		</h2><p>
			Lyznardhum (questo sito) si sposta, cambia hosting, cambia
			indirizzo, cambia veste, cambia implementazione… cambia tutto!
		</p><p>
			Tru Naluten torna in sede! Le recensioni sono state riordinate! È
			cominciato il NaNoWriMo 2011! Le storie restano identiche!
		</p><p>
			Cominciamo con due recensioni nuove:
			<?=$d->link('Recensioni/Film/XVII/', 'First Blood', 'i')?> e
			<?=$d->link('Recensioni/Film/XVII/', 'First Blood Part II', 'ii')?>
		</p>
	</div>
</div><?php
	});
	$p->addside (function ($d) {
?><div class="section">
	<h2 class="reverse">
		Novembre 2011
	</h2><p class="cat-heart">
		<span class="em">05/11</span> – KitKat Gratis!
	</p><p>
		<span class="em">03/11</span> – <?=$d->link('Recensioni/Film/XVII/', 'First Blood', 'i')?>
		[ <?=$d->link('Recensioni/Film/XVII/', 'Part II', 'ii')?> ]
	</p><p>
		<span class="em">03/11</span> – Rinnovo!
	</p>
</div><?php
	});
?>
