<?php 

	$m->mkpage('Storie 2010', 'Le prime storie');

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
</div><div class="wider" id="longstr2010">
	<div class="widecontent">
		<div class="section">
			<p>
				Quindi cominciai buttando giù parodie di storie
				vere, di vita vissuta. Raccontano quello che
				capita nell'aulastudio, di quella che capita
				fuori.
			</p><p>
				Tutto quello che potete leggere è spesso un
				ricamo di fantasia oppure un viaggione mentale.
			</p>
		</div>
	</div><div class="widelist">
		<div class="section">
		<?=$m->mkreverse('str2010','Storie 2010')?>
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
		</div>
	</div>
</div><div class="small">
	<div class="section">
		<p>Ma poi mi capitò una cosa interessante...</p>
	</div>
</div><div class="revwider" id="longsagarossa">
	<div class="widecontent">
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
	</div><div class="widelist">
		<div class="section">
			<?=$m->mkreverse('sagarossa', 'La Saga di $rossa')?>
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
	</div>
</div><div class="small">
	<div class="section">
		<p>Ma anche questa storia finì...</p>
	</div>
</div><div class="wider" id="longfinale">
	<div class="widecontent">
		<div class="section">
			<p>E quindi il finale, l'ultima dell'anno.</p>
		</div>
	</div><div class="widelist">
		<div class="section">
			<?=$m->mkreverse('finale', 'Storie 2010')?>
			<ol start="17" style="list-style-type:upper-roman">
				<li><?=$m->ilink('Storie/XVII/', 'Il finale')?></li>
			</ol>
		</div>
	</div>
</div>

<?php } ?>
