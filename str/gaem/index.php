<?php
	$title=array('La storia interattiva',
		'Ma solo se volete');
	$pages[] = function ($d) {
?>
<div class="small">
	<div class="section">
		<p>
			Un bel giorno, iniziai una frase… poi il <span class="bolo">Bolo</span>
			m'interruppe.
		</p><p>
			Non ricordo bene per quale ragione, non ricordo bene come… cominciai a
			scrivere questa storia.
		</p><p>
			È ancora corta, comincia soltanto, ma fa ridere.
		</p>
	</div>
</div>
<?php };
	$sides[] = function ($d) {
?><div class="section">
	<h2>
		La storia interattiva
	</h2><ol><li>
		<?=$d->link('Storie/Gaem/I/', 'Primo')?>
	</li></ol>
</div><?php
	}
?>
