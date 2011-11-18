<?php
	$title = array ('Cose complicate','Tante cose, tanto complicate', 'i');
	$prev = array ('Storie/2011/XXII/', 'Tecniche avanzate', 0);
	$next = array ('Storie/2011/XXIV/', 'Il futuro', 0);
	function mkpage ($d) {
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<h2>
				Prima parte
			</h2><div class="outside"><ol><li>
						<?=$d->mktid($d->self, 'La programmazione (I)', 'i')?>
					</li><li>
						<?=$d->mktid($d->self, 'La programmazione (II)', 'ii')?>
			</li></ol></div><ol start="3"><li>
						<?=$d->mktid($d->self, 'La vita fuori di qui', 'iii')?>
					</li><li>
						<?=$d->mktid($d->self, 'Doooon!!!', 'iv')?>
			</li></ol><div class="outside"><ol start="5"><li>
						<?=$d->mktid($d->self, 'Java è il male (I)', 'v')?>
					</li><li>
						<?=$d->mktid($d->self, 'Java è il male (II)', 'vi')?>
					</li><li>
						<?=$d->mktid($d->self, 'Java è il male (III)', 'vii')?>
					</li><li>
						<?=$d->mktid($d->self, 'Java è il male (IV)', 'viii')?>
			</li></ol></div>
		</div><div class="section">
			<h2>
				Seconda parte
			</h2><ol start="9"><li>
					<?=$d->mktid($d->self, 'Il sogno', 'ix')?>
				</li><li>
					<?=$d->mktid($d->self, 'Il sogno dal sogno', 'x')?>
			</li></ol>
		</div><div class="section">
			<form style="margin: 2px 2px 5px 2px; text-aling: center;">
				<fieldset style="text-align: center">
					<legend>Vota anche tu questa storia</legend>
					<input style="width:47%"
						type="reset"
						title="Mi piace"
						value="(^-^)"
						onclick="javascript:alert('Beh, grazie.\nIl tuo commento non verrà preso in alcuna considerazione')"/>
					<input style="width:47%"
						type="reset"
						title="Non mi piace"
						value="(;_;)"
						onclick="javascript:alert('Ah si? Vaffanculo!');location.replace('http://boards.4chan.org/b/')" />
				</fieldset>
			</form>
		</div>
	</div><div class="widecontent">
		<?php if ($d->mktab('i')) { ?>
			<div class="section">
	
	<h2>
		La programmazione (I)
	</h2><h2 class="reverse">
		Lunedì sera &ndash; 31 gennaion 2011
	</h2><p>
		La programmazione è la mia vita. È la mia condanna, è quello che
		sono. È quello che mi piace fare, è quello che odio fare. È
		quello che faccio.
	</p><p>
		Sempre.
	</p><p>
		Anche quando non dovrei, anche quando non vorrei. Anche per
		qualcun altro. Ricordate
		<?=$d->link('Storie/2010/III/','@ragazza[2]')?>? Beh, lei si
		ricorda di me.
	</p><p>
		E venerdì mi scrisse una mail.
	</p>
</div><div class="section">
	<p>
		La mail del Destino disse che quest'oggi lei sarebbe pervenuta
		in questo edifizio al fin di ottenere dal sottoscritto
		informazioni et similia. Riguardanti esse il progetto che
		scrissi per lei quel tempo che fu.
	</p><p>
		E così fu che questo pomeriggio noi si fece la yadda per un paio
		d'ore.
	</p><p>
		Ma pensa un po' che capita?! Lei arriva e comincia con delle
		domande inaspettatamente precise, domande tecniche.
	</p><div><p>
		Parentesi per me, che nonostate &gt;9000 giorni di lontananza
		dal progetto ancora ricordo quasi tutto.
	</p></div><p>
		Scopro quindi che la ragazza s'è effettivamente applicata, s'è
		letta la brodaglia, ha fatto dei ragionamenti ed ha proposto,
		infine, alcune piccole modifiche (effettuate sul momento) per
		meglio adattarsi alle consegne del &quot;buon&quot;
		<?=$d->link('http://teenylime.sourceforge.net/','Guna')?> che
		c'ha delle idee strane in mente. Per Dio, non clickate sul link.
	</p>

	<div class="inside">
		<p>
			Ma la cosa che vorrei segnalare, in realtà, è questa.
		</p><p>
			Ad un certo punto mi viene richiesto di aggiungere un
			controllo di priorità sui messaggi ricevuti. Questo non
			è poi così difficile, ad ogni modo non banale.
		</p><p>
			Occorre effettuare questo controllo quando i messaggi
			vengono ricevuti, non quando vengono processati. Quindi,
			la struttura del messaggio va cambiata.
		</p><p>
			Essendo il messaggio una stringa incapsulata in un
			pacchetto UDP, decido di inserirvi, in testa, un
			singolo carattere che indichi la priorità, 'f' per fast,
			's' per slow.
		</p><p>
			L'idea è che tutti i messaggi che cominciano per 'f'
			vengano inseriti in testa alla coda di messaggi da
			processare, anziché in fondo come gli atri.
		</p><p>
			Tre righe modificate dopo, faccio partire un test. I
			messaggi escono tutti malformati. Vado a verificarne il
			motivo, e vedo che tutti cominciano per 11 o per 16.
		</p><p>
			Perchè?
		</p><p>
			Evindentemente, i caratteri non vengono convertiti a
			stringa, bensì ad un qualche intero. Sono quindi
			costretto a raddoppiare gli apici, creando quindi due
			stringhe statiche da un carattere ciascuna, perché
			l'applicazioni torni a funzionare correttamente.
		</p><p>
			Java.
		</p>
	</div>
</div><div class="section">
	<p>
		Quindi, fondamentalmente, me ne sono tornato al PC con una certa
		soddisfazione. Come quando finalmente vedi il gatto che riesce a
		farla nella sua vaschetta anziché in giro per casa, una cosa
		così, perché non credo d'aver fatto il bene.
	</p><p>
		Ho fatto il male, certo, ma l'ho fatto bene. Per il bene del
		male.
	</p>
			</div>
		<?php } if ($d->mktab('ii')) { ?>
			<div class="section">
			
	<h2>
		La Programmazione (II)
	</h2><h2 class="reverse">
		Lunedì (tutto il dì) &ndash; 31 gennaio 2011 
	</h2><p>
		Sono ancora alle prese con il dannato progetto Avanzato. Oggi,
		rileggendo per bene tutte le slide di definizione della
		consegna, scopro d'aver ben cappellato metà dell'intero
		accrocchio.
	</p><p>
		Perché, bada bene, avere un magazzino infinito non significa
		avere a disposizione ogni possibile combinazione, a scelta;
		significa invece avere un qualche numero di oggetti, creati un
		po' a caso. L'infinito è dato dal fatto che questi oggetti non
		si consumano. Wat.
	</p>
</div><div class="section">
	<p>
		Questo significa che mezzo database dev'essere buttato, mentre
		un elenco di &quot;cose&quot; dev'essere generato dal nulla.
	</p>
			</div>
		<?php } if ($d->mktab('iii')) { ?>
			<div class="section">

	<p>
		Ah, la vita fuori qui... esiste.
	</p><h2>
		La vita fuori di qui
	</h2><h2 class="reverse">
		Domenica &ndash; 30 gennaio 2010
	</h2><p>
		Perché io, ieri, effettivamente, mi sono infilato la tutina e le
		scarpe, dopo aver lavorato in Java per &gt;9000 minuti dopo
		pranzo, e me ne sono andato fuori.
	</p><p>
		Ah! Fuori!
	</p><p>
		Sono riuscito a correre per 35 minuti, fino al ponte di
		Matterello. Poi la morte. Ho sentito chiaramente il bisogno di
		buttarmi a terra e non muovermi più.
	</p><p>
		Sono stato fermo due settimane ed ho perso tutto ma proprio
		tutto l'allenamento? A quanto pare si.
	</p><p>
		Devo tornare a correre tutti i giorni, non c'è altro modo. Chi
		viene con me?
	</p>
			</div>
		<?php } if ($d->mktab('iv')) { ?>
			<div class="section">
			
	<h2>
		Dooooooooon!!!
	</h2><h2 class="reverse">
		Lunedì sera &ndash; 31 gennaio 2011
	</h2><p>
		Avete presente l'onomatopeica esclamazione di stupore usata nei
		manga stupidi?
	</p><p>
		Essa è, per l'appunto
	</p><div class="outside"><p>
		<?=$d->inline('GODS','Doooooooooon')?>
	</p></div><p>
		ed è una cosa che spesso dico non appena qualcuno spara una
		cazzatina. L'espressione assume connotato positivo o negativo a
		seconda della situazione: può infatti indicare stupore di fronte
		ad una buona cosa, ma anche di fronte all'epico fallimento.
	</p><p>
		Onomatopeicamente, quando dico
	</p><div class="outside"><p>
		<?=$d->inline('GODS','Doooooon')?>
	</p></div><p>
		mi volto verso una direzione a caso, con un largo movimento del
		collo.
	</p><p>
		E questa è la fine del prologo.
	</p>
</div><div class="section">
	<h2>
		Eravamo al ristorante...
	</h2><p>
		Questo lunedì a grande richiesta ce ne siamo andati a cena al
		ristorante Thailandese.
	</p><p>
		Buono, caro, piccantino &ndash; ma neanche lontanamente come mi
		sarei aspettato, la prossima volta andiamo al messicano &ndash;
		e con un numero di invitati di principio spaventoso ma infine
		ridimensionato.
	</p><p>
		Dopo la cena si esce per fare il giretto per riaccompagnare a
		casa quelli che abitano vicino e fare qualche altra chiacchera.
	</p>
</div><div class="section">
	<h2>
		Eravamo a spasso...	
	</h2><p>
		Quando ad un certo punto uno dei nostri spara una cazzata. Io
		sposto vistosamente la testa, pianto gli occhi fisso davanti a
		me e urlo
	</p><div class="outside"><p>
		<?=$d->inline('gods forte','Dooooooooooooooon')?>
	</p></div><p>
		Ora, ricordate <a
		href="http://www.youtube.com/watch?v=McAeQiLmEYU">questa</a>
		scena dal film &lsquo;Superman returns&rsquo;?
	</p><p>
		Assomiglia tanto a quello ch'è successo. Perché casualmente, in
		quel momento, stavamo passando accanto a noi due ragazze. Per
		puro caso mi si sono trovate sulla linea di vista e si sono
		prese il &laquo;Dooooooon&raquo; in faccia.
	</p><p>
		Poverine, poi sono scappate...
	</p>			
			</div>
		<?php } if ($d->mktab('v')) { ?>
			<div class="section">
	<h2 class="code">
		public class java.util.Calendar
	</h2><p>
		Secondo il manuale, questa è la classe giusta per rimpiazzare la
		vecchia <span class="code">Date</span>. Perché rimpiazzarla?
	</p><p>
		Perché era un mostro. Ovviamente.
	</p><p>
		Ma il futuro migliora?
	</p>
</div><div class="section">
	<p>
		Naturalmente no.
	</p><p>
		Qualcuno ha pensato che poter ottenere i vari campi come oggetti
		non fosse corretto, ed ha rimpiazzato tutto con una sola
		chiamata, la <span class="code">public int Calendar.get(int, int,
		Locale)</span>. E che saranno 'sti parametri? Il primo è il
		campo, il secondo è lo stile.
	</p><p>
		Bello, eh?
	</p></p>
		Così posso usare la stessa chiamata per sapere s'è mattina o
		pomeriggio, s'è inverno o estate oppure se piove...
	<p><p>
		Ma come distinguo i risultati? Non lo faccio.... Dal Java mi
		sarei aspettato una cascata di Enum per ogni cazzatilla (ed
		infatti così è) ma non in queto caso.
	</p><p>
		Vuoi un mese? Vuoi un giorno? Ci sono rispettivamente dodici e
		sette costanti, tutte belle intere, tutte ottanta elencate nella
		documentazione...
	</p><p>
		Sono ordinate? Immagino di sì, ma come faccio? Le confronto
		tutte tutte? Se voglio il giorno successivo, come lo ottengo?
	</p><p>
		Lo ottengo a mano, ovviamente. Oppure, posso prendere il
		calendario, dirgli di aggiungere <span
		class="code">Calendar.add(Calendar.MONTH, 1)</span> e poi
		chiedergli che mese sia...
	</p><p>
		Voglio sapere qual è il terzo giorno lavorativo da oggi. Come
		faccio? Sapendo che giovedì 1 gennaio 1970 era giovedì (giorno
		3) calcolo:
	</p><div class="outside">
		<p class="code">
			int today = (now / 24 / 60 / 60 % 7 - 3) % 7;
		</p>
	</div><p>
		To', funziona.
	</p>
			</div>
		<?php } if ($d->mktab('vi')) { ?>
			<div class="section">
	<h2 class="code">
		SQLException
	</h2><p>
		Perché una delle cose che in C potrebbero mancarti (se non sai
		arrangiarti, perché non sai usare i puntatori per i parametri
		sensibili e il valore di ritorno per controllare gli errori)
		sono le eccezioni.
	</p><p>
		L'eccezione è quella cosa non prevista, che spesso dipende da
		parametri esterni al sistema oppure da input sbagliati.
	</p><p>
		Bello, no?
	</p><p>
		Beh, no.
	</p><p>
		Perché se pensi che questo significhi poter andare dritto, tanto
		le eccezioni le gestisce il linguaggio? No. Piuttosto significa
		che nessuno controlla più gli errori.
	</p><p>
		Non ci sono più condizioni di ritorno, tutt'al più tutto può
		fallire.
	</p><p>
		Al punto che io, dopo aver ricevuto il risultato di una query,
		non posso guardarci dentro senza prima essermi messo gli
		occhiali di plastica antiinfortunistici.
	</p><p>
		Perché &ndash; nonstante l'oggetto <span
		class="code">ResultSet</span> sia valido, il suo metodo <span
		class="code">boolean next()</span> non restituisce falso in caso
		di fallimento, piuttosto esplode.
	</p>
			</div>
		<?php } if ($d->mktab('vii')) { ?>
			<div class="section">
	<h2 class="code">
		ResultSet.size()
	</h2><p>
		Quando uno effettua una ricerca, la prima cosa che si aspetta di
		vedere è il numero di risultati. Google lo fa. Lo voglio fare
		anch'io...
	</p><p>
		Bene, allora, <span class="code">set.size()</span> non esiste,
		<span class="code">set.length()</span> non esiste, <span
		class="code">set.affectedRow()</span> esiste ma non è
		quello...
	</p><p>
		Dal set posso estrarre quello che mi pare, utilizzando &gt;9000
		metodi che possono fallire miseramente, posso muovermi anche
		oltre i margini &ndash; <span class="code">beforeFirst()</span>
		e <span class="code">afterLast()</span>, storia vera &ndash; ma
		non posso sapere quante righe ho.
	</p><p>
		Non posso nemmeno trasformare questo set in un array, in una
		lista, in qualcosa di utile. Posso soltanto scorrerlo.
	</p><p>
		Ma posso verificare qual è l'indice della riga attuale.
	</p><p>
		Quindi che faccio? Vado in fondo, prendo l'ordinale dell'ultima
		riga e poi torno all'inizio.
	</p><p>
		Ed ovviamente, sia muovermi che leggere l'ordinale sono
		operazioni che possono fallire...
	</p>
			</div>
		<?php } if ($d->mktab('viii')) { ?>
			<div class="section">
			
	<p>
		Qual è la cosa più comoda del Java?
	</p><p>
		L'eredità tra oggetti, forse?
	</p><p>
		Già, peccato che il bel framework delle <span
		class="code">Servlet / JSP / TomCat / GlassFish / JBoss</span> si
		dimentichino di questa cosa.
	</p><p>
		Percui è bene che tutte le Servlet siano servlet, ma non che
		ereditino tra loro... perché?
	</p><p>
		Boh...
	</p>
</div><div class="section">
	<p>
		Ed io che pensavo di star usando il Java per avere i benefici
		del Java... succede invece che &ndash; ovviamente &ndash; il
		framework detta le sue regole (non sempre in modo chiaro) e
		pretende che io pensi come lui pensa.
	</p><p>
		Non appena decido che l'applicativo è divenuto stabile ed i
		parametri di connessione al database possono essere messi in
		configurazione (e non all'interno dei sorgenti) scopro
		malaugaratamente che questo in pratica non è previsto.
	</p><p>
		Risultato?
	</p><p>
		Sono obbligato a moltiplicare i parametri per ogni singola
		pagina, alternativamente posso forzare il caricamento dei
		suddetti in una sezione comune (ereditata) ma non posso perché,
		nonostante quel metodo appartenga alla classe madre, viene
		chiamata con gli offset dei figli... Il sordido hack più orrendo
		che abbia mai scritto ha ben nascosto questa chiamata...
	</p>
			</div>
		<?php } if ($d->mktab('ix')) { ?>
			<div class="section">
	<h2>
		Il sogno
	</h2><h2 class="reverse">
		Qualche giorno fa &ndash; non ricordo bene...
	</h2><p>
		Stavo sognando...
	</p><p>
		Nel sogno, io ed altra gente (non meglio identificata) ce ne
		stavamo tutti allegri in piscina in ammollo. Era una scena alla
		DOA Beach Volley, per intenderci.
	</p><p>
		Per qualche motivo ignoto, ad un certo punto, tutti si comincia
		a correre dietro ad una ragazza che tiene la tipica palla
		gonfiabile da piscina.
	</p><p>
		Chissà perché, chissà per come, finiamo tutti in corridoio...
		in fondo al corridoio vedo comparire un tavolo, su quel tavolo
		vedo comparire delle miniature.
	</p><p>
		Tutti si fermano davanti al tavolo, compreso il sottoscritto. La
		ragazza fugge. Noi ce ne freghiamo, perché sul tavolo è in corso
		una partita di WH40K.
	</p><p>
		Mi sono svegliato.
	</p>
			</div>
		<?php } if ($d->mktab('x')) { ?>
			<div class="section">
	<h2>
		I have a dream
	</h2><h2 class="reverse">
		Non pervenuto &ndash; 201X
	</h2><p>
		Da quel sogno emerse un sogno. Uno di quelli da avere. 
	</p><p>
		Ed ovviamente è un sogno impossibile.
	</p>
</div><div class="section">
	<p>
		Un gioco che sia contemporaneamente divertente, bilanciato e
		possibilmente multipersonaggio.
	</p>
</div><div class="section">
	<p>
		Non esiste, né può esistere.
	</p><p>
		Tant'é che non riesco neanche a immaginarmenlo bene.
	</p><p>
		Ed ora lasciate che provi a spiegarmi.
	</p>
</div><div class="section">
	<h2>
		Bilanciamento
	</h2><p>
		Cosa vuol dire? Beh, non lo so... immagino però che sottintenda
		per lo meno la progressione logaritmica.
	</p><p>
		Se aveta mai giocato di ruolo, saprete quanto il bilanciamento
		della campagna (non solo il livello degli scontri, ma anche
		l'epicità della storia, la portata dei malvagi piani etc etc)
		cambino ad una velocità che non è solo esagerata, ma spesso
		uccide il gioco.
	</p><p>
		In molti sistemi esiste il problema del raggiungimento di quel
		livello in cui il GM non ha più niente di sensato a disposizione
		per fermare i personaggi.
	</p><p>
		Farò un esempio: anni e anni e anni e anni fa facevo il GM (con
		DnD3.0 poi convertito in DnD3.5) per alcuni amici. Il
		villaggetto dei PG viene attaccato da un malvagio stregone; la
		compagnia lo sotterra di botte. Lo stregone scappa verso il
		nord; la compagnia lo insegue. Lo stregone si rifugia presso una
		gilda di ladri, con contatti extraplanari un po' quà un po' là;
		la compagnia sbaraglia la gilda e tutti i suoi componenti. Lo
		stregone scappa presso un castello; la compagnia conquista il
		castello. Lo stregone fugge nell'Abisso e trova rifugio presso
		un potente demone; la compagnia eradica il regno del demone. Lo
		stregone fugge nuovamente nel mondo reale, stringe alleanza con
		un antico drago blu che spadroneggia su mezzo continente; la
		compagnia arriva e fa piazza pulita del regno di terrore del
		drago.
	</p><p>
		Tutto questo, ovviamente, in linea con la progressione suggerita
		dai manuali...
	</p><p>
		Quello, alla lunga, divenne il motivo per cui smisi di
		masterare.
	</p><p>
		Perché, gira e rigira, il gioco è pensato affinché i personaggi
		vincano. E dopo il 12° livello le cose peggiorano drasticamente:
		il guerriero della compagnia può tenere testa ad eserciti
		interi, può sfidare i draghi, le manticore, tutto quello che gli
		mando addosso; il ladro sparisce in pieno giorno, compare alle
		spalle di chicchessia e lo oneshotta con un pugnale nella
		schiena; il mago starnutisce e comincia a piovere palle di
		fuoco. Le distanze non sono più un problema, il viaggio planare
		nemmeno, la morte è solo una breve pausa.
	</p><p>
		Nemmeno il più potente dei re del continente può disporre di un
		suddito paragonabile ai membri della compagnia, nessun esercito
		può fermarli.
	</p>
</div><div class="section">
	<p>
		Nemmeno io posso.
	</p><h2>
		I numeri sono grossi
	</h2><p>
		E i numeri sono tutto.
	</p><p>
		Sono tanti, anche.
	</p><p>
		È per quello che la gente gioca al PC, per evitare il contatto
		con troppi numeri. Perché i numeri ti escono dalle orecchie.
	</p><p>
		Ma questi bei numeri crescono, crescono a velocità diverse e
		finiscono per deformare il gioco. Fondamentalmente, infatti, se
		i tuoi tiri sono abbastanza fortunati e/o i bonus sono
		abbastanza alti, le cose fighe capitano. C'è un sistema per
		evitare che questo succeda?
	</p><p>
		Non che io non voglia vedere le cose fighe che accadono, ma
		troppo spesso sento e vedo storie in cui un sufficiente numero
		di 6/20/100 su una serie di dadi compromette seriamente una
		partita/sessione.
	</p><p>
		E sinceramente odio quando succede, perché vorrei che fosse
		l'abilità del giocatore a fare la differenza.
	</p>
		</div><?php } ?>
	</div>
</div>
<?php } ?>
