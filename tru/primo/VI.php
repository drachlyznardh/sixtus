<?php

	$m->mkpage('L&apos;altro me', 'Non sono veramente io');
	$m->mkrelated('prev', 'Capitolo V', 'Tru/Naluten/V/');
	$m->mkrelated('next', 'Capitolo VII', 'Tru/Naluten/VII/');

	function mkpage ($d, $m) {
?>
<div class="small">
	<div class="section">
		<h2>
			Tru Naluten I,VI &ndash; L'altro me
		</h2><p>
			Non so che dire... non so che pensare... non lo so davvero.
			Credo sia la quarta o quinta volta &ndash; soltanto oggi &ndash;
			che avverto questa sensazione di naufragio. Spero sinceramente
			che Ci possa lanciare un salvagente, perch&eacute; ne ho
			bisogno.
		</p>
		<div class="inside">
			<?=$d->speak ('ci', 'Fanno 29 categorie comprese nel regno
			animale, per non citare le categoria appertenenti al regno
			vegetale. Ma credo che questo sia sufficiente per dare
			l&apos;idea di risposta alla domanda che hai posto')?>
			<?=$d->speak ('simak', 'Eh? Mh, no, non credo di afferrare.
			Direi quantomeno che la mia domanda doveva essere errata, per
			ottenere una risposta tanto complessa quanto inutile')?>
			<?=$d->speak ('ci', 'Precisamente: diciamo pure che non sei un
			animale. In effetti, sei qualcos&apos;altro, qualcosa di
			sostanzialmente diverso e...')?>
			<?=$d->speak ('lyz', 'Ci, basta. Non credo sia il caso')?>
			<?=$d->speak ('ci', 'Perch&egrave; no? Ricorda il suo nome,
			dovrebbe ricordare anche il resto. In pi&ugrave;, le condizioni
			per il giuramento si sono presentate, a mio parere')?>
			<?=$d->speak ('lyz', 'Beh, a parer mio &ndash; invece &ndash;
			&apos;sto paio di balle!')?>
			<?=$d->speak ('ci', 'Dunque, se cos&igrave; credi,
			proceder&ograve; ad una verifica normale...')?>
			<?=$d->speak ('simak', 'Si, esatto. Mi sento chiamato in
			causa...')?>
		</div>
		<p>
			Mi chiedo se questi due si ricordino che ci sono anch&apos;io,
			qui...
		</p>
	</div><div class="section">
		<div class="inside">
			<?=$d->speak ('ci', 'Simak... oh, finalmente riesco a pronunciare quel nome! Dicevo, Simak, ricordi qualcosa, ora?'); ?>
			<?=$d->speak ('simak', 'Non direi... esempi?'); ?>
			<?=$d->speak ('ci', 'Conosci il tuo nome, ricordi Sacomne &ndash; almeno in parte &ndash; e non dimostri eccessivo spaesamento'); ?>
		</div><div class="dream">
			<?=$d->speak ('simak', 'Davvero? Non riesco a non dubitarne...'); ?>
		</div><div class="inside">
			<?=$d->speak ('simak', 'E? Scusami, ma proprio non capisco dove vuoi andare a parare'); ?>
			<?=$d->speak ('ci', 'D&apos;accordo. Quando &ndash; tempo fa &ndash; ci desti istruzioni per questo momento, dicesti anche che il sigillo sulla tua memoria avrebbe dovuto dischiudersi autonomamente, al momento del tuo <span class="em">&quot;risveglio&quot;</span> &ndash; ossia, nel momento in cui avresti ricordato il tuo nome, oppure quello di Sacomne. Mi sembra piuttosto ovvio che entrambe queste condizioni si sono verificate &ndash; quindi il sigillo dovrebbe essere caduto &ndash; ergo, dovresti essere nuovamente in condizione di prendere il comando. Erro, forse?'); ?>
			<?=$d->speak ('simak', 'Non ne sono certo, ma credo che queste condizioni siano... inesatte. Non ricordo altro, se non questi due nomi'); ?>
			<?=$d->speak ('lyz', 'Visto!?! &Egrave; come ti dicevo: navighiamo ancora in un mare di merda &ndash; ed io ho un ottimo naso! &ndash; e il nostro capitano &egrave; come un infante appena nato! Lasciate perlomeno che io continui a camminare portando i vostri pesanti culi verso la nostra meta!') ?>
			<?=$d->speak ('simak', 'Allora tu sai dove stiamo andando?'); ?>
			<?=$d->speak ('lyz', 'Fatti un mazzo di cazzi tuoi, per favore. Se ricordassi quello che ti sei scordato e dovresti invece ricordare, staremmo tutti meglio'); ?>
			<?=$d->speak ('simak', 'Ma...'); ?>
			<?=$d->speak ('lyz', 'Zitto! <span class="em">&quot;Simak&quot;</span> ci ha messi in questa rogna e soltanto <span class="em">&quot;Simak&quot;</span> ce ne tirer&agrave; fuori &ndash; e senza il mio aiuto, beninteso! Adesso lavora!'); ?>
			<?=$d->speak ('ci', '&Egrave; vero, dunque?'); ?>
			<?=$d->speak ('simak', 'Si. No. Non so... devo riflettere. Datemi qualche momento'); ?>
			<?=$d->speak ('lyz', '...'); ?>
			<?=$d->speak ('ci', 'Aspetteremo, dunque'); ?>
		</div>
	</div><div class="section">
			<div class="outside">
				<p>Ho bisogno...</p>
			</div>
			<p>di un po&apos; di...</p>
			<div class="inside">
				<p>tempo da solo...</p>
			</div>
	</div><div class="section">
		<div class="dream">
			<?=$d->speak ('simak', $d->t ('Mph&raquo;', 'Mph')); ?>
			<?=$d->speak ('simak', 'La situazione non &egrave; buona... devo inventarmi una qualche soluzione'); ?>
			<?=$d->speak ('a_simak', 'Sai, non &egrave; affatto necessario inventare ci&ograve; che gi&agrave; esiste: basta prenderlo e usarlo'); ?>
			<?=$d->speak ('simak', 'Si, sono d&apos;accordo. Tuttavia non ricordo alcunch&eacute;, quindi... Ehi! Chi sei tu?!?'); ?>
			<?=$d->speak ('a_simak', 'Io chi? Qui non c&apos;&egrave; nessuno, se non tu stesso'); ?>
			<?=$d->speak ('simak', 'Oh, davvero? Eppure sono certo d&apos;averti sentito, un attimo fa. Sbaglio, forse?'); ?>
			<?=$d->speak ('a_simak', 'No, mi hai sentito. Ma questo &egrave; lo spazio della mente di Simak: non vi si entra facilmente'); ?>
			<?=$d->speak ('simak', 'Se questo spazio &egrave; mio, allora tu da dove sbuchi?'); ?>
			<?=$d->speak ('a_simak', 'Non sbuco affatto: ero gi&agrave; qu&igrave;. In realt&agrave;, sono qui dentro da prima che tu arrivassi'); ?>
			<?=$d->speak ('simak', 'Sarei dunque io l&apos;invasore, qu&igrave;?'); ?>
			<?=$d->speak ('a_simak', 'No, non &quot;invasore&quot;, preferisco &quot;ospite&quot;: &quot;<span title="che significa: &laquo;Casa mia &egrave; casa tua&raquo; &ndash; o anche &ndash; &laquo;Ci&ograve; che &egrave; mio &egrave; anche tuo&raquo;">mi casa es su casa</span>&quot;, Simak. Sentiti libero di agire come preferisci'); ?>
			<?=$d->speak ('simak', '&Egrave; cos&igrave;? Allora, posso sapere con chi parlo?'); ?>
			<?=$d->speak ('a_simak', 'Che domanda sciocca: io sono Simak'); ?>
			<?=$d->speak ('simak', 'No, <span class="em">io</span> sono Simak'); ?>
			<?=$d->speak ('a_simak', 'Vero, ma ci&ograve; non toglie chi sia io'); ?>
			<?=$d->speak ('simak', 'Questo &egrave; assurdo'); ?>
			<?=$d->speak ('a_simak', 'No. &Egrave; soltanto... <span class="em">particolare</span>'); ?>
			<?=$d->speak ('simak', 'Ho tempo'); ?>
			<?=$d->speak ('a_simak', 'Si, hai ragione. Ora, rifletti: ti fidi di me?'); ?>
			<?=$d->speak ('simak', 'Mh... non ho motivo di fidarmi... d&apos;altra parte, non ho alcun motivo per non fidarmi... tuttavia...'); ?>
			<?=$d->speak ('a_simak', 'Ancora non ti fidi. &Egrave; accettabile'); ?>
			<?=$d->speak ('simak', 'Come accettabile? Non sembri in condizione di diferti da me, in questo luogo. Siamo tecnicamente alla pari, quindi corri un rischio inutile rinunciando al tuo vantaggio'); ?>
			<?=$d->speak ('a_simak', 'Precisamente. Quando capirai che non ho motivo di temere &ndash; come non ne hai tu, Simak &ndash; sarai pronto ad accettare quello che ho da dirti'); ?>
			<?=$d->speak ('simak', 'E sia. Parla'); ?>
			<?=$d->speak ('a_simak', 'No, non ancora'); ?>
			<?=$d->speak ('simak', 'E perch&eacute; no? Vuoi una prova di fiducia?'); ?>
			<?=$d->speak ('a_simak', 'Inutile &ndash; leggo e scrivo nella tua mente. &Egrave; sufficiente che tu creda. Quando lo farai, lo sapr&ograve;'); ?>
			<?=$d->speak ('simak', 'Vedremo'); ?>
		</div>
		<p>Ho motivo di fidarmi di questo tizio?</p>
		<p>No, non ce l&apos;ho...</p>
		<p>Non ho certezze di alcun tipo, da quando mi sono risvegliato qualche ora fa... N&eacute; la voce rossa, n&eacute; l&apos;altra voce bianca parlano chiaramente, ma sono certo che sanno pi&ugrave; di quello che dicono.</p>
		<p>Oh, &egrave; inutile! Sto costruendo castelli in aria! Devo prendere una decisione.</p>
		<p>Devo prendere una decisione...</p>
		<div class="dream">
			<?=$d->speak ('simak', 'Allora, <span class="em">altro</span> Simak...'); ?>
			<?=$d->speak ('a_simak', 'Sai che posso sentire i tuoi pensieri?'); ?>
			<?=$d->speak ('simak', 'Come?'); ?>
			<?=$d->speak ('a_simak', 'Ti sento. So cosa pensi. Pensare di pensare, come hai appena fatto, non &egrave; di alcuna utilit&agrave;...'); ?>
			<?=$d->speak ('simak', 'Io...'); ?>
			<?=$d->speak ('a_simak', 'Per&ograve; hai ragione: devi prendere una decisione. Ci e il Lyz stanno gi&agrave; perdendo fiducia...'); ?>
			<?=$d->speak ('simak', 'Questo &egrave; ancora da vedere!'); ?>
			<?=$d->speak ('a_simak', 'Lascia stare le minacce, conosco bene il mio lavoro. Sai, non &egrave; poi cos&igrave; difficile tenere testa a quei due: &egrave; sufficiente che credano che tu sia adatto &ndash; poco importa se non lo sei. Avanti, fa quello che farei io'); ?>
			<?=$d->speak ('simak', 'Come scusa?'); ?>
			<?=$d->speak ('a_simak', 'Mi hai sentito'); ?>
			<?=$d->speak ('simak', 'Ora mi sto arrabbiando'); ?>
			<?=$d->speak ('a_simak', 'Si, <span class="em">certo</span>'); ?>
			<?=$d->speak ('simak', 'Ora <span class="em">sono</span> arrabbiato'); ?>
			<?=$d->speak ('a_simak', 'E che farai?'); ?>
			<?=$d->speak ('simak', 'Prender&ograve; decisioni senza che tu interferisca!'); ?>
			<?=$d->speak ('a_simak em', 'Finalmente'); ?>
		</div>
		<p>Sull&apos;orlo della trollata, posso soltanto contro&ndash;trollare.</p>
		<div class="dream">
			<?=$d->speak ('a_simak', 'Bella pensata. Ma non funzioner&agrave;...'); ?>
			<?=$d->speak ('simak', 'Si, lo immaginavo'); ?>
			<?=$d->speak ('a_simak', 'E allora, sei disposto a fidarti?'); ?>
			<?=$d->speak ('simak', 'Mai. Tu sei infido, sei malevolo, e sei anche falso'); ?>
			<?=$d->speak ('a_simak', 'Vero. Ma sono anche pi&ugrave; forte di te'); ?>
			<?=$d->speak ('simak', 'Non &egrave; affatto vero: io non ho pari'); ?>
			<?=$d->speak ('a_simak', 'Sbagli: <span class="em">io</span> non ho pari'); ?>
			<?=$d->speak ('simak', 'E allora dimostrer&ograve; che ho ragione battendoti!'); ?>
			<?=$d->speak ('a_simak', 'Bene! <span class="forte em" title="che significa: &laquo;&Egrave; questa una sfida?&raquo;">Vhot pak&apos;ke?</span>'); ?>
			<?=$d->speak ('simak em', 'Naturalmente'); ?>
			<?=$d->speak ('a_simak', 'Bene, Simak non ha <span class="em">mai</span> perso una sfida. Ricordi perch&eacute;?'); ?>
			<?=$d->speak ('simak', 'Per il suo nome'); ?>
			<?=$d->speak ('a_simak', '<span class="em">Esatto!</span> Ora, dillo: <span class="em forte">Perch&eacute;, Simak, non hai mai perso una sfida?</span>'); ?>
			<?=$d->speak ('simak em" title="che significa: &laquo;Poich&eacute; io sono il Lyznardh', 'Ghane ita be eLyznardh'); ?>
		</div>
	</div><div class="section">
		<div class="inside">
			<p>Ora...</p>
		</div>
		<p>so...</p>
		<div class="outside">
			<p>chi sono.</p>
		</div>
	</div><div class="section">
		<p>Rieccomi, finalmente!</p>
		<div class="inside">
			<?=$d->speak ('simak', 'Ehi, Ci, m&apos;avevi forse chiesto qualcosa?'); ?>
			<?=$d->speak ('lyz', 'Che va vanverando l&apos;idiota?'); ?>
			<?=$d->speak ('ci', 'Ricordi, allora!'); ?>
			<?=$d->speak ('simak', 'A grandi linee. Ma sono tornato'); ?>
		</div>
		<p>&Egrave; strano risvegliarsi per due volte, nello stesso giorno, e scoprirsi persone diverse.</p>
		<p>Tornare in possesso della propria identit&agrave; perduta &egrave; un po&apos; come tornare a casa dopo tanto tempo: &egrave; come accorgersi che le vecchie abitudini perdute erano rimaste soltanto nascoste, senza mai andarsene davvero; &egrave; come svegliarsi la mattina ed essere gi&agrave; in ritardo; &egrave; come... come trovare una vecchia maschera e scoprire quella &egrave; la tua vera faccia.</p>
	</div><div class="section">
		<p>&Egrave; bello essere tornato.</p>
	</div>
</div>

<?php } ?>
