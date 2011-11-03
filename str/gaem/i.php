<?php
	$title=array('La storia interattiva',
		'Ma solo se volete', 'start');
	$sides[] = function ($d) {
?><div class="section">
	<h2>
		La storia interattiva
	</h2><ol><li>
		<?=$d->link('Storie/Gaem/', 'Primo')?>
	</li></ol>
</div><?php
	};
	$pages[] = function ($d) {
		$final='Storie/Gaem/Finali/';
?>
<div class="small">
	<?php if ($d->mktab('start')) { ?>
	<div class="section">
		<p>
			C'era una volta il <span class="em">GODS</span>, che se ne andava a
			spasso, bel bello, per il suo regno. Perché lui poteva.
		</p><p>
			Perché il regno era suo.
		</p>
	</div><div class="section">
		<p>
			Incappò un bel di il GODS in uno dei suoi cavalieri, il <span
			class="em">Bolo</span>.
		</p><div class="outside"><p>
				Il Bolo parlò e disse «<span class="bolo">Maestà! Proprio voi
				cercavo</span>»
			</p><p>
				«<span class="gods">Messer Bolo!</span>» rispose il GODS «<span
				class="gods">Qual buon vento?</span>»
			</p><p>
				«<span class="bolo">Un'impresa, sire! Un'impresa!</span> annunciò il
				cavaliere «<span class="bolo">Il popolo necessita di storie</span>»
				ma poi, rannuvolandosi in volto «<span class="bolo">Ma devo anche
				annunciarvi una notizia terribile: si tratta del pentolone delle
				storie. È vuoto, mio signore!</span>»
		</p></div>
	</div><div class="section">
		<h2>
			Scelta
		</h2><p>
			È arrivato il momento di scegliere. Scegli.
		</p><ul><li>
				<?=$d->link($final, 'Non mi frega un cazzo di questa storia', 'F1')?>
			</li><li>
				<?=$d->link($d->self, 'Oh no! Il pentolone?!?', 'S1')?>
		</li></ul>
	</div>
	<?php } if ($d->mktab('s1')) { ?>
	<div class="section">
		<div class="outside"><p>
				«<span class="gods">Oh no! Il pentolone!</span>» esclamò il GODS.
			</p><p>
				Puntando il dito, ordinò «<span class="gods">Presto! Alla
				pentol-caverna!</span>»
		</p></div><p>
			Tarananananananananana!
		</p>
	</div><div class="section">
		<p>
			La <span class="em">Pentol-caverna</span> era un luogo remoto e
			incantato, dimora nel misterioso fabbro nano <span
			class="em">Dacav</span>, dall'orrido aspetto.
		</p><p>
			Sbuffando dalle enormi froge, il nano si rivolse al GODS, che bussava
			alla sua porta.
		</p><div class="outside"><p>
				«<span class="dacav">Sire! Sire! Terribile!
				Terribilissimo!</span>» piagnucolava il fabbro «<span
				class="dacav">Il pentolone s'è esaurito! Non era mai successo,
				in 30000000000000000000&pi;²³anni!</span>»
			</p><p>
				«<span class="dacav">Me lo ricordo, io c'ero</span>» aggiunse il
				nano, ch'era più vecchio delle fondamenta della Terra.
		</p></div><p>
			Atterrito, il GODS visionò il contenuto del Pentolone. Era vuoto.
		</p><p>
			Senza le storie estratte dal pentolone, il regno sarebbe andato a
			puttane! Come fare? Se tutto il regno fosse andato a puttane, quante
			puttane ci sarebbero volute?
		</p>
	</div><div class="section">
		<h2>
			Scelta
		</h2><ul><li>
				<?=$d->link($final, 'Non sono… 15?', 'F2')?>
			</li><li>
				<?=$d->link($d->self, 'Almeno il doppio', 'S2')?>
		</li></ul>
	</div>
	<?php } if ($d->mktab('s2')) { ?>
	<div class="section">
		<div class="outside"><p>
				«<span class="gods">Impossibile!</span>» pianse il GODS, non
				sapendo che fare «<span class="gods">Dove troveremo tutte queste
				puttane?</span>»
		</p></div><p>
			Alla ricerca disperata d'una soluzione.
		</p><div class="outside"><p>
				«<span class="war">Non disperate, mio signore!</span>» esclamò
				allora <span class="em">War</span>, il mago di corte.
				«<span class="war">Basterà riempire il Pentolone con nuove
				storie!</span>» millantò.
		</p></div><p>
			Ed ecco che immediatamente il mago si mise al lavoro su un <span
			class="code">algoritmo intelligente [proattivo &amp; basculante]
			neutrinico ad induzione protonica brandeggiabile di classe 7</span> per
			rivelare la concentrazione di particelle di storia
			nell'aria.
		</p><p>
			Così armati, i nostri eroi partirono alla ricerca di storie!
		</p>
	</div><div class="section">
		<p>
			Quella sera, all'ombra d'un castagno matto, udirono in lontananza una
			voce.
		</p><div class="outside"><p>
				«<span class="mitch">Amici! Amici!</span>» esclamò la voce «<span
				class="mitch">Eccomi! Seppur in ritardo, vi raggiungo!</span>»
		</p></div><p>
			Era <span class="em">Mitch</span> l'erborista, di ritorno dalla sua
			personale impresa, la ricerca della ricerca.
		</p><p>
			Si narrava infatti di un introvabile maestro erborista, sommo maestro,
			che aveva due laboratori, uno in collina e uno in pianura. E pareva
			trovarsi sempre nell'altro.
		</p><p>
			<span class="em forte">Continua…</span>
		</p>
	</div><?php } ?>
</div>
<?php } ?>
