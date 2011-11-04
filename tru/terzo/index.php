<?php
	$p->addtitle ('Volume III', 'Qui cominciano i casini');
	$p->addprev ('Tru/Naluten/Vol.II/', 'Volume II');

	$p->addpage (function ($d) {
?><div class="small">
	<div class="section">
		<h2>
			Volume III
		</h2><p>
			Simak mette Jo a parte del suo piano.
		</p>
	</div>
</div><?php
	});
	$p->addside (function ($d) {
?><div class="section">
	<h2>
		Volume III
	</h2><ol start="20"><li>
			<?=$d->link('Tru/Naluten/Vol.III/XX/', 'Il lavoro di Simak')?>
	</li></ol>
</div><?php
	});
?>
