<?php 

	$m->mkpage('Storie 2010', 'Le prime storie');
	$m->mkrelated('next','Storie/2011/', 'Storie 2011');

	function mkpage ($d, $m) {
?>
<div class="small">
	<div class="section">
		<p>
			Ecco dunque lo sperimento.
		</p><p>
			Nell'ormai lontano 2010 cominciai a
			buttare giù delle storie stupide e divertenti, perché piuttosto
			che lasciarle scomparire nel nulla avrei preferito consegnarle
			all'ignobile interweb.
		</p><p>
			E lo feci.
		</p>
	</div>
</div><div class="wider">
	<div class="floatleft">
		<div class="section">

	<p>
		E come posso affermare, ora che tutto è finito, sappiate che
		dalla nona storia si narra quella ch'è nota come &ldquo;La Saga
		della $rossa&rdquo;, triste brandello di storia vera che fece
		deprimere intere generazioni di prima allegri compagni.
	</p><p>
		Molte persone, credo, si persero d'animo nel leggere di questa
		saga, che comunque diede alcuni buoni risultati.
	</p>

		</div>
	</div><div class="floatright">
		<div class="section">

	<?=$m->mkcascade('str2010','Storie 2010', false)?>
	<div id="longstr2010">
		<ol style="list-style-type: upper-roman">
			<li><?=$m->ilink('Storie/I/', 'Apologia')?></li>
			<li><?=$m->ilink('Storie/II/', 'Correre')?></li>
			<li><?=$m->ilink('Storie/III/', 'Progetti')?></li>
			<li><?=$m->ilink('Storie/IV/', 'Impresa')?></li>
			<li><?=$m->ilink('Storie/V/', 'Condizioni')?></li>
			<li><?=$m->ilink('Storie/VI/', 'Un posto in cui stare')?></li>
			<li><?=$m->ilink('Storie/VII/', 'Gundam')?></li>
			<li><?=$m->ilink('Storie/VIII/', 'Sassi')?></li>
		</ol>
		<div class="inside">
			<h2>La Saga di $rossa</h2>
			<ol start="9" style="list-style-type: upper-roman">

			<li><?=$m->ilink('Storie/IX/', 'Attenzione')?></li>
			<li><?=$m->ilink('Storie/X/', 'Due Storie')?></li>
			<li><?=$m->ilink('Storie/XI/', 'Tre Storie')?></li>
			<li><?=$m->ilink('Storie/XII/', 'La musa')?></li>
			<li><?=$m->ilink('Storie/XIII/', 'Il modello definitivo')?></li>
			<li><?=$m->ilink('Storie/XIV/', 'L&apos;incontro')?></li>
			<li><?=$m->ilink('Storie/XV/', 'La spinta')?></li>
			<li><?=$m->ilink('Storie/XVI/', 'Il lunedì della verità')?></li>

			</ol>
		</div>
		<ol start="17" style="list-style-type:upper-roman">
			<li><?=$m->ilink('Storie/XVII/', 'Il finale')?></li>
		</ol>
	</div>

		</div>
	</div>
</div>

<?php } ?>
