 <?php
	$title=array('La storia interattiva', 'I finali');
	function mkpage($d){
?>
<div class="small">
	<?php if ($d->mktab('f1')) { ?>
	<div class="section">
		<p>
			Eh, peccato. Pare che al lettore non freghi un cazzo.
		</p>
	</div><div class="section">
		<p>
			Ma il GODS, che non aveva altro interesse se non il mutante aspetto
			delle nuvole, rispose
		</p><div class="outside"><p>
				«<span class="gods">Messer Bolo, forse non vedi che sono impegnato a
				rimestare le mie scaroffie?</span>» rimestano le sue scartofie, e
				poi «<span class="gods">Vado ora a raccattare due cari amici,
				Giorgio &amp; Piero, abbiamo una cosa da cercare</span>» e partì.
		</p></div><p>
			Il resto è <a
			href="http://www.youtube.com/results?search_query=giorgio+e+piero">questo</a>.
			FINE.
		</p>
	</div>
	<?php } if ($d->mktab('f2')) { ?>
	<div class="section">
		<p>
			Una volta radunate quindici puttane, tutto andò a posto.
		</p><p>
			Tutti vissero felici e contenti, tranne qualcuno che morì. FINE.
		</p>
	</div><?php } ?>
</div>
<?php } ?>
