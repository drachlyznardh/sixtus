<?php if (!isset($multinav)) { ?>
<div class="section">
	<h2>
		Tru Naluten
	</h2><p>
		<?=$d->link('Tru/Naluten/','Indice')?>
	</p><p>
		<?=$d->link('Tru/Naluten/Personaggi','Personaggi')?>
	</p><p>
		<?=$d->link('Tru/Naluten/X/','Volume II')?>
	</p><p>
		<?=$d->link('Tru/Naluten/XX/','Volume III')?>
	</p>
</div>
<?php } ?>
<div class="section">
	<h2 id="arrowvolI-rside" class="opened" onclick="javascript:cascade('volI-rside')">
		Volume I
	</h2><div id="longvolI-rside">
		<ol style="list-style-type: upper-roman">
			<li><?=$d->link('Tru/Naluten/I/', 'Camminavo')?></li>
			<li><?=$d->link('Tru/Naluten/II/', 'Sacomne')?></li>
			<li><?=$d->link('Tru/Naluten/III/', 'Il mio nome')?></li>
			<li><?=$d->link('Tru/Naluten/IV/', 'Le altre voci')?></li>
			<li><?=$d->link('Tru/Naluten/V/', 'La mia faccia')?></li>
			<li><?=$d->link('Tru/Naluten/VI/', 'L&apos;altro me')?></li>
			<li><?=$d->link('Tru/Naluten/VII/', 'La meta')?></li>
			<li><?=$d->link('Tru/Naluten/VIII/', 'La Porta')?></li>
			<li><?=$d->link('Tru/Naluten/IX/', 'La fine del mondo')?></li>
		</ol>
	</div>
</div>
