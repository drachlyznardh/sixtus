<?php if (!isset($multinav)) { ?>
	<div class="section">
		<h2 id="arrowstr-rside" class="opened" onclick="javascript:cascade('str-rside')">
			Tutte le storie
		</h2><div id="longstr-rside">
			<p><?=$d->link('Storie/2010/', 'Storie &apos;10')?></p>
			<p><?=$d->link('Storie/2011/', 'Storie &apos;11')?></p>
		</div>
	</div>
<?php } ?>
<div class="section">
	<h2 id="arrowstr2010-rside" class="opened"
			onclick="javascript:cascade('str2010-rside');">
		Storie 2010
	</h2><div id="longstr2010-rside">
		<ol style="list-style-type: upper-roman;">
			<li><?=$d->link('Storie/2010/I/', 'Apologia')?></li>
			<li><?=$d->link('Storie/2010/II/', 'Correre')?></li>
			<li><?=$d->link('Storie/2010/III/', 'Progetti')?></li>
			<li class="cat-cosefighe"><?=$d->link('Storie/2010/IV/', 'Impresa')?></li>
			<li><?=$d->link('Storie/2010/V/', 'Condizioni')?></li>
			<li><?=$d->link('Storie/2010/VI/', 'Un posto in cui stare')?></li>
			<li><?=$d->link('Storie/2010/VII/', 'Gundam')?></li>
			<li><?=$d->link('Storie/2010/VIII/', 'Sassi')?></li>
		</ol>
	</div><h2 class="reverse">
		La Saga di $rossa
	</h2><div class="inside">
		<ol start="9" style="list-style-type:upper-roman">
			<li class="cat-heart"><?=$d->link('Storie/2010/IX/', 'Attenzione')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2010/X/', 'Due Storie')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2010/XI/', 'Tre Storie')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2010/XII/', 'La musa')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2010/XIII/', 'Il modello definitivo')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2010/XIV/', 'L&apos;incontro')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2010/XV/', 'La spinta')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2010/XVI/', 'Il lunedì della verità')?></li>
		</ol>
	</div><ol start="17" style="list-style-type:upper-roman">	
		<li><?=$d->link('Storie/2010/XVII/', 'Il finale')?></li>
	</ol>
</div>
<?php if (!isset($multinav)) { ?>
<div class="section">
	<h2>Attenzione!!!</h2>
	<p>
		La maggior parte di queste storie è triste, triste un sacco, triste a botta!
	</p><p>
		La lettura può indurre, nelle persone particolarmente sensibili,
		casi di suicidio anche reiterati.
	</p>
</div>
<?php } ?>
