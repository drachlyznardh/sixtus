<?php
	$d = $this->d;
	if ($this->addmeta ()) {
		$this->addtitle ('Le altre voci', 'Meglio soli che male accompagnati');
		$this->addprev ('Tru/Naluten/Vol.I/III/', 'Il mio nome');
		$this->addnext ('Tru/Naluten/Vol.I/V/', 'La mia faccia');
		$this->prepare ('tru/primo/index.php', false, false, true);
	} if ($this->addpage ()) {
?><div class="small">
	<div class="section">
		<h2>Tru Naluten I, IV &ndash; Le altre voci</h2>
		<p>Cos&igrave;, io sono Simak.</p>
		<div class="outside">
			<?php $d->speak ('lyznardh', '<span class="em" title="che significa: &laquo;Finalmente!&raquo;">Er aor ha!</span>'); ?>
		</div>
	</div><div class="section">
		<div class="inside">
			<?php $d->speak ('simak', 'Dimmi, Sacomne, io non ti vedo. Come posso parlare con te?'); ?>
			<?php $d->speak ('sacomne', '...'); ?>
			<?php $d->speak ('simak', 'Sacomne?'); ?>
			<?php $d->speak ('sacomne', '...'); ?>
			<?php $d->speak ('simak', 'Oh, Shka&apos;dhum! Come funziona?!? Come posso chiamarti, Sacomne?'); ?>
			<?php $d->speak ('sacomne', 'Quando ne avrai bisogno, arriver&ograve;'); ?>
			<?php $d->speak ('simak', 'Quindi, continuerai a comparire come ti pare?'); ?>
		</div>
		<p>&Egrave; cos&igrave;, dunque? Questa Sacomne compare dal nulla, dice di amarmi, e poi svanisce a quel modo...</p>
		<div class="inside">
			<?php $d->speak ('simak', '&Egrave; ingiusto!'); ?>
			<?php $d->speak ('lyz', 'Scemo!'); ?>
			<?php $d->speak ('simak', 'Ehi!'); ?>
			<?php $d->speak ('lyz', 'Sei un cazzone!'); ?>
			<?php $d->speak ('simak', 'Che? C&apos;ho fatto?'); ?>
			<?php $d->speak ('lyz', 'Sai, se ti ricordassi tutto quello che hai scordato, sapresti quanto Sacomne ti ami e quanto spesso &egrave; stata di grande aiuto a tutti noi'); ?>
			<?php $d->speak ('simak', 'Uhm... convincimi!'); ?>
			<?php $d->speak ('lyz', 'D&apos;accordo. Aspetta un pochetto, senza fare niente...'); ?>
			<?php $d->speak ('simak', 'Vabbene...'); ?>
		</div>
		<p>...</p>
		<div class="inside">
			<?php $d->speak ('lyz', 'Guarda! C&apos;&eacute; Sacomne!'); ?>
			<?php $d->speak ('simak', 'Ah! Dov&apos;&egrave;? Sacomne, amore mio...'); ?>
		</div>
		<p>Al solo pensarla, vado in brodo di giuggiole...</p>
		</div><div class="section">
		<p>...</p>
		<p>Rimango a nuotare nel brodo per qualche secondo...</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Lyz! Avevi ragione!'); ?>
			<?php $d->speak ('lyz', '<span class="em" title="che significa: &laquo;Per la Volont&agrave;&raquo;">Du&apos;Nalute!</span> Sono il Lyz, ho <span class="forte">sempre</span> ragione!'); ?>
			<?php $d->speak ('corona', '...'); ?>
		</div>
		<p>Mi &egrave; parso di sentire qualcosa... una delle voci del mio sogno...</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Voi avete sentito nulla?'); ?>
			<?php $d->speak ('ci', '[<i>nessun rilevamento</i>] su tutti i canali audio'); ?>
			<?php $d->speak ('lyz', 'Nemmeno io ho sentito nulla... Hai le allucinazioni?'); ?>
			<?php $d->speak ('simak', 'Forse mi sbaglio... forse sono stanco...'); ?>
			<?php $d->speak ('ci', 'Livelli energetici: [&lt; <i>98% | 97% | 100% | 99% | 99%</i> &gt;]'); ?>
			<?php $d->speak ('ci', 'Condizioni [<i>ottimali</i>]'); ?>
			<?php $d->speak ('lyz', 'Direi che stiamo bene, in queste condizioni occorrebbe un potere mostruoso per farci cadere vittime di un&apos;allucinazione... E comunque, non avverto alcun pericolo: il ch&eacute; significa che NON c&apos;&eacute; alcun pericolo'); ?>
			<?php $d->speak ('simak', 'Eppure, m&apos;&eacute; parso di sentire quella voce rossa...'); ?>
			<?php $d->speak ('corona', '...'); ?>
		</div>
		<p>Ecco, l&apos;ho sentita ancora, ma...</p>
		<p>Ahi! ...</p>
		<p>Mi fa male ...</p>
		<p>La testa ...</p>
		<div class="dream">
			<?php $d->speak ('corona', 'Se insisti nel chiamarmi, eccomi'); ?>
			<?php $d->speak ('simak', 'Ah, allora non mi sbagliavo!'); ?>
			<?php $d->speak ('corona', 'Ti sbagli su molte cose, Simak'); ?>
			<?php $d->speak ('simak', 'Che fai, sfotti?'); ?>
		</div>
		<p>Mh...</p>
		<div class="dream">
			<?php $d->speak ('simak', 'Ehi, aspetta un attimo. Tu mi conosci?'); ?>
			<?php $d->speak ('corona', 'Meglio di te stesso'); ?>
			<?php $d->speak ('simak', 'Sei... la... sei la mia coscienza?'); ?>
			<?php $d->speak ('corona', 'Non la tua, ma sono una Coscienza. Si, diciamo pure cos&igrave;'); ?>
			<?php $d->speak ('simak', 'E hai un nome?'); ?>
			<?php $d->speak ('corona', 'In effetti, no'); ?>
			<?php $d->speak ('simak', 'Posso chiamarti Coscienza, dunque?'); ?>
			<?php $d->speak ('corona', 'Se ti aggrada, fai pure. Non ho problemi con i nomi'); ?>
			<?php $d->speak ('simak', 'Beh, dimmi, Coscienza, dove siamo?'); ?>
			<?php $d->speak ('corona', 'Questo &egrave; un sogno...'); ?>
			<?php $d->speak ('simak', 'Ancora? Mi hai detto questa molto spesso'); ?>
			<?php $d->speak ('corona', 'Ed ho sempre detto il vero'); ?>
			<?php $d->speak ('simak', 'Non ricordo di essermi addormentato...'); ?>
			<?php $d->speak ('corona', 'Ho gettato io il sonno su di te, cosicch&eacute; potessimo parlare...'); ?>
			<?php $d->speak ('simak', 'Notevole! Questo significa che possiamo parlare solo mentre dormo?'); ?>
			<?php $d->speak ('corona', 'Precisamente. Io esisto solo nella tua mente'); ?>
			<?php $d->speak ('simak', 'Ma anche Ci e il Lyz. Perch&egrave; loro non sono qu&igrave; allora? Ho tentato di chiamarli...'); ?>
			<?php $d->speak ('corona', 'Questo &egrave; impossibile. Loro due non si trovano in questo luogo. Noi non siamo nel luogo che ospita le vostre tre menti, ma siano all&apos;interno della tua singola mente, Simak. Qu&igrave;, Ci e il Lyz nemmeno esistono, poich&eacute; sono parte del Lyznardh, ma non parte di Simak'); ?>
		</div><div class="dream">
			<p>Wow! Questa vocina rossa pu&ograve; farmi cadere addormentato e mandarmi dentro me stesso, dove sono solo come un cane... Forse devo temere per la mia sicurezza...</p>
		</div><div class="dream">
			<?php $d->speak ('corona', 'Non hai di che temere, Simak. Sei al sicuro'); ?>
			<?php $d->speak ('simak', 'Hei! Com&apos;hai fatto? Mi hai sentito?'); ?>
			<?php $d->speak ('corona', 'Naturalmente'); ?>
			<?php $d->speak ('simak', 'Ma come puoi? Stavo solo pensando...'); ?>
			<?php $d->speak ('corona', 'Non c&apos;&eacute; luogo dove io non possa raggiungerti, Simak... Qu&igrave; dentro, io sono potente quanto te'); ?>
			<?php $d->speak ('simak', 'D&apos;accordo, ti credo. Ma dimmi, tu... cosa fai qu&igrave;?'); ?>
			<?php $d->speak ('corona', '&Egrave; semplice: tu hai un compito da svolgere. Io sono qui per aiutarti a compierlo'); ?>
			<?php $d->speak ('simak', 'Gi&agrave;... Ricordo questa storia del compito da portare a termine... Tu sai dirmi di pi&ugrave; su questo?'); ?>
			<?php $d->speak ('corona', 'Ahim&eacute;, non &egrave; ancora il momento, Simak... Dovrai aspettare'); ?>
			<?php $d->speak ('simak', 'Uhm?'); ?>
			<?php $d->speak ('corona', 'Pazienta. Le risposte arriveranno quando sarai pronto per conoscerle'); ?>
			<?php $d->speak ('simak', 'E quando sarebbe questo momento?'); ?>
			<?php $d->speak ('corona', '...'); ?>
			<?php $d->speak ('sacomne', 'Svegliati, Simak!'); ?>
			<p>Per favore ...</p>
			<p>Datemi ...</p>
			<p>Un&apos;aspirina ...</p>
		</div>
	</div><div class="section">
		<p>Questi strani sogni mi mettono addosso una notevole stanchezza. Anche se stavolta, sono davvero convininto di essermi addormentato, invece che svenire come le altre volte...</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Yawn... Come va?'); ?>
			<?php $d->speak ('lyz', 'Come va cosa? Stai bene, capo?'); ?>
			<?php $d->speak ('simak', 'Quanto ho dormito?'); ?>
			<?php $d->speak ('lyz', 'Dormito? Tu non hai dormito affatto! Praticamente, non hai mai smesso di parlare... Poi hai nominato una cerca voce rossa...'); ?>
			<?php $d->speak ('ci', 'Prima che tu lo chieda, posso confermare. Sei rimasto in silenzio per [<i>0&apos;00&quot;.123</i>], ossia un tempo trascurabile per la tua mente...'); ?>
		</div>
	</div><div class="section">
		<p>Che fa? Sfotte?</p>
	</div><div class="section">
		<div class="inside">
			<?php $d->speak ('simak', 'Che cosa intenti con &quot;trascurabile per la mia mente&quot;?'); ?>
			<?php $d->speak ('ci', 'Non t&apos;offendere. Intendo dire che il tempo in cui sei stato zitto non &egrave; indice di nessuna attivit&agrave; particolare, o meglio, indica che nel lasso di tempo trascorso in silezio, non potresti mai addormentarti e risvegliarti. &Egrave; fisicamente impossibile.'); ?>
			<?php $d->speak ('simak', 'Cio&eacute;... io sto qui in mezzo ad un bosco, praticamente in totale amnesia, sento continuamente delle voci nella mia testa, e tu vieni a parlarmi di cose &quot;fisicamente impossibili&quot;? Lascia stare Ci, non &egrave; il momento...'); ?>
		</div>
		<p>Non lo &egrave;, decisamente.</p>
		<div class="inside">
			<?php $d->speak ('simak', 'Oltretutto, neanche ricordo che faccia ho... Ehi, Lyz, non c&apos;&eacute; mica un laghetto qu&igrave; vicino? Vorrei vedere la mia immagine riflessa'); ?>
			<?php $d->speak ('lyz', 'Chiedi e ti sar&agrave; dato: il Lyz &egrave; qu&igrave; essattamente per questo. Dunque, sento odore di umido verso est, e sento anche il rumore dell&apos;acqua'); ?>
		</div>
		<p>Inspiro profondamente, e ascolto.</p>
		<div class="inside">
			<?php $d->speak ('ci', 'Distanza [<i>238m</i>], direzione [<i>-47&deg;34&apos;45&quot;</i>]'); ?>
			<?php $d->speak ('simak', 'Sarebbe a dire?'); ?>
			<?php $d->speak ('lyz', 'Pirla! Un mezzo a sinistra, 48 passi in avanti: l&igrave; c&apos;&eacute; dell&apos;acqua!'); ?>
		</div>
		<p>Era cos&igrave; semplice?</p>
		<p>Non ne sono cos&igrave; convinto. Per&ograve; il Lyz non si sbaglia. C&apos;&eacute; davvero un laghetto... Mi avvicino al bordo e mi affaccio per specchiarmi...</p>
		<div class="outside">
			<?php $d->speak ('lyznardh', '<span class="forte em" title="che significa: &laquo;Porco Mondo!&raquo;">Shka&apos;dhum!</span> Sono io quello? Oh Sacomne, mia adorata! <span title="proprio tanto">Quanto sono brutto...</span>'); ?>
		</div>
		<p>Yo! C&apos;ho una faccia che fa spavento! Che razza di bestia sono?</p>
	</div>
</div><?php } ?>
