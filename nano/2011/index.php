<?php
	$title=array('Dottor Odio Gaiden',
		'Mirabolanti avventure alla conquista del mondo');
	$prev = array ('NaNoWriMo/Corvino/Multicolore/', 'Corvino Multicolore', 0);
	$sides[] = function ($d) {
?>
<div class="section">
	<h2>
		Dottor Odio Gaiden
	</h2><p>
		<?=$d->link('NaNoWriMo/2011/I/', 'Parte I')?>
	</p>
</div>
<?php
	};
	$pages[] = function ($d) {
?>
<div class="small">
	<div class="section">
		<p>
			Anche quest'anno mi cimento.
		</p><p>
			Chi avesse letto le <?=$d->link('Storie/', 'storie')?> avrà già
			sentito parlare del dottor Odio e della <span class="magnet">ragazza
			magnete</span>. Questa è (sarà) la storia completa.
		</p>
	</div><div class="section">
		<p>
			Per adesso, dovete accontentarvi di questo indizio:
		</p><div class="outside"><p>
				Il dottor Odio non ha pace: settimanalmente, il suo malvagio
				piano per conquistare la Terra viene ostacolato da un nuovo,
				incapace eroe.
			</p><p>
				Arduo è, per l'aspirante signore del male, dover fermare i
				continui blandi tentativi per fermarlo e al contempo costruire
				il suo impero. Il tutto, ovviamente, senza dimenticare le buone
				maniere.
			</p><p>
				Ben lunga è la strada per il dominio, e numerose sono le sue
				nemesi.
		</p></div>
	</div>
</div>
<?php } ?>
