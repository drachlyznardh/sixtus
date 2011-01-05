<?php

	$page['title'] = 'Tru Naluten';
	$page['subtitle'] = 'Per saper dov&apos;andare';
	$page['side'] = 'trun.nav.php';

	function mkpage ($d, $s, $context) {
?>
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
	<?=mkcascade('ELyznardh', 'eLyznardh')?>
	<p>
		Se avete gi&agrave; letto i primi capitoli,
		saprete che eLyznardh &egrave; diviso in
		pi&ugrave; persone.
	</p>
</div>
<div class="wider" id="longELyznardh" style="display: none">
	<div class="floatleft">

		<div class="section">
			<a id="simak"></a>
			<?=mkcascade('simak','Simak')?>
			<p>
				Simak è il vero protagonista di tutta questa storia.
			</p>
			<div id="longsimak" style="display: none">
<p>
</p><p>
	Nato come più anziano dei sette fratelli Cheskalen, si dimostra
	immediatamente indipendente, immensamente rapido, brutalmente sincero e
	impunemente emozionale.
</p>
			</div>
		</div><div class="section">
			<a id="ci"></a>
			<h2>Ci</h2>
			<p>Si occupa della sicurezza, delle analisi e di fornire
			valutazioni. Non sempre utili.</p>
		</div><div class="section">
			<a id="lyz"></a>
			<h2>eLyz</h2>
			<p>Responsabile dell&apos;alimentazione, della
			arrabbiature e di varie altre cose.</p>
		</div><div class="section">
			<a id="lyznardh"></a>
			<h2>eLyznardh</h2>
			<p>Contenitore per i tre precedenti, dispone di risorse
			pressoch&eacute; illimitate. Oltre alle menti dei suoi
			tre &quot;inquilini&quot; ne ha una propria; questo gli
			provoca la parlata in terza persona ed alcuni
			imprevedibili cambi di personalit&agrave;.</p>
		</div> <!-- Section -->
	</div><div class="floatright">
		<div class="section">
			<?=mkcascade('ELyznardhlist', 'eLyznardh', false)?>
			<div id="longELyznardhlist">
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Simak', 'simak')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Ci', 'ci')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Lyz', 'lyz')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Lyznardh', 'lyznardh')?></p>
			</div>
		</div> <!-- Section -->
	</div>
</div>
<div class="section">
	<?=mkcascade('goodguys', 'Protagonisti')?>
	<p>
		Ci sono anche altri protagonisti, in effetti.
	</p>
</div>
<div class="wider" id="longgoodguys" style="display: none">
	<div class="floatleft">
		<div class="section">
			<a id="sacomne"></a>
			<?=mkcascade('sacomne','Sacomne')?>
			<p>L&apos;amata di Simak.</p>
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
		</div><div class="section">
			<a id="corona"></a>
			<?=mkcascade('corona', 'Corona')?>
			<p>Attualmente chiamata &laquo;Coscenza&raquo;</p>
			<div id="longcorona" style="display: none">
<p>
	Corona di Zathot, rivaleggia in potenza con il Lyz e conferisce a Simak il titolo di Enkà.
</p>
			</div>
		</div><div class="section">
			<a id="jo"></a>
			<h2>Jo</h2>
			<p>Ultima sopravvissuta di un perduto pianeta.</p>
		</div><div class="section">
			<a id="togan"></a>
			<h2>Togan</h2>
			<p>Luogotenente di DrachLyznardh.</p>
		</div><div class="section">
			<a id="a_simak"></a>
			<?=mkcascade('a_simak', 'Antico Simak')?>
			<div id="longa_simak" style="display: none">
<p>
	Il Simak originale, spesso dormiente per evitare la localizzazione,
	interviene nei momenti di bisogno per evitare che l'attuale Simak
	faccia cazzate.
</p>
			</div>
		</div> <!-- Section -->
	</div><div class="floatright">
		<div class="section">
			<?=mkcascade('goodlist', 'Protagonisti', false)?>
			<div id="longgoodlist">
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Sacomne', 'sacomne')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Corona', 'corona')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Jo', 'jo')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Togan', 'togan')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Antico Simak', 'a_simak')?></p>
			</div>
		</div> <!-- Section -->
	</div>
</div>
<div class="section">
	<?=mkcascade('badguys','Antagonisti')?>
	<p>
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
<div class="wider" id="longbadguys" style="display: none">
<div class="floatleft">
	<div class="section">
		<a id="son"></a>
		<?=mkcascade('son_enka', 'Il Primo &ndash; Son Enkà')?>
		<div id="longson_enka" style="display: none">
<p>
	Prima volont&agrave; di Zathot, primo Zathotan a valicare i confini di
	Cheskaldhum; morto per mano del Lyznardh.
</p>
		</div>
	</div><div class="section">
		<a id="vad"></a>
		<?=mkcascade('vad_enka', 'Il Secondo &ndash; Vad Enkà')?>
		<div id="longvad_enka" style="display: none">
<p>
	Seconda volont&agrave; di Zathot, giunta in soccorso di Son Enk&agrave;,
	fugg&igrave; da Cheskaldhum dopo aver recuperato la Corona,
	organizz&ograve; l'invasione di Umundhum; morto per mano del Lyznardh.
</p>
		</div>
	</div><div class="section">
		<a id="zan"></a>
		<?=mkcascade('zan_enka', 'Il Terzo &ndash; Enka Zan')?>
		<div id="longzan_enka" style="display: none">
<p>
	Terza volont&agrave; di Zathot, organizz&ograve; la grande invasione di
	Umundhum con l'esercito dei dannati; dopo l'annientamento del suo
	esercito, mor&igrave; per mano del Lyznardh.
</p>
		</div>
	</div><div class="section">
		<a id="zen"></a>
		<?=mkcascade('zen_enka', 'Il Quarto &ndash; Zen Enkà')?>
		<div  id="longzen_enka" style="display: none">
<p>
	Quarta volont&agrave; di Zathot, guid&ograve; il commando per la
	distruzione di Cheskaldhum, affront&ograve; eLyznardh in combattimento e
	lo spinse infine al tradimento; resse Cheskaldhum fino all&apos;arrivo
	del Quinto.
</p>
		</div>
	</div><div class="section">
		<a id="simak_enka"></a>
		<?=mkcascade('simak_enka', 'Il Quinto &ndash; Simák Enkà')?>
		<div id="longsimak_enka" style="display: none">
<p>
	Quinta volont&agrave; di Zathot, riconquist&ograve; Zathot con la forza,
	si mosse in segreto fino ai confini di Cheskaldhum, ne liber&ograve; i
	prigionieri, uccise eLyznardh, insegu&igrave; Vad Enk&agrave; fino a
	Zathot, lo sconfisse; infine, distrusse Zathot per poi andarsene
	libero.
</p><p>
	Tutto quel che fece, lo fece per riavere la libertà, per poter spendere
	il resto della sua vita al fianco di Sacomne.
</p>
			</div>
		</div> <!-- Section -->
		
</div> <!-- Content -->

<div class="floatright">
		<div class="section">
			<?=mkcascade('badlist', 'Antagonisti', false)?>
			<div id="longbadlist">
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Son_Enkà', 'son')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Vad_Enkà', 'vad')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Enka_Zan', 'zan')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Zen_Enkà', 'zen')?></p>
				<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Simák_Enkà', 'simak_enka')?></p>
			</div>
		</div>
</div>
<?php } ?>
