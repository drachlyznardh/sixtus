<?php
	$d = $this->d;
	if ($this->addmeta()) {
		$this->addtitle ('Personaggi', 'Per saper chi sono e dove vanno', 'spoiler');
		$this->prepare ('tru/index.php', false, false, true);
	} if ($this->addpage ()) {
?>
<div class="small">
	<?php if ($d->mktab('spoiler')) { ?><div class="section">
		<h2>
			Leggere con attenzione
		</h2><p>
			Attenzione prego: questa pagina, oltre ad essere potentemente
			incompleta, non si preoccupa di eliminare eventuali spoiler;
			pertanto se girovagando qui doveste trovare informazioni che non
			avreste voluto trovare, prendetevela con voi stessi.
		</p>
	</div><?php } if ($d->mktab('lyznardh')) {?><div class="section">
		<a id="Simak"></a><h2>
			Simak
		</h2><p>
			Simak è il vero protagonista di tutta questa storia.
		</p><p>
			Nato come più anziano dei sette fratelli Cheskalen, si dimostra
			immediatamente indipendente, immensamente rapido, brutalmente sincero e
			impunemente emozionale.
		</p>
	</div><div class="section">
		<a id="Ci"></a><h2>
			Ci
		</h2><p>
			Si occupa della sicurezza, delle analisi e di fornire valutazioni - non
			sempre utili - Ci è indissolubilmente legata al Lyz e controlla la
			maggior parte dei suoi sistemi.
		</p>
	</div><div class="section">
		<a id="Lyz"></a><h2>
			eLyz
		</h2><p>
			Responsabile dell&apos;alimentazione, della arrabbiature e di varie
			altre cose, il Lyz è la fonte di energia del Lyznardh.
		</p>
	</div><div class="section">
		<a id="eLyznardh"></a><h2>
			eLyznardh
		</h2><p>
			Contenitore per i tre precedenti, dispone di risorse pressoch&eacute;
			illimitate. Oltre alle menti dei suoi tre &quot;inquilini&quot; ne ha
			una propria; questo gli provoca la parlata in terza persona ed alcuni
			imprevedibili cambi di personalit&agrave;.
		</p>
	</div><?php } if ($d->mktab('protagonisti')) { ?><div class="section">
		<a id="Jo"></a><h2>
			Jo
		</h2><p>
			Ultima sopravvissuta di un perduto pianeta.
		</p>
	</div><div class="section">
		<a id="Sacomne"></a><h2>
			Sacomne
		</h2><p>
			L&apos;amata di Simak.
		</p><p>
			Prima e durante la fondazione di Umundhum, Sacomne è stata la compagnia
			di Simak tra i Cheskalen.
		</p><p>
			Rimansta abbandonata per via del sonno di Simak, Sacomne trascorse in
			isolamento tutto il periodo che intercorre tra la venuta delle due
			Volontà, fino all'apparizione della terza.
		</p>
	</div><div class="section">
		<a id="Togan"></a><h2>
			Togan
		</h2><p>
			Luogotenente di DrachLyznardh.
		</p>
	</div><div class="section">
		<a id="Corona"></a><h2>
			Corona
		</h2><p>
			Attualmente chiamata “Coscenza”.
		</p><p>
			Corona di Zathot, rivaleggia in potenza con il Lyz e conferisce a Simak
			il titolo di Enkà.
		</p>
	</div><div class="section">
		<a id="AnticoSimak"></a><h2>
			Antico Simak
		</h2><p>
			Il Simak originale, spesso dormiente per evitare la localizzazione,
			interviene nei momenti di bisogno per evitare che l'attuale Simak faccia
			cazzate.
		</p>
	</div><?php } if ($d->mktab('antagonisti')) { ?><div class="section">
		<a id="SonEnkà"></a><h2>
			Il Primo – Son Enkà
		</h2><p>
			Prima volont&agrave; di Zathot, primo Zathotan a valicare i confini di
			Cheskaldhum; morto per mano del Lyznardh.
		</p>
	</div><div class="section">
		<a id="VadEnkà"></a><h2>
			Il Secondo – Vad Enkà
		</h2><p>
			Seconda volont&agrave; di Zathot, giunta in soccorso di Son Enk&agrave;,
			fugg&igrave; da Cheskaldhum dopo aver recuperato la Corona,
			organizz&ograve; l'invasione di Umundhum; morto per mano del Lyznardh.
		</p>
	</div><div class="section">
		<a id="EnkaZan"></a><h2>
			Il Terzo – Enka Zan
		</h2><p>
			Terza volont&agrave; di Zathot, organizz&ograve; la grande invasione di
			Umundhum con l'esercito dei dannati; dopo l'annientamento del suo
			esercito, mor&igrave; per mano del Lyznardh.
		</p>
	</div><div class="section">
		<a id="ZenEnkà"></a><h2>
			Il Quarto – Zen Enkà
		</h2><p>
			Quarta volont&agrave; di Zathot, guid&ograve; il commando per la
			distruzione di Cheskaldhum, affront&ograve; eLyznardh in combattimento e
			lo spinse infine al tradimento; resse Cheskaldhum fino all&apos;arrivo
			del Quinto.
		</p>
	</div><div class="section">
		<a id="SimàkEnkà"></a><h2>
			Il Quinto – Simák Enkà
		</h2><p>
			Quinta volont&agrave; di Zathot, riconquist&ograve; Zathot con la forza,
			si mosse in segreto fino ai confini di Cheskaldhum, ne liber&ograve; i
			prigionieri, uccise eLyznardh, insegu&igrave; Vad Enk&agrave; fino a
			Zathot, lo sconfisse; infine, distrusse Zathot per poi andarsene
			libero.
			</p><p>
			Tutto quel che fece, lo fece per riavere la libertà, per poter spendere
			il resto della sua vita al fianco di Sacomne.
		</p>
	</div><?php } ?>
</div><?php
	} if ($this->addside ()) {
?><div class="section">
	<p>
		<?=$d->mktid('Spoiler', 'spoiler')?>
	</p><h2 class="reverse">
		Tru Naluten
	</h2><h3>
		<?=$d->mktid('eLyznardh', 'lyznardh')?>
	</h3><p class="reverse">
		<?=$d->mktid('Simak', 'lyznardh', 'Simak')?>
		/ <?=$d->mktid('Ci', 'lyznardh', 'Ci')?>
		/ <?=$d->mktid('Lyz', 'lyznardh', 'Lyz')?>
		/ <?=$d->mktid('eLyznardh', 'lyznardh', 'eLyznardh')?>
	</p><h3>
		<?=$d->mktid('Protagonisti', 'protagonisti')?>
	</h3><p class="reverse">
		<?=$d->mktid('Jo', 'protagonisti', 'Jo')?>
		/ <?=$d->mktid('Sacomne', 'protagonisti', 'Sacomne')?>
		/ <?=$d->mktid('Togan', 'protagonisti', 'Togan')?>
	</p><p class="reverse">
		<?=$d->mktid('Corona', 'protagonisti', 'Corona')?>
		/ <?=$d->mktid('Antico Simak', 'protagonisti', 'AnticoSimak')?>
	</p><h3>
		<?=$d->mktid('Antagonisti', 'antagonisti')?>
	</h3><p class="reverse">
		<?=$d->mktid('Son Enkà', 'antagonisti', 'SonEnkà')?>
		/ <?=$d->mktid('Vad Enkà', 'antagonisti', 'VanEnkà')?>
	</p><p class="reverse">
		<?=$d->mktid('Enka Zan', 'antagonisti', 'EnkaZan')?>
		/ <?=$d->mktid('Zen Enkà', 'antagonisti', 'ZenEnkà')?>
	</p><p class="reverse">
		<?=$d->mktid('Simàk Enkà', 'antagonisti', 'SimàkEnkà')?>
	</p>
</div><?php
	};
?>
