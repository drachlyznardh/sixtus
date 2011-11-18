<?php
	$title=array('Spezzato','&#160;');
	$prev=array('Niente','Storie/2011/LIV/');
	$next=array('Correre di notte','Storie/2011/LVI/');
	function mkpage($d){
		$self='Storie/2011/LV/';
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<h2>
				Spezzato
			</h2><ol><li id="li-i">
					<?=$d->link($self,'Prologo','I')?>
				</li><li id="li-ii">
					<?=$d->link($self,'La cosa brutta','II')?>
				</li><li id="li-iii">
					<?=$d->link($self,'La cosa più brutta','III')?>
			</li></ol>
		</div>
	</div><div class="widecontent">
		<div class="tab" id="tab-i">
			<div class="section">
	<p>
		Stasera ho tirato bidone ad alcuni amici.
	</p><p>
		Sarò stato stronzo, ma avevo una buona ragione.
	</p><p>
		Oggi sono stato testimone di due cose brutte, e non l'ho presa bene.
		Così sono andato a cercare quel che mi serviva.
	</p><p>
		Ho fatto l'unica cosa che mi sentivo di fare in quel momento. Dopo cena,
		verso le 21:00, me ne sono andato a correre, da solo, al buio, fino ai
		<?=$d->link('Storie/2010/VIII/','sassi')?>.
	</p><p>
		Io piango così.
	</p>
</div><div class="section">
	<p>
		&#160;
	</p>
</div><div class="section">
	<p>
		E posso dirvi che correre da soli al buio fa paura.
	</p>
			</div>
		</div><div class="tab" id="tab-ii">
			<div class="section">
	<p>
		Se avete letto la <?=$d->link('Storie/2011/LII/','storia LII')?> saprete
		quanto il progetto di SgaggioTiem stia sottraendo energie e speranze a
		me e a Jazz come quasi nulla prima d'ora.
	</p>
</div><div class="section">
	<p>
		Beh, oggi non è andata meglio… non è andata neanche peggio, ma non era
		pronto a reggere la botta.
	</p><p>
		Oggi mi sono messo a fare due cose: far funzionare l'Apache/httpd del
		MontaVista 31; e crosscompilare una toolchain apposita per 'sto mostro.
	</p>
</div><div class="section">
	<p>
		Beh, io pensavo che – per quanto vecchio – un server Apache fosse fatto
		per intepretare il PHP e servire pagine. Ma a quanto pare, no. Per
		fargli riconoscere le pagine di <a
		href="http://kiyuko.org/software/poster">Poster</a> ho dovuto
		smanacciare a fondo nell'<span class="code">httpd.conf</span> e <span
		class="code">reboot</span>are la macchina.
	</p><p>
		Ho dovuto cambiare permessi, creare utenti, madonnare per mezz'ora… non
		è bello. È normale, ma non bello.
	</p>
</div><div class="section">
	<p>
		Poi è stato il turno della toolchain.
	</p><p>
		Scarica un tarball della morte, scompatta. Localizza la versione dello
		script con target corretti: <span class="code">kernel-2.4.20</span> e
		<span class="code">glibc-2.3.2</span>. Fatto, sposta cartelle, linka la
		home, imposta i permessi, lancia lo script.
	</p><p>
		Questo parte e comincia a scaricare tarball, 70MB di archivi tirati giù
		da chissà quale repository. Poi le si guarda un pochetto. Poi mi dice
		che va tutto bene e si ferma.
	</p><p>
		La directory d'installazione è vuota. Controllo, tutto è andato come
		doveva.
	</p><p>
		Lo lancio una seconda volta. Niente. Terza volta. Niente. Butto via
		tutto, riestraggo il tarball, riconfiguro la roba, rilancio. Stavolta,
		pare che l'archivio dei <span class="code">binutils</span> non sia
		corretto. Ma lui me lo dice e basta. Allora io lo cancello, e lui se lo
		riscarica. Ma non tutto, si ferma a 8MB su 11 e aspetta…
	</p><p>
		Rapido controllo: è caduta la rete. Riattaccala. <span
		class="code">wicd-client</span> dice «no» e si pianta per un quarto
		d'ora. Un riavvio dopo, eccomi finalmente online. Dopo altri due
		tentativi, ottengo l'archivio.
	</p><p>
		Lo script della morte comincia a compilare mazzi e mazzi di sorgenti
		mistreriosi, nomi così lunghi che neanche riesco a leggerli, mentre
		passano… poi, 4 minuti dopo, si pianta:
	</p><div class="outside"><p>
			«Errore: LD_LIBRARY_PATH è settato. glibc non può compilare»
	</p></div><p>
		Vabbeh, <span class="code">unset</span>, che male può fare? Blah blah
		blah, 2 minuti dopo mi dice
	</p><div class="outside"><p>
			«Caro signore, le faccio notare che la sua installazione non prevede
			una copia di <span class="code">bison</span>, gradirebbe provvedere?»
	</p></div><p>
		Vabbene, stronzetto, te lo <span class="code">apt-get install</span>o
		così sei felice. Ma altri due minuti dopo
	</p><div class="outside"><p>
			«Quasi dimenticavo, nobilissimo e stimatissimo utilizzatore, che le
			manca anche <span class="code">flex</span>…»
	</p></div><p>
		Ch'azzo gli servirà? Boh, installo anche quello… altri due minuti dopo…
	</p><div class="outside"><p>
			«Controllo versione di gcc, 4.6.1: <span class="em">PECCATO</span>»
		</p><p>
			«Si veda il file INSTALL per ulteriori informazioni»
	</p></div><p>
		Eh, certo. <span class="code">find . -name 'INSTALL'</span> trova otto
		directory, piene di roba. <span class="code">| xargs grep</span>po tutta
		'sta roba e scopro un'unica riga utile
	</p><div class="outside"><p>
			«configure:8693 *** Boola boola boola if [[ $CC -v -geq 3.2 ]] then
			world.explode();»
	</p></div><p>
		Il resto è storia: ho provato ad esportare versioni più vecchie che
		tengo in archivio, ottenendo soltanto
	</p><div class="outside"><p>
			«<span class="code">/usr/bin/gcc-4.1 -h -f -G 425 ryfcdbgnh.o -a
			dthvcs -Wblah -D_ETC_ETC_ETC</span> ha dato errore»
		</p><p>
			«Potresti, per favore, settare $C su un compilatore che funzioni?»
	</p></div><p>
		Dopo tre di questi errori, mi sono arreso.
	</p>
			</div>
		</div><div class="tab" id="tab-iii">
			<div class="section">
	<p>
		Ma quella non è la cosa brutta. Questa lo è.
	</p><p>
		Stamattina, salendo in facoltà, mi sono trovato il corridio pieno di
		biologhe.
	</p><p>
		Avete notato il cuoricino vicino al titolo della storia, a lato? Beh,
		sappiate ch'è un po' ingannevole.
	</p>
</div><div class="section">
	<p>
		Capitava infatti l'esame di <span class="em">chimica organica</span>,
		che dev'essere qualcosa d'importante, a giudicare dal numero di persone
		in attesa per l'orale. Tra queste, $rossa.
	</p><p>
		Ed io, che dovevo arrivare in austud, passo in mezzo con tutta la
		naturalezza del mondo e me ne sbatto.
	</p><p style="text-align: right">
		<span class="em">NotASingleFuckWasGiven.jpg</span>
	</p><p>
		Poi, avendo preso l'abitudine di salire con una maglietta e cambiarmi
		non appena giunto a destinazione, torno in bagno per evitare di turbare
		il pudore generale spogliandomi in aulastudio.
	</p><p>
		Ma il destino era in agguato, sotto forma di donna delle pulizie che
		lascia la porta del bagno chiusa a chiave. Così io posso farmela
		addosso, così mi tocca andare di sopra, e per farlo attraversare i
		biologhi.
	</p><p style="text-align:right">
		<span class="em">NotASingleFuck_II_Revenge.jpg</span>
	</p><p>
		Ma poi torno.
	</p><p style="text-align:right">
		<span class="em">NotASingleFuck_III_TheFinalUngiving.png</span>
	</p><p>
		E me ne torno di là, con una maglietta diversa.
	</p><p>
		Poi vado a prendere il caffè.
	</p><p style="text-align:right">
		<span class="em">NotASingleFuck_Again.gif</span>
	</p><p>
		E poi me ne vado anche a pranzo.
	</p><p style="text-align:right">
		<span class="em">NotASingleFuck_Forever.ico</span>
	</p>
</div><div class="section">
	<p>
		Poi capita ciò di cui avete letto nel tab precedente, o almeno una parte
		o cose simili. Ad un certo punto, il mio stomaco mi dice ch'è meglio
		piantarla lì e andarsene per una tonda.
	</p><p>
		Decido d'andare alla fontana che c'è in piazza, così da fare due passi e
		bere qualcosa di fresco fresco.
	</p><p>
		Mentre salgo, mi torna in mente di quella volta che m'ero arrampicato su
		questa stessa rampa per consegnare tre fiori in una scatola di plastica.
		Poi però mi vengono in mente le definizioni dei MUTEX delle pThread e mi
		distraggo…
	</p><p>
		Mi appaiono allora Murphy e Bonaccorsi, che mi fanno
	</p><div class="outside"><p>
			«Sai quante probababilità ci sono che questo accadesse? E quante in
			più ce ne sono adesso, visto che non t'interessa più?»
	</p></div><p>
		E io non capisco. Poi mi volto a controllare (è una cosa che faccio più
		spesso di quanto non si creda) e vedo due sagome in lontanza. Due
		ragazze salgono dal fondo della rampa per prendere l'autobus, sono la
		$rossa e una luogotenente.
	</p><div class="inside"><p>
			È straordinario come possa riconoscere certe cose ed essere
			completamente ciecato per altre, tipo il numero degli autobus.
	</p></div><p>
		Considerato il delta tra il mio passo e il loro, se salgo, bevo, vado a
		controllare il termometro fuori dalla banca, torno alla fontana e beve
		di nuovo, mi verranno incontro. Coincidenza veramente improbabile.
	</p><p style="text-align:right">
		<span class="em">NotASingleFuck_ImThirsty.avi</span>
	</p><p>
		Vado, bevo, controllo (fanno 28 fottutissimi gradi!), mi giro, bevo di
		nuovo, riparto.
	</p><p>
		<span class="em">Dejavù</span>
	</p><p>
		Devo aver fatto questa stessa cosa, sei mesi fa… io sono alla fontana,
		lei passa sull'altro marciapiede. Ma io, in quel momento
	</p><p style="text-align:right">
		<span class="em">NotASingleFuck_NotEvenASingleOne.mkv</span>
	</p><p>
		E me ne sono andato.
	</p>
</div><div class="section">
	<p>
		Poi me ne sono andato, con Jazz e War, a prendere il caffè delle 14:30.
		Ho cercato di capire cosa fosse successo. E d'un tratto, mi sono accorto
		che non me ne frega un cazzo.
	</p><p>
		Poi ho avuto come un sentore, quello che (non) sarebbe potuto (non)
		accadere su quella rampa, sei mesi fa. Se le avessi parlato allora. Se
		le avessi parlato oggi. Se abbia ancora quei fiori. Se li abbia mai
		accettati, o se li abbia buttati direttamente. Se avesse paura. Se si
		fosse sentita apprezzata.
	</p><p>
		Ma non era di quello, che mi fregava. Volevo un caffé.
	</p>
</div><div class="section">
	<p>
		Mi ci è voluto un po' per afferrare. Ma alla fine sono riuscito a
		ricordarmi di un po' di cose e mi sono intristito.
	</p><div class="outside"><p>
			Se lei m'avesse chiesto, sei (o sette? boh…) mesi fa, di
			attraversare un'autostrada, in cambio d'un caffé assieme, l'avrei
			fatto.
	</p></div><div class="inside"><p>
			Sei (o sette) mesi fa, lei m'è passata a dieci metri per andare in
			bagno e io sono rimasto tremolante (e paralizzato) per dieci minuti.
			<?=$d->link('Storie/2010/XV/','Leggere')?> per credere.
	</p></div><p>
		Cos'è che ti fa fare questa roba? Cos'è che ti fa sentire così sei mesi
		prima, e sei mesi dopo no?
	</p>
</div><div class="section">
	<p>
		Salve, mi chiamo Ivan e sei mesi fa morivo dietro ad una ragazza. Poi
		m'è passata.
	</p><p>
		Oggi me ne sono ricordato. Allora sono andato a correre per un'ora e
		mezza, e m'è passata.
	</p><p>
		E dieci giorni fa, la ragazza era un'altra. Me ne sono ricordato solo
		adesso.
	</p><p>
		Perché?
	</p><p>
		S'è spezzato, ma non fa male. Perché, dottore?
	</p>
			</div>
		</div>
	</div>
</div>
<?php } ?>
