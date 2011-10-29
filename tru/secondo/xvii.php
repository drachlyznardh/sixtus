<?php

	$title=array('Battaglia navale', 'Si combatte sul mare');
	$prev=array('Capitolo XVI', 'Secondo/XVI/');
	$next=array('Capitolo XVIII', 'Secondo/XVIII/');

	function mkpage ($d) {
?>

<!--
	Nuova gestione dei capitoli di Tru Naluten: adesso passo ad un
	formato pi&ugrave; confortevole dal punto di vista scrittorio; comincio
	dalla prima colonna, con meno tabbi e pi&ugrave; a capo.
-->
<div class="small">
	<div class="section">
		<h2>Tru Naluten XVII &ndash; Battaglia Navale</h2>
		<p>
			Credevo sinceramente che non avrei potuto dormire, in una notte del genere.
		</p><p>
			Ma evidentemente mi sbagliavo. Non appena Al&igrave; m&apos;ha indicato la
			mia stanza, m&apos;&egrave; calato addosso un torpore, come una malattia. O
			forse, l&apos;intervento di qualcuno in alto.
		</p>
	</div><div class="section">
		<div class="inside">
			<?php $d->speak ('lyznardh', 'Chiamami'); ?>
			<?php $d->speak ('jo', 'No'); ?>
			<?php $d->speak ('lyznardh', 'Chiamami'); ?>
			<?php $d->speak ('jo', 'No'); ?>
			<?php $d->speak ('lyznardh', 'Non per te. Ma per altri'); ?>
			<?php $d->speak ('jo', 'No'); ?>
			<?php $d->speak ('lyznardh', 'Chiamami'); ?>
			<?php $d->speak ('jo', 'No'); ?>
			<?php $d->speak ('lyznardh', 'Domani a mezzogiorno, farai il mio nome'); ?>
			<?php $d->speak ('jo', 'No'); ?>
		</div>
	</div><div class="section">
		<p>
			Quando poi mi sveglio, &egrave; mattina. Forse anche pi&ugrave; tardi. Non
			&egrave; un buon segno.
		</p><p>
			E sto dondolando. La capanna intera dondola. Barcollo, m&apos;appoggio al
			muro, m&apos;aggrappo allo stipite della porta, guardo fuori.
		</p>
	</div><div class="section">
		<p>
			Alcune volte, nella mia vita, ho avuto paura. Posso dire d&apos;aver avuto
			una vita avventura, visto che il mio pianeta madre &egrave; saltato, la mia
			vita &egrave; stata salvata da un mostro orribile, il quale &ndash; due
			decenni dopo &ndash; ha vomitato un tizio che per dispetto m&apos;ha spedito
			su un altro mondo, in cella, solo per farmi liberare da un altro tizio, che
			deve muovere contro un altro tizio.
		</p><p>
			Adesso ho paura. Il terreno ondeggia, c&apos;&egrave; fumo in ogni
			direzione, gente che urla, qualcuno grida: &laquo;&Egrave; una trappola!
			Hanno tre cannoniere, tre miglia ad ovest!&raquo; mentre sento un forte
			boato, sento schegge di legno esplodere e mi copro gli occhi.
		</p><p>
			Una mano m&apos;afferra saldamente per un braccio, mi trascina. Poi altre
			mani si aggiungono per sorreggermi, vedo mantelli svolazzare e mi sento
			sballonzolare indietro. Tento di guardarmi attorno; riconosco, tra i miei
			soccorritori, Al&igrave; che, trafelato, sputa ordini a destra e a manca.
		</p>
		<div class="outside">
			<?php $d->speak ('ali', 'Non temere. Lui verr&agrave;'); ?>
		</div>
	</div><div class="section">
		<p>
			Non mi piace.
		</p><p>
			Neanche un po&apos;
		</p><p>
			Temo seriamente che tutto questo sia soltanto un inganno.
		</p><p>
			Poi mi sento stanca, e quel torpore che m&apos;ha colto ieri notte torna
			e mi riprende con s&eacute;... chiudo gli occhi.		
		</p>
		<div class="inside">
			<?php $d->speak ('jo', 'So che sei qui!'); ?>
			<?php $d->speak ('simak', '...'); ?>
			<p>
				Poi vedo quello ch&apos;&egrave; successo stamattina.
			</p><p>
				Avrei dovuto essere l&igrave;, essere sveglia, essere presente per
				fermare questa pazzia.
			</p><p>
				Tutto &egrave; cominciato sei mesi fa: un uomo, il mozzo Jan
				Stevenson, al servizio sull'ammiraglia Inevitable, prende il largo
				su una vecchia scialuppa, al calar del sole. Rema da solo,
				instancabile, partendo dalla grossa nave ormeggiata e si dirige a
				sud, verso il promontorio che torreggia su Newport.
			</p><p>
				Proseguendo, oltre la montagna il mozzo segue la costa per oltre
				quaranta miglia, senza dar segno di cedimento. Raggiunge questo
				luogo come io e Al&igrave; abbiamo fatto la sera scorsa. Il mozzo,
				evidentemente, conosce questi luoghi, questa gente e i loro costumi.
				Indossa un travestimento, pantaloni a sbuffo, camicia larga e
				turbante, come la maggior parte degli uomini che mi sono stati
				presentati ieri.
			</p><p>
				Il mozzo s&apos;incammina, entra in citt&agrave;, si muove tra i
				vicoli, entra in una locanda. L&agrave; riuniti stanno tutti gli
				uomini di Al&igrave;, di suo padre e molta altra gente imporante.
				Il mozzo osserva e ascolta, partecipando inosservato a quello che
				credo essere un consiglio di guerra. Segue attentamente e spesso
				annuisce, come se stesse soltanto controllando dei risultati su un
				tabulato. Poi si alza, entra esattamente com&apos;&egrave; entrato,
				liscio e disinvolto, senza che nessuno lo noti.
			</p><p>
				Torna alla sua barchetta, torna ad indossare i suoi abiti da
				marinaio, riprende a remare. Rema senza sforzo, cadenzato e
				inesorabile, arriva in vista di Newport, s&apos;ormeggia alla
				Inevitable. Sono le due del mattino. Salito a bordo, chiede di
				poter parlare con l&apos;ammiraglio, e lo fanno passare.
			</p><p>
				L&apos;ammiraglio non stava esattamente &quot;aspettando&quot;,
				probabilmente dormiva alla sua scrivania. Un poco indispettito per
				l&apos;ora tarda, ma comunque ansioso di novit&agrave;, fa segno al
				mozzo di sedersi. Questo si siede, saluta, racconta brevemente degli
				eventi ai quali ha assistito, riassume il piano. L&apos;ammiraglio
				riflette, poi verga su pergamena un messaggio, lo sigilla con la
				cera ed applica la sua effige con l'anello. Quando ordina al mozzo
				di consegnare il foglio il prima possibile presso la guarnigione
				di Overmoon, altre centocinquanta miglia a Nord, il mozzo annuisce
				in silenzio, come gi&agrave; aveva fatto in precedenza.
			</p><p>
				Ed eccolo che riparte, con la stessa barchetta, nella direzione
				opposta a prima. E rema, e rema, instancabile. Giunge al
				porticciolo di Overmoon, ormeggia la scialuppa e parte dritto verso
				la guarnigione. Una guardia soltanto, con gli occhi stanchi e spenti,
				rimane in servizio a quell&apos;ora. Con uno sforzo, intima
				l&apos;alt. Il mozzo riferisce d&apos;avere un messaggio urgente.
				Intanto, il sole sorge. Di stanza alla guarnigione di Overmoon sta
				un vecchio ufficiale, un uomo stanco e acciaccato che non gradisce
				affatto essere svegliato in anticipo. Il testo del messaggio,
				tuttavia, &egrave; sufficiente per scrostargli il sonno di dosso.
				Dopo aver congedato il messaggiero, l&apos;ufficiale fa svegliare
				ogni suo uomo e comincia ad assegnare incarichi.
			</p><p>
				Cinque mesi dopo, con grande sforzo e perizia tecnica, due cannoniere
				gemelle, la Eagle Wings e la Sun Storm escono dai cantieri di
				Overmoon, cariche ciascuna di trenta cannoni, pronte per ospitare
				fino a centotrentacinque marinai ciascuna.
			</p><p>
				Nelle due settimane seguenti, le navi vengono equipaggiate, rifornite
				e preparate per la battaglia. Ieri all&apos;alba hanno lasciato il
				porto in direzione Sud.
			</p>
		</div>
	</div><div class="section">
		<div class="inside">
			<p>
				Questa mattina, mentre io dormivo, il consiglio di guerra guidato dal
				padre di Al&igrave; ha decretato che la giornata &egrave; assai
				propizia, che l&apos;araldo &egrave; d&apos;accordo, che l&apos;ammiraglio
				&egrave; del tutto ignaro e che il mare &egrave; calmo.
			</p>
			<?php $d->speak ('ali', 'Lui verr&agrave;'); ?>
			<p>
				Abbiamo seicentotrentanove soldati, tre navi, molto coraggio.
			</p><p>
				Il piano prevede di remare, remare forte, oltrepassare verso Nord il
				promontorio di Newport, prendere l&apos;orgogliosa nave ammiraglia con
				la forza, catturare l&apos;ammiraglio in persona, negoziare nuovo accordi
				commerciali, tasse, libert&agrave; di circolazione e altre varie cose.
			</p>
			<?php $d->speak ('ali', 'Lui verr&agrave;'); ?>
			<p>
				La nostra &quot;flotta&quot; parte, verso il promontorio. In
				verit&agrave; le nostre tre galee sono ben pi&igrave; rapide e manovrabili
				di quanto possano essere le grosse navi dei nostri avversari. O almeno
				credo: non ho mai visto navi prima...
			</p><p>
				Molti dei nostri credono veramente di andare verso la vittoria. Sono
				eccitati e sinceramente convinti della bont&agrave; del piano.
			</p><p>
				E l&apos;impossibile sembra possibile: le nostre tre navi arrivano in vista
				della Inevitable, s&apos;avvicinano in fretta. Dall&apos;ammiraglia non
				giunge alcun segnale, nessun allarme, nessuna resistenza. Forse siamo ancora
				troppo distanti per ingaggiare.
			</p><p>
				Poi arrivano le cannonate. Non nostre, noi abbiamo le nostre spade e le
				nostre gambe, e forse il cuore. Le palle di cannone arrivano da dietro,
				alle nostre spalle. Perch&eacute; dietro non stavamo guardando. E ci siamo
				ben ficcati nella trappola.
			</p><p>
				La pioggia di piombo dura tre minuti, e le nostre navi diventano formaggio
				svizzero. Non affondano, per&ograve;. Le abbiamo fatte bene, o forse i
				pivelli sulla Eagle Wings e sulla Sun Storm hanno una pessima mira. 
			</p>
			<?php $d->speak ('ali', 'Lui verr&agrave;'); ?>
			<p>
				Non abbiamo n&eacute; modo n&eacute; motivo per combattere ora. Una barchetta
				s&apos;avvicina a quella su cui sto anch&apos;io.
			</p>
			<?php $d->speak ('ali', 'Lui verr&agrave;'); ?>
		</div>
		<p>
			Mi sveglio.
		</p>
	</div><div class="section">
		<p>
			Dalla scialuppa sale l&apos;ammiraglio in persona, accompagnato da trenta uomini
			scelti, ben armati dei loro moschetti, pronti ad uccidere la met&agrave; di quelli
			ancora disposti a combattere con un solo colpo.
		</p><p>
			Ci intima la resa immediata e incondizionata. Vuole Al&igrave;, suo padre e mezza
			dozzina di generali, ma in cambio promette la salvezza per tutti gli altri.
		</p><p>
			Dietro di lui vedo una faccia nota: &egrave; il mozzo Stevenson. Questi
			s&apos;avvicina all&apos;ammiraglio e gli sussurra qualcosa all&apos;orecchio:
			quello si gira, mi fissa e ricorda che l&apos;elenco delle richieste ha un punto
			in pi&ugrave;: l&apos;araldo. Quando tre guardie si muovo per afferrarmi, le loro
			teste cadono. Non capiscono cosa succede, e nemmeno io. Al&igrave;, rapido come
			il vento, li ha uccisi per proteggermi. Ma nemmeno lui, per quanto abile, pu&ograve;
			schivare od opporsi in qualche modo alle pallottole: sento una decina di botti,
			lo vedo crollare a terra.
		</p><p>
			Corro per sorreggerlo, lo prendo appena in tempo. Vomitando sangue, mi fissa e
			sussurra:
		</p>
		<div class="outside">
			<?php $d->speak ('ali', 'Non temere. Lui verr&agrave;'); ?>
		</div>
		<p>
			Mentre alcuni ricaricano, altri si fanno avanti. Vedo la morte negli occhi, ancora
			una volta. Fisso davanti a me, il mozzo Stevenson mi penetra con lo sguardo, e lo
			sento dire:
		</p>
		<div class="outside">
			<?php $d->speak ('lyznardh', 'Chiamami'); ?>
		</div>
		<p>
			Ho paura. Una sola lacrima mi riga la guancia. Non voglio morire qui. Sette canne
			di fucile mi puntano. Sento freddo. Lo chiamo.
		</p>
		<div class="outside">
			<?php $d->speak ('jo', 'Lyznardh! Ti prego, vieni!'); ?>
		</div>
		<p>Il mare esplode.</p>
	</div>
</div>
<!--
	Tru Naluten XVII fine
-->

<?php } ?>
