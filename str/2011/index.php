<?php
	
	$title = array('Storie 2011', 'Forse meno tristi dell&apos;anno passato');
	
	function mkpage($d) {
?>
<div class="small">
	<div class="section">
		<p>
			E così venne il 2011...
		</p><p>
			E forse c'è spazio, qui, per qualche considerazione sull'anno
			passato. Ah, l'anno passato. Quelli ch'han letto le storie
			precedenti potrebbero capire.
		</p><p>
			Inizio quest'anno con una ritrovata libertà sentimentale (lol,
			grande consolazione, grande fuga), senza un nuovo Gundam,
			prossimamente con un fratello in più, con una lunga fila di
			esami da dare e nessuna voglia di lavorare.
		</p>
	</div>
</div><div class="wider" id="longstr2011">
	<div class="widecontent">
		<div class="section">
			<a id="2011"></a>
			<p>
				Scriverò quando ci sarà qualcosa da scrivere.
			</p>
		</div><div class="section">
			<p>
				Pare che tuttora non ci sia nulla da scriverci,
				qui. Farò un'altra volta...
			</p>
		</div>
	</div><div class="widelist">
		<div class="section">
			<h2 id="straightstr2011" class="reverse wider" onclick="javascript:reverse('str2011')">
				Storie 2011
			</h2><ol start="18" style="list-style-type: upper-roman">
				<li><?=$d->link('Storie/2011/XVIII/', 'Liber Javae')?></li>
				<li><?=$d->link('Storie/2011/XIX/', 'Permessi')?></li>
				<li><?=$d->link('Storie/2011/XX/', 'Guida')?></li>
				<li><?=$d->link('Storie/2011/XXI/','Programmazione 40.000')?></li>
				<li><?=$d->link('Storie/2011/XXII/', 'Tecniche avanzate')?></li>
				<li><?=$d->link('Storie/2011/XXIII/', 'Cose complicate')?></li>
				<li><?=$d->link('Storie/2011/XXIV', 'Il futuro')?></li>
				<li><?=$d->link('Storie/2011/XXV/', 'No')?></li>
				<li><?=$d->link('Storie/2011/XXVI/', 'La sconfitta')?></li>
			</ol>
		</div>
	</div>
</div>
<?php } ?>
