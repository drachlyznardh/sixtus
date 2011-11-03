<?php
	$title = array ('Record', 'La pagina delle imprese', 'intro');
	$prev = array ('Extra/Guida/', 'Guida');
	$next = array ('Extra/Scimmia/', 'La Scimmia Celeste');
	$sides [] = function ($d) {
?>
<div class="section">
	<p id="li-intro">
		<?=$d->mktid('Intro', 'INTRO')?>
	</p><h2 class="reverse">
		Record
	</h2><p id="li-i">
		<?=$d->mktid('Precedenti', 'I')?>
	</p><p id="li-ii">
		<?=$d->mktid('Fino a Lavis', 'II')?> – 01/10/2011
	</p>
</div>
<?php
	};
	$pages[] = function ($d) {
?>
<div class="small">
	<?php if ($d->mktab('intro')) { ?><div class="section">
		<p>
			Un bel giorno (ieri) mi sono messo qui a pensare a tutte le mie imprese
			storiche… non sono esattamente incredibili, non sono cose che possono
			finire sul giornale, e soprattutto non sono cose che qualunque altro
			atleta possa fare senza particolare preparazione.
		</p><p>
			Ma sono tutte cose che io posso fare, e contemporaneamente cose per le
			quali non riesco a trovare compagni disposti a seguirmi.
		</p>
	</div><div class="section">
		<p>
			Allora, partendo da alcune imprese del passato che non posso datare ma
			che riesco a ricordare, elencherò qui un po' di cose, invece che
			metterle nelle storie.
		</p>
	</div><?php } if ($d->mktab('i')) { ?><div class="section">
		<p>
			Forse dovrei, comunque, cominciare con l'unica impresa nella quale non sono
			stato solo, ossia quella di cui si narra nella
			<?=$d->link('Storie/2010/IV/','quarta storia')?>. Quella è piccolina, ma
			merita.
		</p><p>
			Una volta ho affrontato la Maranza, a cazzo, con la bicicletta scrausa,
			DOPO due ore di LFC.
		</p><p>
			Una volta ho mandato tutti affanculo, ho preso quella stessa bicicletta
			e me ne sono andato ad affrontare il Bondone dalla parte di Garniga.
		</p>
	</div><div class="section">
		<p>
			Ed ora, un po' di giri in bicicletta.
		</p><ul><li>
				il Bondone, dalla parte di Sardagna, numerose volte, una volta fino
				a Lagolo (ma senza ritorno, quella: sono ancorà lì)
			</li><li>
				una volta sono arrivato a Riva, dalla parte di Rovereto, per poi
				risalire tutta la valle dei Laghi, passando per Sopramonte e poi giù
				fino a casa
			</li><li>
				una volta ho preso la strada per Garniga, sono arrivato a Cei, ho
				girato attorno al lago e infine, al grido di «<span
				class="gods">Dove porterà questa stradina?</span>» mi sono perso nel
				bosco e ne sono riemerso dopo due ore. Mai più.
			</li><li>
				una volta sono andato a Sant'Agnese, sono salito fino a Santa
				Colomba, poi mi sono perso in val di Cembra…
		</li></ul><p>
			Poi, un po' di corse.
		</p><ul><li>
				il giro della città in notturna
			</li><li>
				la maratonina del Concilio della città di Trento
			</li><li>
				mezzamaratona (non ufficiale) da casa fino a Besenello e ritorno
		</li></ul><p>
			Ed ora, un po' di misto, le mie grandi imprese.
		</p><ul><li>
				in bicicletta, da casa fino alle Viotte, poi a piedi su per le tre
				cime del Bondone. C'è un'ottima, freschissima fonte, tra il Cornetto
				e il Doss d'Abramo
			</li><li>
				in bicicletta, da casa fino a Fai della Paganella, poi a piedi su
				per le piste da sci fino in cima. Peccato che fosse nuvoloso
		</li></ul>
	</div><?php } if ($d->mktab('ii')) { ?><div class="section">
		<p>
			E siccome ieri non avevo una gran briga di fare altro, né di prendere la
			bicicletta, mi sono detto
		</p><div class="outside"><p>
				«<span class="gods">Perché prendere la bici per andare a correre se
				posso semplicemente correre di più?</span>»
		</p></div><p>
			Così ho corso un po' di più.
		</p>
	</div><div class="section">
		<p>
			E siccome la ciclabile lungo la zona delle Albere adesso pare essere
			aperta, sono potuto passare di là senza dover urlare «<span
			class="gods">In barba alla legge!</span>» mentre passavo.
		</p><p>
			Con un totale di quattro pause acqua, rispettivamente due alla
			fontanella della funivia e due al parco di Cristo Re, mi sono fatto la
			mia bella corsa al sole e all'ombra, sull'asfalto e sull'erba, con i
			cani e senza i cani.
		</p><p>
			In tristezza, siccom'era prestino, non c'era quasi nessuno…
		</p><p>
			Ma, alla fine, ho coperto i <span class="code">17.8km</span> del
			<a href="http://g.co/maps/d9vz5">percorso</a> in <span class="code">1h 53'</span>, con una velocità media di
			<span class="code">9.6km/h</span>. Mica male…
		</p><p>
			Ma la cosa più importante è che non sono morto. Il giorno dopo (ed anche
			quella sera stessa, in realtà) potevo ancora camminare.
		</p>
	</div><?php } ?>
</div>
<?php } ?>
