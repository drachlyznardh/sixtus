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
</div><div class="wider" id="dynamic-ELyznardh">
	<div class="widecontent" id="ELyznardh-tab">
		<div class="tab" id="tabsimak"> 
			<div class="section">
				<h2 id="arrowsimak" class="closed" onclick="javascript:cascade('simak')">
					Simak
				</h2><a id="simak"></a>
				<p>
					Simak è il vero protagonista di tutta questa storia.
				</p>
				<div id="longsimak" style="display: none">
	<p>
		Nato come più anziano dei sette fratelli Cheskalen, si dimostra
		immediatamente indipendente, immensamente rapido, brutalmente sincero e
		impunemente emozionale.
	</p>
				</div>
			</div>
		</div><div class="tab" id="tabci" style="display:none">
			<div class="section">
				<a id="ci"></a>
				<h2>Ci</h2>
				<p>Si occupa della sicurezza, delle analisi e di fornire
				valutazioni. Non sempre utili.</p>
			</div>
		</div><div class="tab" id="tablyz" style="display:none">
			<div class="section">
				<a id="lyz"></a>
				<h2>eLyz</h2>
				<p>Responsabile dell&apos;alimentazione, della
				arrabbiature e di varie altre cose.</p>
			</div>
		</div><div class="tab" id="tablyznardh" style="display:none">
			<div class="section">
				<a id="lyznardh"></a>
				<h2>eLyznardh</h2>
				<p>Contenitore per i tre precedenti, dispone di risorse
				pressoch&eacute; illimitate. Oltre alle menti dei suoi
				tre &quot;inquilini&quot; ne ha una propria; questo gli
				provoca la parlata in terza persona ed alcuni
				imprevedibili cambi di personalit&agrave;.</p>
			</div> <!-- Section -->
		</div>
	</div><div class="widelist">
		<div class="section">
			<h2 id="straightELyznardh" class="wider reverse"
				onclick="javascript:reverse('ELyznardh')">
				eLyznardh
			</h2><p><a onclick="javascript:showTab('ELyznardh-tab','tabsimak')">Simak</a></p>
			<p><a onclick="javascript:showTab('ELyznardh-tab','tabci')">Ci</a></p>
			<p><a onclick="javascript:showTab('ELyznardh-tab','tablyz')">Lyz</a></p>
			<p><a onclick="javascript:showTab('ELyznardh-tab','tablyznardh')">Lyznardh</a></p>
		</div> <!-- Section -->
	</div>
</div><div class="small">
	<div class="section">
		<h2 id="arrow" class="closed"
			onclick="javascript:cascade('goodguys')">
			Protagonisti
		</h2><p>
			Ci sono anche altri protagonisti, in effetti.
		</p>
	</div>
</div><div class="revwider" id="longgoodguys">
	<div class="widecontent" id="goodguystab">
		<div class="tab" id="tabsacomne">
			<div class="section">
				<a id="sacomne"></a>
				<h2 id="arrowsacomne" class="closed"
					onclick="javascript:cascade('sacomne')">
					Sacomne
				</h2><p>L&apos;amata di Simak.</p>
				<div id="longsacomne" style="display: none">
	<p>
		Prima e durante la fondazione di Umundhum, Sacomne è stata la compagnia
		di Simak tra i Cheskalen.
	</p><p>
		Rimansta abbandonata per via del sonno di Simak, Sacomne trascorse in
		isolamento tutto il periodo che intercorre tra la venuta delle due
		Volontà, fino all'apparizione della terza.
	</p>
				</div>
			</div>
		</div><div class="tab" id="tabcorona">
			<div class="section">
				<a id="corona"></a>
				<h2 id="arrowcorona" class="closed"
					onclick="javascript:cascade('corona')">
					Corona
				</h2><p>Attualmente chiamata &laquo;Coscenza&raquo;</p>
				<div id="longcorona" style="display: none">
	<p>
		Corona di Zathot, rivaleggia in potenza con il Lyz e conferisce a Simak il titolo di Enkà.
	</p>
				</div>
			</div>
		</div><div class="tab" id="tabjo">
			<div class="section">
				<a id="jo"></a>
				<h2>Jo</h2>
				<p>Ultima sopravvissuta di un perduto pianeta.</p>
			</div>
		</div><div class="tab" id="tabtogan">
			<div class="section">
				<a id="togan"></a>
				<h2>Togan</h2>
				<p>Luogotenente di DrachLyznardh.</p>
			</div>
		</div><div class="tab" id="tabasimak">
			<div class="section">
				<a id="a_simak"></a>
				<h2 id="arrow" class="closed"
					onclick="javascript:cascade('a_simak')">
					Antico Simak
				<div id="longa_simak" style="display: none">
	<p>
		Il Simak originale, spesso dormiente per evitare la localizzazione,
		interviene nei momenti di bisogno per evitare che l'attuale Simak
		faccia cazzate.
	</p>
				</div>
			</div>
		</div>
	</div><div class="widelist">
		<div class="section">
			<h2 id="arrowgoodguys" class="wider reverse"
				onclick="javascript:reverse('goodguys')">
				Protagonisti
			</h2><p>
				<a onclick="javascript:showTab('goodguystab', 'tabsacomne')">Sacomne</a>
			</p><p>
				<a onclick="javascript:showTab('goodguystab', 'tabcorona')">Corona</a>
			</p><p>
				<a onclick="javascript:showTab('goodguystab', 'tabjo')">Jo</a>
			</p><p>
				<a onclick="javascript:showTab('goodguystab', 'tabtogan')">Togan</a>
			</p><p>
				<a onclick="javascript:showTab('goodguystab', 'tabsimak')">Antico Simak</a>
			</p>
		</div> <!-- Section -->
	</div>
</div><div class="small">
	<div class="section">
		<h2 id="arrow" class="closed"
			onclick="javascript:cascade('badguys')">
			Antagonisti
		</h2><p>
			Perché, anche se molti di voi non lo sa ancora,
			ci sono degli antagonisti, in Tru Naluten. Molti
			di essi sono già morti, in realtà. Ma alcuni
			sono ancora in agguato.
		</p><p>
			Questa sezione &egrave; chiusa per via dei gravi
			spoiler che comporta.
		</p><p>
			Cliccate pure sul men&ugrave; a destra per
			evindenziarne il contenuto.
		</p>
	</div>
</div><div class="wider" id="longbadguys">
	<div class="widecontent" id="badguys-tab">
		<div class="tab" id="secson_enka">
			<div class="section">
				<h2>
					Il Primo &ndash; Son Enkà
				</h2><a id="son"></a><p>
					Prima volont&agrave; di Zathot, primo
					Zathotan a valicare i confini di
					Cheskaldhum; morto per mano del
					Lyznardh.
				</p>
			</div>
		</div><div class="tab" id="secvad_enka" style="display:none">
			<div class="section">
				<h2>
					Il Secondo &ndash; Vad Enkà
				</h2><a id="vad"></a><p>
					Seconda volont&agrave; di Zathot, giunta
					in soccorso di Son Enk&agrave;,
					fugg&igrave; da Cheskaldhum dopo aver
					recuperato la Corona, organizz&ograve;
					l'invasione di Umundhum; morto per mano
					del Lyznardh.
				</p>
			</div>
		</div><div class="tab" id="seczan_enka" style="display:none">
			<div class="section">
				<h2>
					Il Terzo &ndash; Enka Zan
				</h2><a id="zan"></a><p>
					Terza volont&agrave; di Zathot,
					organizz&ograve; la grande invasione di
					Umundhum con l'esercito dei dannati;
					dopo l'annientamento del suo esercito,
					mor&igrave; per mano del Lyznardh.
				</p>
			</div>
		</div><div class="tab" id="seczen_enka" style="display:none">
			<div class="section">
				<h2>
					Il Quarto &ndash; Zen Enkà
				</h2><a id="zen"></a><p>
					Quarta volont&agrave; di Zathot,
					guid&ograve; il commando per la
					distruzione di Cheskaldhum,
					affront&ograve; eLyznardh in
					combattimento e lo spinse infine al
					tradimento; resse Cheskaldhum fino
					all&apos;arrivo del Quinto.
				</p>
			</div>
		</div><div class="tab" id="secsimak_enka" style="display:none">
			<div class="section">
				<h2>
					Il Quinto &ndash; Simák Enkà
				</h2><a id="simak_enka"></a><p>
					Quinta volont&agrave; di Zathot,
					riconquist&ograve; Zathot con la forza,
					si mosse in segreto fino ai confini di
					Cheskaldhum, ne liber&ograve; i
					prigionieri, uccise eLyznardh,
					insegu&igrave; Vad Enk&agrave; fino a
					Zathot, lo sconfisse; infine, distrusse
					Zathot per poi andarsene libero.
				</p><p>
					Tutto quel che fece, lo fece per riavere
					la libertà, per poter spendere il resto
					della sua vita al fianco di Sacomne.
				</p>
			</div>
		</div>
	</div><div class="widelist">
		<div class="section">
			<h2 id="straightbadguys" class="wider reverse"
				onclick="javascript:reverse('badguys')">
				Antagonisti
			</h2><p>
				<a onclick="javascript:showTab('badguys-tab', 'secson_enka')">Son Enkà
			</p><p>
				<a onclick="javascript:showTab('badguys-tab', 'secvad_enka')">Vad Enkà
			</p><p>
				<a onclick="javascript:showTab('badguys-tab', 'seczan_enka')">Enka Zan
			</p><p>
				<a onclick="javascript:showTab('badguys-tab', 'seczen_enka')">Zen Enkà
			</p><p>
				<a onclick="javascript:showTab('badguys-tab', 'secsimak_enka')">Simak Enkà
			</p>
		</div>
	</div>
</div>
<?php } ?>
