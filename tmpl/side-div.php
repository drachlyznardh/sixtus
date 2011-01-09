					<div class="clearbox">
						<div class="section">

	<?=$m->mkcascade('tru-lside','Tru Naluten',false)?>
	<div id="longtru-lside">
		<p><?=$m->ilink ('Tru/Naluten/', 'Indice')?></p>
		<p><?=$m->ilink ('Tru/Naluten/Personaggi/', 'Personaggi')?></p>
		<p><?=$m->ilink('Tru/Naluten/I/', 'Volume I')?></p>
		<p><?=$m->ilink('Tru/Naluten/X/', 'Volume II')?></p>
	</div>
</div>
<div class="section">
	<?=$m->mkcascade('str-lside','Storie',false)?>
	<div id="longstr-lside">
		<p><?=$m->ilink('Storie/','Tutte le storie')?></p>
		<p><?=$m->ilink('Storie/2010/','Storie 2010')?></p>
		<p><?=$m->ilink('Storie/2011/','Storie 2011')?></p>
	</div>
</div>
<div class="section">
	<?=$m->mkcascade('nano-lside','NaNoWriMo',false)?>
	<div id="longnano-lside">
		<p><?=$m->ilink('NaNoWriMo/','Indice')?></p>
		<p><?=$m->ilink('NaNoWriMo/2010/','NaNoWriMo 2010')?></p>
		<p><?=$m->ilink('NaNoWriMo/Corvino/Multicolore/','Corvino Multicolore')?></p>
	</div>

						</div> <!-- Section -->
					</div> <!-- Clear Box -->
