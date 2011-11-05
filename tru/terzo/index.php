<?php
	$d = $this->d;
	if ($this->addmeta()) {
		$this->addtitle ('Volume III', 'Qui cominciano i casini');
		$this->addprev ('Tru/Naluten/Vol.II/', 'Volume II');
	} if ($this->addpage ()) {
?><div class="small">
	<div class="section">
		<h2>
			Volume III
		</h2><p>
			Simak mette Jo a parte del suo piano.
		</p>
	</div>
</div><?php
	} if ($this->addside ()) {
?><div class="section">
	<h2>
		Volume III
	</h2><ol start="20"><li>
			<?=$d->link('Tru/Naluten/Vol.III/XX/', 'Il lavoro di Simak')?>
	</li></ol>
</div><?php
	}
?>
