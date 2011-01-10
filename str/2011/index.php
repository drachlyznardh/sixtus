<?php
	
	$m->mkpage('Storie 2011', 'Forse meno tristi dell&apos;anno passato');
	
	function mkpage($d, $m) {
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
		</div>
	</div><div class="widelist">
		<div class="section">
			<?=$m->mkreverse('str2011', 'Storie 2011')?>
			<ol start="18" style="list-style-type: upper-roman">
				<li><?=$m->ilink('Storie/2011/XVIII/', 'Liber Javae')?></li>
				<li><?=$m->ilink('Storie/2011/XIX/', 'Permessi')?></li>
				<li><?=$m->ilink('Storie/2011/XX/', 'Guida')?></li>
			</ol>
		</div>
	</div>
</div>
<?php } ?>
