<?php
	if ($this->addmeta()) {
		$this->addtitle ('Tru Naluten', 'Per saper dov&apos;andare');
		$this->prepare ('tru/primo/index.php', false, true, true);
		$this->prepare ('tru/secondo/index.php', false, true, true);
		$this->prepare ('tru/terzo/index.php', false, true, true);
	} if ($this->addpage ()) {
?>
<div class="small">
	<div class="section">
		<p>
			Questa è la pagina giusta per chi vuole informazioni su Tru
			Naluten.
		</p><h2>
			Tru Naluten
		</h2><p>
			Tru Naluten è una pubblicazione con periodo del tutto imprevedibile,
			che vaga nella mia mente da tempo immemore e subisce incredibili
			variazioni di registro, di personaggi, luoghi, atmosfera, genere…
			anche ridere.
		</p>
	</div>
</div><?php
	} if ($this->addside ()) { $d = $this->d;
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
	}
?>
