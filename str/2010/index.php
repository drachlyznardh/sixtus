<?php 
	$title = array('Storie 2010', 'Le prime storie');
	function mkpage ($d) {
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
			<h2 class="reverse">
				Storie 2010
			</h2><ol style="list-style-type: upper-roman">
				<li><?=$d->link('Storie/2010/I/', 'Apologia')?></li>
				<li><?=$d->link('Storie/2010/II/', 'Correre')?></li>
				<li><?=$d->link('Storie/2010/III/', 'Progetti')?></li>
				<li class="cat-cosefighe"><?=$d->link('Storie/2010/IV/', 'Impresa')?></li>
				<li><?=$d->link('Storie/2010/V/', 'Condizioni')?></li>
				<li><?=$d->link('Storie/2010/VI/', 'Un posto in cui stare')?></li>
				<li><?=$d->link('Storie/2010/VII/', 'Gundam')?></li>
				<li><?=$d->link('Storie/2010/VIII/', 'Sassi')?></li>
			</ol>
		</div>
	</div>
<div class="section">
	<p>Ma poi mi capitò una cosa interessante...</p>
</div><div class="wider">
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
			<h2 class="reverse">
				La Saga di $rossa
			</h2><ol start="9" style="list-style-type: upper-roman">
				<li class="cat-heart"><?=$d->link('Storie/2010/IX/', 'Attenzione')?></li>
				<li class="cat-heart"><?=$d->link('Storie/2010/X/', 'Due Storie')?></li>
				<li class="cat-heart"><?=$d->link('Storie/2010/XI/', 'Tre Storie')?></li>
				<li class="cat-heart"><?=$d->link('Storie/2010/XII/', 'La musa')?></li>
				<li class="cat-heart"><?=$d->link('Storie/2010/XIII/', 'Il modello definitivo')?></li>
				<li class="cat-heart"><?=$d->link('Storie/2010/XIV/', 'L&apos;incontro')?></li>
				<li class="cat-heart"><?=$d->link('Storie/2010/XV/', 'La spinta')?></li>
				<li class="cat-heart"><?=$d->link('Storie/2010/XVI/', 'Il lunedì della verità')?></li>
			</ol>
		</div>
	</div>
<div class="section">
	<p>Ma anche questa storia finì...</p>
</div><div class="wider">
	<div class="widecontent">
		<div class="section">
			<p>E quindi il finale, l'ultima dell'anno.</p>
		</div>
	</div><div class="widelist">
		<div class="section">
			<h2 class="reverse"> 
				Storie 2010
			</h2><ol start="17" style="list-style-type:upper-roman">
				<li><?=$d->link('Storie/2010/XVII/', 'Il finale')?></li>
			</ol>
		</div>
	</div>
</div>
<?php } ?>
