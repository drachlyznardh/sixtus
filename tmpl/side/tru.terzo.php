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
	<h2 id="arrowvolIII-rside" class="opened" onclick="javascript:cascade('volIII-rside')">
		Volume III
	</h2><div id="longvolII-rside">
		<ol start="20" style="list-style-type: upper-roman">
			<li><?=$d->link('Tru/Naluten/XX/', 'Il lavoro di Simak'); ?></li>
		</ol>
	</div>
</div>
