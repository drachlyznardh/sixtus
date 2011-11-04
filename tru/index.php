<?php 
	$p->addtitle ('Tru Naluten', 'Per saper dov&apos;andare');
	$p->addpage (function ($d) {
?>
<div class="small">
	<div class="section">
		<p>
			Questa è la pagina giusta per chi vuole informazioni su Tru Naluten.
		</p><h2>
			Tru Naluten
		</h2><p>
			Tru Naluten è una pubblicazione con periodo del tutto imprevedibile, che vaga
			nella mia mente da tempo immemore e subisce incredibili variazioni di registro,
			di personaggi, luoghi, atmosfera, genere… anche ridere.
		</p>
	</div>
</div><?php
	});
	$p->addside(function ($d) {
?><div class="section">
	<h2>
		Tru Naluten
	</h2><p>
		<?=$d->link('Tru/Naluten/Personaggi/', 'Personaggi')?>
	</p><h3>
		Volumi
	</h3><p class="reverse">
		<?=$d->link('Tru/Naluten/Vol.I/', 'Vol.I')?>
		/ <?=$d->link('Tru/Naluten/Vol.II/', 'Vol.II')?>
		/ <?=$d->link('Tru/Naluten/Vol.III/', 'Vol.III')?>
	</p>
</div><?php
	});
	$p->set(true, true, false);
	require_once ('tru/primo/index.php');
	require_once ('tru/secondo/index.php');
	require_once ('tru/terzo/index.php');
?>
