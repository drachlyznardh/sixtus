<?php
	$d = $this->d;
	if ($this->addmeta ()) {
		$this->addtitle ('Camminavo', 'Ma dove non sapevo');
		$this->addnext ('Tru/Naluten/Vol.I/II/', 'Sacomne');
		$this->prepare ('tru/primo/index.php', false, false, true);
	} if ($this->addpage ()) {
?><div class="small">
	<div class="section">
		<p>
			Il primo capitolo di Tru Naluten &egrave; su Internet!
		</p><h2>
			Tru Naluten – Vol.I, I – Camminavo...
		</h2>
	</div><div class="section">
		<p>
			Sto camminando.
		</p><p>
			Sto camminando da tanto, tanto da non ricordare il luogo da cui sono
			partito. Tanto che neanche mi rendo conto di quello che faccio.
			Tanto che neanche ricordo dove sto andando.
		</p><p>
			Fortuna che non devo preoccuparmi di pensare alle gambe, che
			camminano da sole. Cos&igrave; posso concentrarmi su altre cose.
			Bene. Ho delle domande, quindi dovrei cercare qualcuno che mi
			risponda. Bene, adesso mi metto a cercare qualcuno. Si, cercare...
			uhm... guardo a destra: alberi. Guardo a sinistra: alberi. Guardo in
			alto: nuvolette. Guardo in basso: la strada. Guardo indietro: la
			strada che ho gi&agrave; fatto. Guardo avanti: la strada che devo
			ancora fare... Bene, sono solo.
		</p><p>
			Essere solo non mi aiuta, dovr&ograve; tentare di rispondere da me.
			Prima domanda:
		</p>
	</div><div class="section">
		<div class="inside"><p>
				<?=$d->inline('simak', 'Dove sono?')?>
		</p></div>
	</div><div class="section">
		<p>
			Dunque, sopra di me c'è il cielo, quindi sono all'aperto. Ai lati
			della strada ci sono alberi, quindi sono in una foresta. Non fa
			freddo, quindi non sono in quota. Bene.
		</p>
	</div><div class="section">
		<p>
			Bene. Ora:
		</p><div class="inside"><p>
				<?=$d->inline('simak', 'Dove sto andando?')?>
		</p></div><p>
			Beh, questo non lo ricordo.
		</p><div class="inside"><p>
				<?=$d->inline('simak', 'Da dove sono partito?')?>
		</p></div><p>
			Uhm, non ricordo neanche questo.
		</p><div class="inside"><p>
				<?=$d->inline('simak', 'Proviamo con una domanda pi&ugrave; basilare. Qual &egrave; il mio nome?')?>
		</p></div><p>
			Non trovo risposta, anzi, pensarci di dà un certo fastidio, tipo un
			cerchio alla testa. Intuisco di aver qualcosa che non va:
		</p><div class="inside"><p>
				<?=$d->inline ('simak', 'Soffro forse di amnesia?')?>
		</p></div><p>
			Stavolta, la risposta è:
		</p><div class="inside"><p>
				<?=$d->inline ('ci', 'Il tuo equilibrio mentale &egrave; momentaneamente destabilizzato a causa di');?>
			</p><p>
				<?=$d->inline ('ci', '[<span class="code">errore: causa sconosciuta</span>]')?>
			</p><p>
				<?=$d->inline ('ci','Tale disturbo potrebbe causare malfunzionamenti della memoria'); ?>
		</p></div>
	</div><div class="section">
		<p>
			Yo! Finalmente una risposta articolata e soddisfacente. Sarebbe
			bello sapere da dov'è venuta questa risposta:
		</p><div class="inside"><p>
			<?=$d->inline ('simak', 'Uh, c&apos;&egrave; qualcuno?')?>
		</p></div><p>
			Niente.
		</p><div class="inside"><p>
				<?=$d->inline ('simak', 'Quello che ho sentito era forse un&apos;allucinazione uditiva?')?>
			</p><p>
				<?=$d->inline ('ci', 'Nessuna anomalia sensoriale riscontrata')?>
		</div><p>
			Yo! Non me la sono sognata!
		</p>
	</div><div class="section">
		<div class="inside"><p>
				<?=$d->inline ('simak', 'C&apos;è davvero una voce che mi risponde?'); ?>
			</p><p>
				<?=$d->inline ('ci', 'Sì. C&apos;è'); ?>
		</p></div><p>
			Ah, figo! Ho una vocina che parla giallo che risponde alle mie
			domande. Questo potrebbe essere piuttosto utile. Credo che
			proverò ad usarla.
		</p>
	</div><div class="section">
		<div class="inside"><p>
				<?=$d->inline ('simak', 'Dunque, ci sei, vocina?')?>
			</p><p>
				<?=$d->inline ('ci', 'Stato: [<span class="code">operativa</span>]')?>
			</p><p>
				<?=$d->inline ('simak', 'Hai un nome?')?>
			</p><p>
				<?=$d->inline ('ci', 'Si')?>
			</p><p>
				<?=$d->inline ('simak', 'Ah. Qual &egrave; il tuo nome?')?>
			</p><p>
				<?=$d->inline ('ci', 'Identificativo: [<span class="code">Ci</span>]')?>
			</p><p>
				<?=$d->inline ('simak', 'Ci?')?>
			</p><p>
				<?=$d->inline ('ci', 'Dimmi')?>
			</p><p>
				<?=$d->inline ('simak', 'Dunque, Ci, giusto?')?>
			</p><p>
				<?=$d->inline ('ci', 'Corretto')?>
			</p><p>
				<?=$d->inline ('simak', 'Tu conosci il mio nome?')?>
			</p><p>
				<?=$d->inline ('ci', 'Si')?>
			</p><p>
				<?=$d->inline ('simak', 'Uhm. Sai dirmelo?')?>
			</p><p>
				<?=$d->inline ('ci', 'Si. Il tuo nome &egrave;')?>
			</p><p>
				<?=$d->inline ('ci', '[<span class="code">errore: memoria corrotta</span>]')?>
			</p><p>
				<?=$d->inline ('simak', 'Io mi chiamo “<span class="em">Errore: memoria corrotta</span>”?')?>
			</p><p>
				<?=$d->inline ('ci', 'Errato')?>
			</p><p>
				<?=$d->inline ('simak', 'Quindi non conosci il mio nome?')?>
			</p><p>
				<?=$d->inline ('ci', 'Si è verificato un grave errore di memoria')?>
			</p><p>
				<?=$d->inline ('ci', 'Eseguire un controllo? [<span class="code">s/n</span>]')?>
			</p><p>
				<?=$d->inline ('simak', 'Beh, perché no...')?>
			</p><p>
				<?=$d->inline ('ci', 'Attendere prego...')?>
		</p></div>
	</div><div class="section">
		<p>
			Credo che ora mi siederò un momento.
		</p><p>
			Allora, sono qui sperduto chissà dove, non ricordo praticamente
			nulla e c'è una vocina che mi risponde come una console di comando. Però
			so cos'è console di comando... più o meno.
		</p>
	</div><div class="section">
		<div class="inside"><p>
				<?=$d->inline ('simak', 'Ci, quanto durerà il controllo?')?>
			</p><p>
				<?=$d->inline ('ci', 'Controllo in corso [<span class="code">4%</span>]')?>
			</p><p>
				<?=$d->inline ('ci', 'Tempo residuo stimato: [<span class="code">13&apos;:20&quot;.043</span>]'); ?>
		</p></div>
	</div><div class="section">
		<p>
			Wow. Si possono fare un sacco di cose in tredici minuti. Imperi sono
			stati abbattuti, fortune sono andate perdute in tredici minuti... Io
			potrei, ad esempio, farmi un panino. Infatti, m'è venuto un buco
			allo stomaco. Mi chiedo:
		</p>
	</div><div class="section">
		<div class="inside"><p>
				<?=$d->inline ('simak', 'Ci sarà del cibo, qui vicino?')?>
			</p><p>
				<?=$d->inline ('lyz', 'Fiuto la presenza di numerose forme di vita animali nei paraggi, con buone probabilità di trovare carne bianca. Andiamo ad artigliare qualche bestiola!')?>
		</p></div><p>
			Ehi! Questa voce &egrave; nuova:
		</p><div class="inside"><p>
				<?=$d->inline ('simak', 'Chi sei tu?')?>
			</p><p>
				<?=$d->inline ('lyz', 'Io sono quello che può procurarti da mangiare!')?>
			</p><p>
				<?=$d->inline ('simak', 'Ce l&apos;hai un nome?')?>
			</p><p>
				<?=$d->inline ('lyz', 'Certo che ce l&apos;ho, cazzone! Non ti
				ricordi?')?>
			</p><p>
				<?=$d->inline ('simak', 'Ehr… un aiutino?')?> domando.
			</p><p>
				<?=$d->inline ('lyz', 'Io sono ' . $d->t ('la Sorgente', 'aDatol') . ' Lyz')?>
		</p></div><p>
			Questo nome non mi aiuta affatto.
		</p><div class="inside"><p>
				Ma potrei avere fortuna, quindi chiedo <?=$d->inline ('simak', 'Eh, senti, tu per caso sai chi sono?')?>
			</p><p>
				<?=$d->inline ('lyz', 'Mi prendi per il culo, capo? Qualunque stronzo sa che se il Lynn<span class="forte">nghahaaargh!!!</span>')?>
		</p></div>
	</div><div class="section">
		<p>
			La voce sembra presa da un attacco di dolore, e le mie orecchie
			fischiano intensamente. C'è sicuramente qualcosa che non va nella
			mia testa:
		</p><div class="inside"><p>
				<?=$d->inline ('simak', 'Cos&apos;&eacute;?')?>
			</p><p>
				<?=$d->inline ('ci', 'Attenzione!')?>
			</p><p>
				<?=$d->inline ('ci', '[<span class="code">Errore critico in accesso alla memoria</span>]')?>
			</p><p>
				<?=$d->inline ('lyz', '<span class="forte">'. $d->t ('Dannato Zathot', 'Shka&apos;Zathot!') .'</span> Questo fa male!')?>
		</p></div>
	</div><div class="section">
		<p>
			Sto rantolando per terra, e il <?=$d->t ('Istinto di colui che possiede eLyz', 'Lyztinto')?>
			mi dice di tenermi la testa. Ma c'è una buona notizia: vedo una
			bestiola di qualche tipo che sembra incuriosita alla vista del mio
			dolore e si sta avvicinando.
		</p><div class="inside"><p>
				<?=$d->inline ('lyz', 'Sta&apos;vvedere che mangiando &apos;sta cosa mi passa il mal di testa?')?>
		</p></div><p>
			La mia mano si muove da sola, e nemmeno so il perché. Ora ho la
			sensazione di qualcosa di peloso in bocca. Ora non ce l'ho più.
		</p><p>
			Il mio mal di testa cala, adesso ci vedo. Porto due dita alla bocca
			e sfilo quella cosa che sento tra i denti: è pelo grigiastro,
			credo fosse un coniglio selvatico…
		</p>
	</div>
</div><?php } ?>
