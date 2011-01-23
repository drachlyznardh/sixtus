<?php

	$title=array('Camminavo', 'Ma dove non sapevo');
	$next=array('Capitolo II', 'Tru/Naluten/II/');

	function mkpage ($d) {
?>
<div class="small">
	<div class="section">
		<p>Il primo capitolo di Tru Naluten &egrave; su Internet!</p>
		<h2>Tru Naluten I, I &ndash; Camminavo...</h2>
	</div><div class="section">
		<p>Sto camminando.</p>
		<p>Sto camminando da tanto, tanto da non ricordare il luogo da cui sono partito. Tanto che neanche mi rendo conto di quello che faccio. Tanto che neanche ricordo dove sto andando.</p>
		<p>Fortuna che non devo preoccuparmi di pensare alle gambe, che camminano da sole. Cos&igrave; posso concentrarmi su altre cose. Bene. Ho delle domande, quindi dovrei cercare qualcuno che mi risponda. Bene, adesso mi metto a cercare qualcuno. Si, cercare... uhm... guardo a destra: alberi. Guardo a sinistra: alberi. Guardo in alto: nuvolette. Guardo in basso: la strada. Guardo indietro: la strada che ho gi&agrave; fatto. Guardo avanti: la strada che devo ancora fare... Bene, sono solo.</p>
		<p>Essere solo non mi aiuta, dovr&ograve; tentare di rispondere da me. Prima domanda:</p>
	</div><div class="section">
		<div class="inside">
			<?php $d->speak ('simak', 'Dove sono?'); ?>
		</div>
	</div><div class="section">
		<p>Dunque, sopra di me c&apos;&egrave; il cielo, quindi sono all&apos;aperto. Ai lati della strada ci sono alberi, quindi sono in una foresta. Non fa freddo, quindi non sono in quota. Bene.</p>
	</div><div class="section">
		<p>Bene. Ora:</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Dove sto andando?'); ?>
		</div>
		<p>Beh, questo non lo ricordo.</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Da dove sono partito?'); ?>
		</div>
		<p>Uhm, non ricordo neanche questo.</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Proviamo con una domanda pi&ugrave; basilare. Qual &egrave; il mio nome?'); ?>
		</div>
		<p>Non trovo risposta, anzi, pensarci di d&agrave; un certo fastidio, tipo un cerchio alla testa. Intuisco di aver qualcosa che non va:</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Soffro forse di amnesia?'); ?>
		</div>
		<p>Stavolta, la risposta &egrave;:</p>
		<div class="inside">
			<?php $d->speak ('ci', 'Il tuo equilibrio mentale &egrave; momentaneamente destabilizzato a causa di [<span class="em">errore: causa sconosciuta</span>]. Tale disturbo potrebbe causare malfunzionamenti della memoria'); ?>
		</div>
	</div><div class="section">
		<p>Yo! Finalmente una risposta articolata e soddisfacente. Sarebbe bello sapere da dov&apos;&egrave; venuta questa risposta:</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Uh, c&apos;&egrave; qualcuno?'); ?>
		</div>
		<p>Niente.</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Quello che ho sentito era forse un&apos;allucinazione uditiva?'); ?>
			<?php $d->speak ('ci', 'Nessuna anomalia sensoriale registrata'); ?>
		</div>
		<p>Yo! Non me la sono sognata!</p>
	</div><div class="section">
		<div class="inside">
			<?php $d->speak ('simak', 'C&apos;&egrave; davvero una voce che mi risponde?'); ?>
			<?php $d->speak ('ci', 'S&igrave;. C&apos;&egrave;'); ?>
		</div>
		<p>Ah, figo! Ho una vocina che parla giallo che risponde alle mie domande. Questo potrebbe essere piuttosto utile. Credo che prover&ograve; ad usarla.</p>
	</div><div class="section">
		<div class="inside">
			<?php $d->speak ('simak', 'Dunque, ci sei, vocina?'); ?>
			<?php $d->speak ('ci', 'Stato: [<span class="em">operativa</span>]'); ?>
			<?php $d->speak ('simak', 'Hai un nome?'); ?>
			<?php $d->speak ('ci', 'Si'); ?>
			<?php $d->speak ('simak', 'Ah. Qual &egrave; il tuo nome?'); ?>
			<?php $d->speak ('ci', 'Identificativo: [<span class="em">Ci</span>]'); ?>
			<?php $d->speak ('simak', 'Ci?'); ?>
			<?php $d->speak ('ci', 'Dimmi'); ?>
			<?php $d->speak ('simak', 'Dunque, Ci, giusto?'); ?>
			<?php $d->speak ('ci', 'Corretto'); ?>
			<?php $d->speak ('simak', 'Tu conosci il mio nome?'); ?>
			<?php $d->speak ('ci', 'Si'); ?>
			<?php $d->speak ('simak', 'Uhm. Sai dirmelo?'); ?>
			<?php $d->speak ('ci', 'Si. Il tuo nome &egrave; [<span class="em">errore: memoria corrotta</span>]'); ?>
			<?php $d->speak ('simak', 'Io mi chiamo &quot;<span class="em">Errore: memoria corrotta</span>&quot;?'); ?>
			<?php $d->speak ('ci', 'Errato'); ?>
			<?php $d->speak ('simak', 'Quindi non conosci il mio nome?'); ?>
			<?php $d->speak ('ci', 'Si &egrave; verificato un grave errore di memoria. Eseguire un controllo? [s/n]'); ?>
			<?php $d->speak ('simak', 'Beh, perch&egrave; no...'); ?>
			<?php $d->speak ('ci', 'Attendere prego...'); ?>
		</div>
	</div><div class="section">
		<p>Credo che ora mi sieder&ograve; un momento.</p>
		<p>Allora, sono qui sperduto chiss&agrave; dove, non ricordo praticamente nulla e c&apos;&eacute; una vocina che mi risponde come una console di comando. Per&ograve; so cos&apos;&eacute; una console di comando... pi&ugrave; o meno.</p>
	</div><div class="section">
		<div class="inside">
			<?php $d->speak ('simak', 'Ci, quanto durer&agrave; il controllo?'); ?>
			<?php $d->speak ('ci', 'Controllo in corso [<span class="em">4%</span>]. Tempo residuo stimato: [<span class="em">13&apos;:20&quot;.043</span>]'); ?>
		</div>
	</div><div class="section">
		<p>Wow. Si possono fare un sacco di cose in tredici minuti. Imperi sono stati abbattuti, fortune sono andate perdute in tredici minuti... Io potrei, ad esempio, farmi un panino. Infatti, m&apos;&eacute; venuto un buco allo stomaco. Mi chiedo:</p>
	</div><div class="section">
		<div class="inside">
			<?php $d->speak ('simak', 'Ci sar&agrave; del cibo, qui vicino?'); ?>
			<?php $d->speak ('lyz', 'Fiuto la presenza di numerose forme di vita animali nei paraggi, con buone probabilit&agrave; di trovare carne bianca. Andiamo ad artigliare qualche bestiola!'); ?>
		</div>
		<p>Ehi! Questa voce &egrave; nuova:</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Chi sei tu?'); ?>
			<?php $d->speak ('lyz', 'Io sono quello che pu&ograve; procurarti da mangiare!'); ?>
			<?php $d->speak ('simak', 'Ce l&apos;hai un nome?'); ?>
			<?php $d->speak ('lyz', 'Certo che ce l&apos;ho, cazzone! Non ti ricordi? Io sono ' . $d->t ('la Sorgente', 'aDatol') . ' Lyz'); ?>
			<?php $d->speak ('simak', 'Eh, senti, tu per caso sai chi sono?'); ?>
			<?php $d->speak ('lyz', 'Mi prendi per il culo, capo? Qualunque stronzo sa che se il Lynn<span class="forte">nghahaaargh!!!</span>'); ?>
		</div>
	</div><div class="section">
		<p>La voce sembra presa da un attacco di dolore, e le mie orecchie fischiano intensamente. C&apos;&eacute; sicuramente qualcosa che non va nella mia testa:</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Cos&apos;&eacute;?'); ?>
			<?php $d->speak ('ci', 'Attenzione! [<span class="em">Errore critico in accesso alla memoria</span>]'); ?>
			<?php $d->complete ('lyz', 'forte', $d->t ('Dannato Zathot', 'Shka&apos;Zathot!') . ' Questo fa male!'); ?>
		</div>
	</div><div class="section">
		<p>Sto rantolando per terra, e il <?php echo $d->t ('Istinto di colui che possiede eLyz', 'Lyztinto'); ?> mi dice di tenermi la testa. Ma c&apos;&eacute; una buona notizia: vedo una bestiola di qualche tipo che sembra incuriosita alla vista del mio dolore e si sta avvicinando.</p>
		<div class="inside">
			<?php $d->speak ('lyz', 'Sta&apos;vvedere che mangiando &apos;sta cosa mi passa il mal di testa?'); ?>
		</div>
		<p>La mia mano si muove da sola, e nemmeno so il perch&egrave;. Ora ho la sensazione di qualcosa di peloso in bocca. Ora non ce l&apos;ho pi&ugrave;.</p>
		<p>Il mio mal di testa cala, adesso ci vedo. Porto due dita alla bocca e sfilo quella cosa che sento tra i denti: &eacute; pelo grigiastro, credo fosse un coniglio selvatico...</p>
	</div>
</div>

<?php } ?>
