<?php
	$title=array('Di come sconfissi il LaTeX',
		'I veri programmatori non usano gli strumenti: li costruiscono');
	$prev=array('Storia XXVI', 'Storie/2011/XXVI/');
	$next=array('Storia XXVIII', 'Storie/2011/XXVIII/');
	function mkpage($d){
?>
<div class="small">
	<div class="section">
		<p>
			Venne il giorno in cui mi si chiede di masterare una campagna di
			ruolo. Ed io accettai.
		</p><p>
			Presi dallo scrigno delle idee scartata una vecchia vecchia idea
			malata che ebbi modo di ereditare da un tizio e cominciai a farci
			delle cose losche.
		</p><p>
			E siccome capitai d'avere delle buone idee, mi misi a scriverle.
		</p>
	</div><div class="section">
		<p>
			Come ogni buon informatico (scienziato?) che debba scrivere
			qualcosa, prontamente ho sfoderato il vim ed ho cominciato a buttare
			giù del codice LaTeX per vedere di avere le cose ben fatte fin da
			subito.
		</p><p>
			E invece...
		</p>
	</div><div class="section">
		<p>
			Partendo con l'idea di dover scrivere le bozze per le sessioni,
			oltre alle note sull'ambientazione, le modifiche al regolamento ed
			altre amenità simili, decisi di mettermi a smanacciare con i
			contatori.
		</p><p>
			L'intenzione era di avere un qualche ambiente numberabile, magari
			indicizzabile (ossia comparibile in una listaDiX). Vengo a scoprire
			che non è poi così difficile dichiarare un contatore (che poi non è
			che una variabile intera) che può essere incrementato ad ogni nuova
			istanza di $ambiente. Tolto il fatto che il contatore $contatore non
			è un oggetto che può essere stampato (è un numero, mica una stringa.
			Vuoi il suo contenuto stambabile? Usa il comando \the$contatore),
			la gestione è fattibile.
		</p><p>
			È sufficiente (o almeno così pare) associare un sempre crescente
			numero di comandi ad altrettanti incrementi del contantore. È
			sufficiente creare il contatore come figlio di `chapter' perché esso
			venga resettato ad ogni nuovo capitolo. É sufficiente ridefinire il
			comando di display del contatore perché esso venga raffigurato come
			pare a me anziché come pare a lui.
		</p><p>
			Bene. Butto giù una bozza, metto elementi un po' qua, un po' là.
			Vediamo ora di far comparire una lista degli elementi contati che ho
			aggiunto... dunque, c'è un pacchetto apposito per le liste di X.
		</p>
	</div><div class="section">
		<p>
			Ovviamente, questo non prende contatori; li crea. Quindi va
			immediatamente a confliggere con quelli che ho fatto io. Lascio
			quindi che se li faccia lui, 'sto bastardo, a patto che mi disegni
			le liste come gli dico...
		</p><p>
			Lasciandoli fare i contatori come vuole, il bastardo comincia a
			funzionare. Sistema nuovamente l'incremento ad ogni capitolo,
			sistema questo, sistema quello. Funziona.
		</p><p>
			Ora vediamo di modificare l'aspetto della lista. Fa un po' cagare,
			ovviamente. Non mostra il contatore, mette i puntini tra il nome e
			il numero della pagina, cose normali che odio in modo normale.
		</p><p>
			Dunque, questo aggeggio ha due opzioni soltanto. Una non serve, una
			non funziona e alcuna fa quello che vorrei fare. Ci si metta dunque
			a cercare qualcosa sull'internet che dica come si fa.
		</p><p>
			Ecco comparire di fronte a questi stanchi occhi la guida ufficiale
			del pacchetto. Non servono affatto le opzioni, dato che il LaTeX ti
			permette di ridefinire tutti i comandi come vuoi; vabbeh. Proviamo.
		</p><p>
			Ridefinisci $opzione. Compila. Verifica. Non è come gli ho detto di
			fare. Ripeti.
		</p><p>
			Posso notare una chiara differenza tra la guida e l'effetto generato
			dal mio compilatore. Controlla il numero di versione. La guida è
			&gt;9000 anni indietro, ovviamente. Possibile che la guida ufficiale
			disponibile non tenga il passo? Evidentemente.
		</p>
	</div><div class="section">
		<p>
			Cercando un'alternativa, trovo un bel tutorial scritto da un tizio.
			Eseguo le operazioni consigliate, riesco a togliere i puntini che
			congiungono titoli a numero di pagina. Come lo si fa? Basta
			modificare la spaziatura tra un punto e l'altro, settandola a
			qualcosa come 89000000cm. Che bel trucco del cazzo. Ora, poso
			mettere i numeri davanti ai titoli? Certo, basta modificare il
			comando di display di ogni titolo, facendogli recuperare il valore
			stampabile del contatore, ad ogni riga.
		</p><p>
			Abbastanza facile, abbastanza prevedibile. Il numero compare in
			sovraimpressione, sbavando parzialmente il titolo. Ah. Come sposto
			il titolo a destra dello spazio che serve? Non lo posso fare. Come
			agisco sul numero di pagina in fondo, spostandolo a sinistra un
			pochetto? Non lo posso fare. Come coloro il numero, cosicché sembri
			un link? Non lo posso fare. Come infilo una linea indicante il
			capitolo, ogni volta che il capitolo cambia? Non lo posso fare.
		</p><p>
			La possibilità di piegare questo strumento ai miei voleri s'abbassa
			un po' troppo in fretta. L'internet è sostanzialmente saturato di
			persone come il sottoscritto, ma la risposta alla domanda «posso
			personalizzare X?» è sempre no.
		</p><p>
			Ricordo a quel punto che, in qualche modo, il paccetto ArsClassica
			(quelllo per le tesio fighe) smanaccia mica male con le TOC. Lo farà
			anche per le mie liste, giusto? Utilizzerrano gli stessi comandi,
			giusto? Applicheranno lo stesso stile per TOC, ListOfTables,
			ListOfFigures e ListOfX, giusto?
		</p><p>
			Indovinate.
		</p>
	</div><div class="section">
		<p>
			Provo. I pacchetti confliggono.
		</p><p>
			Scopro che alcuni comandi vengono ridefiniti più di una volta; non
			s'ha da fare. Tolgo incrementalmente (decrementalmente, forse?)
			un'opzione, poi un'altra... arrivo ad un punto di stabilità. Succede
			quindi che la sua roba funziona, la mia invece sembra uscita dal
			Rocky Horror Picture Show.
		</p><p>
			Posso fare anch'io questa roba? «No, è proibito» dice una voce
			demoniaca alle mie spalle «vorresti magari scendere nei meandri del
			LaTeX, addentrarti nelle viscere della bestia e scrivere un tuo
			stile.sty?»
		</p><p>
			No, grazie. Tengo alla mia anima.
		</p>
	</div><div class="section">
		<p>
			Chiedi in giro, cerca, ipotizza. L'idea di scrivere il proprio
			stile, a quanto pare, sembra fattibile come un viaggio in India per
			divenire apprendisti di un qualche santone, passare sette anni in
			Tibet per ricevere l'illuminazione e tornare con un aureola sopra la
			testa.
		</p><p>
			Giunge la voce del Bolo che dice «perché non un altro formato?»
		</p><p>
			In effetti, la possibilità di abbandonare il LaTeX per qualcosa di
			meno peggiore m'allettò. Esistono l'epub, il docbook e molti altri
			formati. Vediamo il formato epub, quello utilizzato dai lettori
			multimediali che spingono in questo periodo...
		</p><p>
			Trattasi di un'archivio con dentro delle cose, fondamentalmente html
			più qualche indice... Niente preprocessore, niente generazione di
			contenuti e infine nessun viewer decente per Debian.
		</p><p>
			Scartato.
		</p><p>
			Vediamo docbook. Mh... sembrerebbe uno standard XML con qualcosa
			come &gt;9000 direttive. In più, il paragrafo corrisponde al tag
			&lt;para&gt;. É decisamente troppo lungo. Non intendo scrivere
			11 (undici) caratteri ogni volta che voglio andare a capo.
		</p><p>
			Inoltre, il supporo software per il testing di questo aggeggio
			sembrerebbe essere inesistente. Forse non ho cercato abbastanza, ma
			non c'era nulla di sufficientemente ispirante, allora.
		</p><p>
			Scartato.
		</p>
	</div><div class="section">
		<p>
			Capita allora il signor Jazzinghen che dice «Perché non produrre PDF
			direttamente dall'HTML, come fai con le storie?» e mi passa un
			linkillo, dove si narra di un certo Prince.
		</p><p>
			Non il cantante, non i biscotti, bensì un magico software
			(proprietario, anche se gratuito) che con un notevole supporto
			CSS2.0 traduce le pagine web su PDF. Occhebello, provare, provare
			subito.
		</p><p>
			L'aggeggio funziona magnificamente. Prende in ingresso un qualsiasi
			numero di file, copia esattamente lo stile fissato, crea persino la
			toc laterale con i PDF bookmark. Wow.
		</p><p>
			Capita ovviamente che il mio stile (quello che vedete leggendo) non
			sia adatto ad un PDF. Mi metto dunque a scriverne un altro,
			apposito; si migliora molto. Mi metto a smanacciare.
		</p><p>
			Smanaccio per due giorni interi. Alcuni nodi vengono al pettine...
			capita infatti che il principe mi metta un bollino viola in prima
			pagina... vabbeh, sopportabile; capita che i sorgenti siano
			proprietari... vabbeh... capita che un sacco di cose interessanti
			(diciamo le interruzioni di pagina, i margini, l'orientamento, la
			carta) siano da precisare tramite strambe direttive CSS non
			standard... uhm, non bene.
		</p><p>
			Faccio qualche ricerca, faccio qualche tentativo. Scopro che,
			fondamentalmente, questo tool non è atto al mio scopo: esso serve a
			poco più che sbrodolare il contenuto di un sito su un PDF, tanto per
			poterlo distribuire tutto in un botto, tanto per farci cose che non
			voglio sapere...
		</p><p>
			Dipendere totalmente da un software proprietario non è una bella
			cosa...
		</p><p>
			Mi chiedo dunque come sia possibile che nessuno prima di me abbia
			avuto la necessità di produrre un PDF per i fatti suoi, senza dover
			scendere a patti con il LaTeX.
		</p>
	</div><div class="section">
		<p>
			Cerca, cerca, cerca...
		</p><p>
			Scopro infine una luce di speranza... esiste un certo (enorme) tool
			Apache, tale FOP, che produce file PDF.
		</p><p>
			Immerso nel marasma, salta fuori un certo formato FOB che
			sembrerebbe essere il passaggio intermedio per ottenere un PDF,
			stando a ciò che dicono, esattamente come tu gli dici... sogno o son
			desktop?
		</p><p>
			Un po' sognavo...
		</p>
	</div><div class="section">
		<p>
			Eccomi dunque (circa 200M di download dopo...) alle prese con il
			tutorial di questa nuova arte mistica... deeddaddoo.... Parrebbe che
			per produrre un PDF bastino poche poche righe di xml
		</p><p>
			Cominciamo con un file di dati, <pre>	name.xml</pre>
			che contiene esclusivamente un tag &lt;name&gt;. Ci metto il mio
			nome. Fatto. Poi scriviamo un file .xsl, formato XML che descrive
			alcune cose... dentro c'è, tra il resto, un oggetto
			<pre>	&lt;template&gt;</pre> che effettua un match contro "/" e
			sbrodola alcuni contenuti descrittivi, come il layout di pagina,
			cosucce accessorie e infine carica il nome dal documento
			precedentemente citato.
		</p><p>
			Compilando il primo con il secondo ottengo un PDF. Con il mio nome.
			Dopodiché, il tutorial finisce...
		</p><p>
			Uhm...
		</p>
	</div><div class="section">
		<p>
			Comincio a chiedere in giro. Scopro alcune cose. Primo, il file XML
			non è specificato in alcun modo, può contenere ogni porcheria. Il
			file XSL invece è ristretto ad alcune specifiche W3C intoccabili.
		</p><p>
			Vado a dare un'occhiata. Mi si apre un mondo. Il formato XSL è la
			definizione formale non solo di uno stile per l'XML, ma supporto la
			trasformazione da un documento all'altro. Quello che si chiama XLST,
			ossia il funzionamenti interno di FOP.
		</p><p>
			Mi tuffo nella tana del Bianconiglio.
		</p><p>
			E scopro cose. Cose terribili.
		</p><p>
			La chiave di tutto è il formato FOB, brodosissimo standard W3C che
			definisce in tutto e per tutto come un documento deve essere
			stampato. Quello che FOP ne fa è appunto tradurlo in un PDF.
			Tuttavia, le dimensioni di questo sorgente sono spaventose: esso è
			costituito fondamentalmente di blocchi rettangolari che contengono
			cose e di elementi inline. Il potere di formattazione è assoluto, ma
			deve essere specificato per ogni componente. CIASCUN blocco deve
			avere il suo simil-CSS specificato.
		</p><p>
			Non ci sono classi, non ci sono eredità, non ci sono moduli. Tutto
			deve essere un unico, lungo, colossale file...
		</p><p>
			Rifiutando istintivamente di percorrere questa via, cerco di capire
			come qualcuno possa seriamente prenderla in considerazione. Scopro
			quindi, fortunatamente, che questo file può tranquillamente essere
			generato tramite una trasformazione.
		</p>
	</div><div class="section">
		<p>
			Saltando alcuni passaggi (non ho più ricordi ben chiari di quegli
			eventi) un file originale XML viene trasformato attraverso un foglio
			di stile XSL in una descrizione formale del documento, in formato
			FOB, che può essere quindi convertito in un PDF.
		</p><p>
			Trattasi quindi fondamentalmente di mettersi lì e fabbricare un
			opportuno foglio di stile applicando il quale ai propri sorgenti XML
			(formattati come meglio mi pare) si ottenga un FOB corretto.
		</p><p>
			La via era chiara.
		</p>
	</div><div class="section">
		<p>
			Se il FOB si basa su blocchi ed inline, è anche vero che ci sono
			molte altre cosucce interessanti: il layout di pagina, le sequenze,
			gli header, le colonne, i break, gli header galleggianti; ma ci sono
			anche le liste, le tabelle, le immagini, la numerazione delle
			pagine. Sostanzialmente tutto.
		</p><p>
			Ma queste cose devono essere fabbricate, questo significa che il
			foglio di stile deve definire esattamente tutte (ma proprio tutte)
			le parti del documento finale, deve quindi definire un sacco di
			aggeggini accessori, deve preparare informazioni in formati
			opportuni e deve anche andare a cercare pezzi di contenuti in altri
			punti dell'albero XML del documento originale.
		</p><p>
			Ed ecco quindi che entra in scena anche XPath, il linguaggio che
			naviga gli alberi... XSLT funziona con un sistema di template, che
			matchano espressioni XPath contro la struttura del documento
			originale. Partento dalla radice, secondo ricorsione grezza o
			tramite iterazione su uno specifico subset di elementi, ciascun
			elemento parsato viene riscritto nel documento di destinazione
			secondo un nuovo formato.
		</p><p>
			E poiché ricorsione, iterazione, selezione, scelte, variabili e
			chiamate a funzione sono tutte supportate, ecco che diventa
			possibile non solo prendere il sorgente e produrne un FOB
			equivalente, ma è altrettanto possibile ripassare tutto il documento
			più volte, compilarne quindi degli indici, contarne gli elementi,
			produrre i bookmark, aggiungere link interni ed esterni...
		</p><p>
			E soltanto un paio di settimane dopo, eccomi bel bello con un foglio
			di stile, magnificamente diviso per ambiti che conta qualcosa come
			600 righe... un po' troppo per essere facilmente controllabile...
		</p><p>
			E soltanto un'altra settimana dopo, eccomi quindi con uno script che
			prende vari frammenti XSL e ne produce (cattandoli uno dopo l'altro)
			un unico foglio di stile, eccomi quindi con un paio di eseguibili
			basati su libxml2 che producono il mio sorgente completo (anch'esso
			splittato su &gt;9000 file) e che lo verificano contro uno schema.
		</p><p>
			Eh già, lo schema...
		</p>
	</div><div class="section">
		<p>
			Succede infatti che, ogni tanto, qualcuno voglia verificare la
			correttezza di un file. Con un parser, verosimilmente. Secondo un
			dato schema.
		</p><p>
			Per l'XML, esiste XMLSchema, fatto apposta, fatto in XML. Dove trovo
			io un verificatore che prenda un file, uno schema e controlli l'uno
			con l'altro?
		</p><p>
			Non lo trovo.
		</p><p>
			Non esistono tool per questo. L'ho cercati invano per un paio di
			giorni, ma non c'è speranza. É stato necessario scaricare una
			libreria e convincerla (con un minuscolissimo eseguibile
			copincollato dalla rete) ad effetturare il parsing.
		</p><p>
			Infine, basta avere un buon Makefile che metta tutto questo
			assieme. Aggiungete alcuni decilioni di tentativi per far quadrare
			tutto, test su test...
		</p><p>
			Sostanzialmente, anche se tecnicamente non finito, il mostro è
			capace di reggersi sulle sue gambe.
		</p><p>
			Ora, questo accrocchio, assolutamente scientifico e nient'affatto
			magnetico nel suo funzionamento, è idempotente al LaTeX, altrettanto
			complesso, ma molto meno oscuro.
		</p><p>
			E se pensate che le formule non siano accessibili, tremate, perché
			MathML esiste!
		</p>
	</div>
</div>
<?php } ?>
