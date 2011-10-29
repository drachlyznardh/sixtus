<?php
	$title=array('Sacomne', 'È nome');
	$prev=array('Tru/Naluten/Vol.I/I/', 'Capitolo I', '');
	$next=array('Tru/Naluten/Vol.I/III/', 'Capitolo III', false);
	function mkpage ($d) {
?>
<div class="small">
	<div class="section">
		<h2 class="titolo">Tru Naluten I, II &ndash; Sacomne</h2>
	</div><div class="section">
		<div class="inside">
			<?=$d->speak ('ci', 'Il tuo equilibrio mentale &egrave; momentaneamente destabilizzato a causa di [<span class="em">errore: causa sconosciuta</span>]. Tale disturbo potrebbe causare malfunzionamenti della memoria'); ?>
		</div>
	</div><div class="section">
		<p>Ho del pelo in bocca. Non sono sicuro questa cosa che mi piaccia... No, decisamente non piace. Ora vorrei sapere cosa &egrave; successo:</p>
		<div class="inside">
			<?=$d->speak ('simak', 'Mh, Ci, dammi una spiegazione'); ?>
			<?=$d->speak ('ci', 'Si &egrave; verificato un fallimento nel tentativo di lettura di dati riservati, ossia [<span class="em">accesso negato</span>]'); ?>
		</div>
		<p>Qualunque cosa significhi questo, non credo sia un bene:</p>
		<div class="inside">
			<?=$d->speak ('simak', 'Dunque, qualcuno ti sta impedendo di ricordarti di me, giusto?'); ?>
			<?=$d->speak ('ci', '[<span class="em">Errato</span>]'); ?>
			<?=$d->speak ('simak', 'Chi te lo sta impedendo, quindi? Sei tu a non volermelo dire?'); ?>
			<?=$d->speak ('ci', 'Accesso negato [<span class="em">utente non riconosciuto</span>]'); ?>
			<?=$d->speak ('simak', 'Senti un po&apos;, credevo prendessi ordini da me. O che almeno mi stessi ad ascoltare...'); ?>
			<?=$d->speak ('ci', 'L&apos;utente attuale [<span class="em">sconosciuto</span>] non ha autorit&agrave; sufficiente'); ?>
			<?=$d->speak ('simak', 'Allora chi ha autorit&agrave; sufficiente?'); ?>
			<?=$d->speak ('ci', 'L&apos;Amministratore del Sistema'); ?>
			<?=$d->speak ('simak', 'Chi &egrave; l&apos;amministratore del sistema?'); ?>
			<?=$d->speak ('ci', 'Accesso negato'); ?>
			<?=$d->speak ('simak', 'Qual&apos;&egrave; il mio livello di autorit&agrave;?'); ?>
			<?=$d->speak ('ci', 'Il livello di autorit&agrave; di [<span class="em">sconosciuto</span>] &egrave; Amminshhhtr... shh... zzzzzz... sh...'); ?>
			<?=$d->speak ('simak', 'Ehi, Ci, che succede... c&apos;&egrave;... forse... un... probl...'); ?>
		</div>
		<p>Oh, la mia testa, sta, diventando, pesante. Ehi, perch&eacute; il terreno si sta avvicinando cos&igrave; in fretta?</p>
		<div class="inside">
			<?=$d->speak ('simak', 'Cos&apos;&egrave; questa sensazione?'); ?>
		</div>
	</div><div class="section">
		<p>Questo...</p>
		<p>&egrave;...</p>
		<p>l&apos;<span class="em" title="che significa: &laquo;Sonnolenza da digestione&raquo;">Abiocco</span></p>
		<div class="dream">
			<?=$d->speak ('togan', '... <span title="che significa: &laquo;Principe&raquo;">Drach</span>? ... <span title="che significa: &laquo;Mio Principe&raquo;">TanDrach</span>? ... mi sentite?'); ?>
			<p>Mhh... la mia testa...</p>
			<?=$d->speak ('togan', '... TanDrach? ... Zathot &egrave; alle porte, ci invadono! Vostro fratello ha ordinato l&apos;adunata di tutte le forze di Cheskaldhum. Tutte, compreso voi.'); ?>
		</div>
		<p>Tutte, compreso voi</p>
		<p>vostro fratello...</p>
		<p>ha ordinato l&apos;adunata...</p>
		<p>Zathot &egrave; alle porte...</p>
		<p>TanDrach?</p>
		<div class="dream">
			<p>Chi <span class="em">shka&apos;dhum</span> &egrave; questo tizio che mi parla? Perch&egrave; non vedo niente? E dove sono? Ci? Lyz? C&apos;&egrave; nessuno qui?</p>
			<?=$d->speak ('corona', 'Questo &egrave; un dream...'); ?>
			<p>Ah, davvero? L&apos;avevo intuito. Non &egrave; normale che tutto diventi nero e che uno arrivi chiamandoti per chiss&agrave; quale casino infernale. Non vedo niente... non sento niente... la voce di prima se n&apos;&eacute; andata...</p>
			<p>Ehil&agrave;? C&apos;&eacute; nessuno? Avrei bidream di una mano, qui, aiuto!?</p>
		</div>
	</div><div class="section">
		<div class="dream">
			<?=$d->speak ('corona', 'Questo &egrave;'); ?>
			<?=$d->speak ('sacomne', 'Amore, sono qui'); ?>
			<?=$d->speak ('corona', 'un sogno...'); ?>
		</div>
	</div><div class="section">
		<div class="dream">
			<p>Eh, c&apos;&eacute; un&apos;altra voce! &Egrave; una voce nuova...</p>
			<?=$d->speak ('sacomne', 'Amore, svegliati!'); ?>
			<p>Qual&apos;&egrave; il problema, sono sveglio. Ti sento bene ...</p>
			<?=$d->speak ('sacomne', 'Non mi troverai se prima non trovi te stesso. Cerca ...'); ?>
			<p>Che significa questo, cos&apos;&eacute; che dovrei cercare?</p>
			<?=$d->speak ('sacomne', 'Trova te stesso, ricorda...'); ?>
			<p>Cosa? Chi sei tu? Perch&eacute; mi dici questo?</p>
			<?=$d->speak ('sacomne', 'Tu sai chi sono ...'); ?>
			<p>Lo so?</p>
			<?=$d->speak ('corona', 'Questo &egrave; un sogno...'); ?>
		</div>
	</div><div class="section">
		<div class="dream">
			<p>Beh, che succede?</p>
			<p>Ehi, dove sono finiti tutti? Dov&apos;&egrave; quella voce rossa che mi dice che sto sognando, eh?</p>
			<p>Questi vuoti cominciano ad essere fastidiosi... Non riesco a pensare in queste condizioni...</p>
		</div>
	</div><div class="section">
		<div class="dream">
			<?=$d->speak ('lyznardh', 'Stai ascoltando quello che dici?'); ?>
			<?=$d->speak ('simak', 'Uhm, si....'); ?>
			<?=$d->speak ('lyznardh', 'Davvero? Ascoltati bene, parli come una donnetta.'); ?>
			<?=$d->speak ('simak', 'Ehi, piano. Chi sei tu?'); ?>
			<?=$d->speak ('lyznardh', 'Chi sono io non ha importanza. Chi sei tu, invece?'); ?>
			<?=$d->speak ('simak', 'Io, non lo ricordo.'); ?>
			<?=$d->speak ('lyznardh', 'Dunque, che cerchi?'); ?>
			<?=$d->speak ('simak', 'Ehr... non lo so...'); ?>
			<?=$d->speak ('lyznardh', 'Sbrigati. Se non ti dai una mossa, non ti dimostrerai all&apos;altezza.'); ?>
			<?=$d->speak ('simak', 'Di cosa?'); ?>
			<?=$d->speak ('lyznardh', 'Il tuo compito non &egrave; cambiato, &egrave; lo stesso mestiere dei tuoi predecessori: c&apos;&eacute; un solo posto dove andare, una sola cosa da fare, un solo avversario da affrontare.'); ?>
			<?=$d->speak ('simak', 'Chi &egrave; il mio avversario?'); ?>
			<?=$d->speak ('lyznardh', 'Davvero non ricordi?'); ?>
			<?=$d->speak ('simak', 'Cosa?'); ?>
		</div>
	</div><div class="section">
		<div class="dream">
			<?=$d->speak ('lyznardh', 'Io sono il tuo avversario'); ?>
			<?=$d->speak ('ci', 'Io sono il tuo avversario'); ?>
			<?=$d->speak ('lyz', 'Io sono il tuo avversario'); ?>
			<p>Io sono il tuo avversario.</p>
			<?=$d->speak ('togan', 'Io sono il tuo avversario'); ?>
			<?=$d->speak ('corona', 'Io sono il tuo avversario'); ?>
			<?=$d->speak ('lyznardh', 'Io sono il tuo avversario'); ?>
		</div>
	</div><div class="section">
		<div class="dream">
			<p>Oh, rallentiamo. Non sto capendo nulla. Tutti questi sono miei avversari? Sono solo, quindi?</p>
			<?=$d->speak ('sacomne', 'Non sei solo'); ?>
			<p>Ancora tu! Se anche tu un mio avversario?</p>
			<?=$d->speak ('sacomne', 'Che dici, sciocchino? Io sto con te!'); ?>
			<p>Con me?</p>
			<?=$d->speak ('sacomne', 'Si, con te. Tu lo sai'); ?>
			<p>Io non mi ricordo di te... non so chi sei...</p>
			<?=$d->speak ('sacomne', 'Devi saperlo. Hai promesso'); ?>
			<p>Cosa ho promesso?</p>
			<?=$d->speak ('sacomne', 'Di tornare da me'); ?>
			<p>E sono in ritardo?</p>
			<?=$d->speak ('sacomne', 'Ricordati. Chi sei tu &egrave; scolpito nel tuo cuore. Il tuo cuore non &egrave; perduto'); ?>
			<p>Come fai ad esserne certa?</p>
			<?=$d->speak ('sacomne', 'Il tuo cuore &egrave; al sicuro: lo hai affidato a me, cos&igrave; come io ho affidato a te il mio. Ti guider&agrave; dove devi andare...'); ?>
			<p>Io, come posso fidarmi di te?</p>
			<?=$d->speak ('sacomne', 'Questo puoi scoprirlo solo da te. Ricorda il mio nome, e chiamami: verr&ograve; ad aiutarti ... Ora, devi svegliarti'); ?>
			<p>Ho sognato abbastanza? Beh, allora arrivederci, voce...</p>
			<?=$d->speak ('sacomne', 'Ah, aspetta...'); ?>
			<p>Cosa?</p>
			<?=$d->speak ('sacomne', 'Ti amo'); ?>
			<?=$d->speak ('simak', 'Anch&apos;io ti amo... Sacomne...'); ?>
		</div>
		<?=$d->speak ('dream1', 'Questo'); ?>
		<?=$d->speak ('dream2', 'era'); ?>
		<?=$d->speak ('dream3', 'un <span class="em">Abiocco</span> da panico!'); ?>
	</div><div class="section">
		<p>Credo di essere sveglio, ora.</p>
		<div class="inside">
			<?=$d->speak ('simak', 'Wow'); ?>
			<?=$d->speak ('ci', 'Gi&agrave;'); ?>
			<?=$d->speak ('lyz', 'L&apos;hai detto, sorella!'); ?>
			<?=$d->speak ('simak', 'Voi avete capito qualcosa?'); ?>
			<?=$d->speak ('ci', 'Direi di no'); ?>
			<?=$d->speak ('lyz', '<span class="em" title="che significa: &laquo;Porco Mondo&raquo;">Shka&apos;dhum</span>, amico, non so te, ma io c&apos;ho capito un <span class="em" title="che significa: &laquo;nulla al Mondo&raquo;">du&apos;Umundhum!!!</span>'); ?>
		</div>
		<p>Ma, perch&eacute; voi c&apos;eravate?</p>
		<p>Allora, qualcuno da qualche parte sta invadendo qualcosa... Ho un fratello che ordina l&apos;adunata... Tutti quelli che ho incontrato finota sono miei avversari, e c&apos;&egrave; quella voce di cui non conosco il nome che dice delle assurdit&agrave;. Questo non &egrave; certo un buon risveglio...</p>
		<p>Chiss&agrave; se quel tipo laggi&ugrave; pu&ograve; offrirmi un caffe:</p>
		<div class="esterno">
			<?=$d->speak ('lyznardh', 'Scusi, lei! Buongiorno! Avrebbe mica del caff&eacute;?'); ?>
		</div>
	</div>
</div>
<?php } ?>
