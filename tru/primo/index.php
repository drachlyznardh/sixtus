<?php
	$d = $this->d;
	if ($this->addmeta()) {
		$this->addtitle ('Volume I', 'Cose strane');
		$this->addnext ('Tru/Naluten/Vol.II/', 'Volume II');
	} if ($this->addpage ()) {
?><div class="small">
	<div class="section">
		<h2>
			Volume I
		</h2><p>
			In Tru Naluten succedono cose. Cose a caso, fondamentalmente. Nel primo volume
			vediamo sostanzialmente nient&apos;altro che il protagonista, Simak, farsi un
			fiume di seghe mentali, assieme a suoi compagni d&apos;avventura, Ci e il Lyz.
		</p><p>
			Le cose procedono a vanvera fino al giungere inaspettato di questi tre in un
			villaggio vicino, dove si manifesta l'invasione del mondo da parte di terribili
			mostri blu. Alla fine, esplode il mondo.
		</p>
	</div>
</div><?php
	} if ($this->addside ()) {
?><div class="section">
	<h2>
		Volume I
	</h2><ol style="list-style-type: upper-roman">
		<li><?=$d->link('Tru/Naluten/Vol.I/I/', 'Camminavo')?></li>
		<li><?=$d->link('Tru/Naluten/Vol.I/II/', 'Sacomne')?></li>
		<li><?=$d->link('Tru/Naluten/Vol.I/III/', 'Il mio nome')?></li>
		<li><?=$d->link('Tru/Naluten/Vol.I/IV/', 'Le altre voci')?></li>
		<li><?=$d->link('Tru/Naluten/Vol.I/V/', 'La mia faccia')?></li>
		<li><?=$d->link('Tru/Naluten/Vol.I/VI/', 'L&apos;altro me')?></li>
		<li><?=$d->link('Tru/Naluten/Vol.I/VII/', 'La meta')?></li>
		<li><?=$d->link('Tru/Naluten/Vol.I/VIII/', 'La Porta')?></li>
		<li><?=$d->link('Tru/Naluten/Vol.I/IX/', 'La fine del mondo')?></li>
	</ol>
</div><?php
	};
?>
