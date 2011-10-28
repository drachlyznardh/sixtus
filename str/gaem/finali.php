 <?php
	$title=array('La storia interattiva','I finali');
	function mkpage($d){
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<h2>
				Finali
			</h2><p>
				<?=$d->link('Storie/Gaem/Finali/','Questa è la fine', 'I')?>
			</p><ol><li id="li-f1">
					A nessuno fregò
				</li><li id="li-f2">
					Tutto a puttane
			</li></ol>
		</div>
	</div><div class="widecontent">
		<div class="tab" id="tab-i">
			<div class="section">
				<p>
					Complimenti. Sei arrivato in fondo alla storia interattiva.
				</p><p>
					Cioè, no, peccato. Sei morto o sei uscito dalla storia.
					Poverello. Tecnicamente, infatti, hai perso: non è questo il
					finale buono.
				</p><p>
					Di fatto, questa è la pagina per i finali marci, quelli che
					corrispondono alle scelte sbagliate.
				</p>
			</div>
		</div><div class="tab" id="tab-f1">
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
		</div><div class="tab" id="tab-f2">
			<div class="section">
	<p>
		Una volta radunate quindici puttane, tutto andò a posto.
	</p><p>
		Tutti vissero felici e contenti, tranne qualcuno che morì. FINE.
	</p>
			</div>
		</div>
	</div>
</div>
<?php } ?>
