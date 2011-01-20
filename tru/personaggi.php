<?php

	$title=array('Personaggi', 'Per saper chi sono e dove vanno');

	function mkpage ($d) {
?>
<div class="small">
	<div class="section">
		<h2>Leggere con attenzione</h2>
		<p>
			Attenzione prego: questa pagina, oltre ad essere
			potentemente incompleta, non si preoccupa di
			eliminare eventuali spoiler; pertanto se
			girovagando qui doveste trovare informazioni che
			non avreste voluto trovare, prendetevela con voi
			stessi.
		</p>
	</div><div class="section">
		<h2 id="plus-ELyznardh" class="addable"
			onclick="javascript:dadd('ELyznardh','Tru/Naluten/char/elyznardh')">
			eLyznardh
		</h2><p>
			Se avete gi&agrave; letto i primi capitoli,
			saprete che eLyznardh &egrave; diviso in
			pi&ugrave; persone.
		</p>
	</div>
</div><div class="wider" id="dynamic-ELyznardh" style="display:none">
</div><div class="small">
	<div class="section">
		<h2 id="plus-goodguys" class="addable"
			onclick="javascript:dadd('goodguys','Tru/Naluten/char/goodguys')">
			Protagonisti
		</h2><p>
			Ci sono anche altri protagonisti, in effetti.
		</p>
	</div>
</div><div class="revwider" id="dynamic-goodguys" style="display:none">
</div><div class="small">
	<div class="section">
		<h2 id="plus-badguys" class="addable"
			onclick="javascript:dadd('badguys','Tru/Naluten/char/badguys')">
			Antagonisti
		</h2><p>
			Perché, anche se molti di voi non lo sa ancora,
			ci sono degli antagonisti, in Tru Naluten. Molti
			di essi sono già morti, in realtà. Ma alcuni
			sono ancora in agguato.
		</p>
	</div>
</div><div class="wider" id="dynamic-badguys" style="display:none">
</div><script type="text/javascript" src="lib/tloader.js"></script>
<?php } ?>
