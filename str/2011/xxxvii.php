<?php
	$title=array('PHP','L&apos;accrocchio venuto dall&apos;inferno');
	$prev=array('Storia XXXVI','Storie/2011/XXXVI/');
	$next=array('Storia XXXVIII','Storie/2011/XXXVIII/');
	function mkpage($d){
?>
<div class="small">
	<div class="section">
		<p>
			Avete mai visto tutti quegli indici per la navigazione che io metto
			in giro per le pagine?
		</p><p>
			Servono a rendere rapida la navigazione.
		</p><p>
			Ora, li ho scritti io; gl'ho scritti in modo che reagiscano
			automaticamente una volta modificati, sperabilmente in fretta. Però
			io non li uso, essendo creatore del mostro e avendo più rapidità con
			l'accesso diretto tramite URL.
		</p>
	</div><div class="section">
		<p>
			Poi un bel dì si presentò un difetto.
		</p><p>
			Saltò fuori l'uomo che mi scova i bachi, che sarebbe il <span
			class="bolo">Bolo</span>, e mi dice
		</p><div class="outside">
			<p>
				«<span class="bolo">Guarda che l'indice generale delle storie non
				indica l'ultima</span>»
			</p><p>
				Ed io, che conosco la serietà del tizio, faccio «<span
				class="gods">IMPOSSIBORU.jpg! L'indice del 2011 la riporta
				eccome!</span>» dimostrando immediatamente la verità.
			</p>
		</div><p>
			Purtroppo, caso non poi tanto raro, abbiamo entrambi ragione:
			l'indice del 2011 riporta tutte le storie, mentre l'indice generale
			ne riporta una in meno...
		</p>
	</div><div class="section">
		<p>
			Verifico prontamente la presenza del problema sul server locale:
			noto che il problema non esiste.
		</p>
	</div><div class="section">
		<p>
			Decido di non picchiare ulteriormente la testa, pensando che tanto
		</p><div class="inside"><p>
			«<span class="gods">Quando aggiornerò l'indice per includere la
			storia successiva, il problema sparirà</span>»
		</p></div><p>
			E invece... quand'ecco che aggiorno gl'indici e includo la nuova
			storia, il problema rimane il medesimo: l'indice particolare (quello
			di quest'anno) reagisce alle modifiche, quello generale invece
			rimane immutato (almeno per quella parte) e non sente ragioni.
		</p>
	</div></div><div class="section">
		<p id="II">
			Ora è il momento di aggiungere qualche particolare tecnico.
		</p>
	</div><div class="small"><div class="section">
		<p>
			Capita che gl'indici siano così implementati: c'è una pagina <span
			class="code">index.php</span> per ogni cartella, essa contiene
			null'altro che alcuni comandi <span class="code">require_once</span>
			per incollare i corrispondenti contenuti. Alcune pagine (quelle anno
			per anno) includono soltanto il proprio anno, mentre la pagina
			generale include tutto (per valori di tutto pari a due).
		</p><p>
			Semplice, no? Pulito, no? Scalabile, no?
		</p><p>
			Sono tutte “cose buone” del PHP, ossia l'equivalente meno dannoso
			tra i possibili approcci.
		</p>
	</div><div class="section">
		<p>
			Ora, quello che succede è che, evidentemente, sul server remoto una
			specifica chiamata <span
			class="code">require_once('str.2011.php')</span> effettuata da <span
			class="code">str.php</span> (che sarebbe l'indice generale)
			fallisce.
		</p><p>
			Con ‘fallisce’ intendo dire che va a pescare un file il cui
			contenuto non corrisponde con il file che ho uploadato.
		</p>
	</div><div class="section">
		<p>
			Constatando dunque che il problema persiste agli aggiornamenti ma
			si verifica soltanto sul server remoto, mi sono messo il grembiulino
			e mi sono messo a pulire il server: ho tolto tutti i file
			incriminati, ho verificato che tutto si rompesse, ho rimesso i file
			buoni, ho controllato che tutto funzionasse regolarmente.
		</p><p>
			E invece...
		</p><p>
			Ecco che quella chiamata specifica continua a pescare, in qualche
			modo, un file cachato che non riesco a trovare.
		</p><p>
			Prendo lo scopettone, lo sturacessi e comincio a sterminare con
			l'alcohol tutto quello che mi capita a tiro. Niente.
		</p>
	</div><div class="section">
		<p>
			Mi metto a fare tentativo progressivamente più strambi e improbabili
			per tentare di flushare la cache del server, tolgo e rimetto pezzi a
			destra e a manca, aggiorno cose, tolgo e metto le ghette
			all'elefante, cose del genere... nulla...
		</p>
	</div><div class="section">
		<p>
			Scateno la <span class="em">nerdaconsulta</span>, ma nemmeno la
			forza congiunta di sette giovani nerd anziani vale a risolvere il
			problema.
		</p><p>
			M'arrendo al momento del pranzo.
		</p>
	</div><div class="section">
		<p>
			Quand'ecco, mentre sono in coda per prendere il mio bel panozzone,
			mi compare <span class="em">Codd</span> e mi suggerisce di guardare
			altrove, perché spesso ci sono file estranei in tutte le cartelle.
		</p>
	</div><div class="section">
		<p>
			Abbandono quindi il panino in attesa per tornare alla mia
			postazione: controllo, ed ecco un file <span
			class="code">str.2011.php</span> nella root del sito.
		</p><p>
			Come ci sarà finito? Sappiate che mentre me ne sto in facoltà, tutto
			passa trasparentemente per un bel proxy che fa cose terribili. Tra
			le <span class="latino">terribilia&amp;terribilia</span> del proxy, c'è
			l'impossibilità di lanciare una <span class="code">rm</span> o una
			<span class="code">mv</span> perché... perché... boh.
		</p><p>
			Succede quindi che io non possa cancellare o spostare file sul
			server: posso soltanto aggiornarli e aggiungerli.
		</p><p>
			Fondamentalmente, quando per errore aggiungo un foglio di stile in
			una cartella a caso, quel file viene semplicemente ignorato e non è
			dannoso in alcun modo. Ma non sempre!
		</p><p>
			Capita infatti che il path '.' non sia poi così univoco come
			credevo: nell'ordine, infatti, esso rappresenta la cartella presente
			per il file che include, <span class="em">poi</span> per il file
			incluso.
		</p><p>
			Avendo io vari livelli d'inclusione, ho sempre usato path relaviti
			al file in questione. Ma se per caso nella cartella genitrice
			compare un file con lo stesso nome, guarda caso, quello ha la
			precedenza... che brutte cose che mi fai, PHP...
		</p>
	</div><div class="section">
		<p>
			E in quella compare il <span class="bolo">Bolo del malaugurio</span>
			che mi dice
		</p><div class="outside"><p>
			«<span class="bolo">Ecco perché uso sempre path relativamente
			assoluti, nel mio PHP</span>»
		</p></div><p>
			E così mi sono messo a sistemare tutti i path, assoluti dalla radice
			del sito in giù...
		</p>
	</div>
</div>
<?php } ?>
