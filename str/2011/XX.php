<?php

	$m->mkpage('Guida', 'Non fatevi prendere dal panico');
	$m->mkrelated('prev', 'Storia XIX', 'Storie/2011/XIX/');

	function mkpage ($d, $m) {
?>
<div class="small">
	<div class="section">
		<p>
			Mi sono reso conto che non ho mai spiegato a nessuno le
			funzionalità nascoste di questo sito.
		</p><p>
			Oggi lo farò.
		</p><h2>
			Guida
		</h2><h2 class="reverse">
			10 gennaio 2011
		</h2><p>
			Dunque, comincierò raccontando un po' di storia...
		</p><p>
			Anzi no, comincierò dicendo che tutto quanto è stato
			fatto come è stato fatto perché io posso. Non vi piace?
			Beh, me ne sbatto. Andatevene.
		</p>
	</div><div class="section">
		<p>
			Oltre a questo, avrete forse notato le freccie che
			compaiono alla destra di alcuni titoli. Si ottengono
			grazie allo pseudo-attributo <span>:after</span> del
			CSS2. Clickando su un qualunque punto della barra del
			titolo si scatena (altre traduzioni per trigger? Attendo
			consigli...) uno minuscolo pezzo di javascript che
			smaneggia con il CSS e appare e scompare (utilizzabile
			anche come transitivi, a quanto pare) un blocco.
		</p><p>
			La visibilità di questi blocchi è regolata, normalmente,
			dal mio gusto personale, in base a quanto spazio viene
			occupato sul mio monitor. Forse un giorno realizzarò un
			accroccio che metta le vostre preferenze in qualche
			coockie. FORSE.
		</p><p>
			Poi ci sono le sezioni doppie.
		</p>
	</div>
</div><div class="wider">
	<div class="widecontent">
		<div class="section">
			<p>
				Come questa.
			</p><h2>
				Sezioni doppie
			</h2><p>
				Le uso quando i contenuti sono molto articolati,
				come le sezioni personaggi.
			</p><p>
				Ma non devono per forza mostrare entrambi i
				blocchi, come potete vedere. Perché? Perché io
				posso.
			</p>
		</div>
	</div>
</div><div class="small">
	<div class="section">
		<p>
			E possono anche essere invertite.
		</p>
	</div>
</div><div class="revwider">
	<div class="widecontent">
		<div class="section">
			<p>
				Come in questo esempio, ancora senza nulla
				accanto.
			</p><p>
				Ma non vedo grande utilità per questo, e non
				credo che lo userò mai a quel modo. Tranne che
				qui, ovviamente. Questa è una dimostrazione di
				potere.
			</p><p>
				Serve soltanto ad impressionare gli allocchi.
				Impressionati?
			</p>
		</div>
	</div>
</div><div class="small">
	<div class="section">
		<p>
			Ma come dicevo prima, le sezioni doppie sono doppie.
			Hanno del contenuto e una lista di link accanto.
		</p>
	</div>
</div><div id="longrevertable" class="wider">
	<div class="widecontent">
		<div class="section">
			<p>
				Questo è il contenuto.
			</p><p>
				Può avere più paragrafi.
			</p>
		</div><div class="section">
			<p>
				Ed anche più sezioni.
			</p>
		</div><div class="section">
			<p>
				Avete notato quel simbolino accanto al titolo?
				Vicino alla parola &lsquo;Lista&rsquo;? Quello
				indica che il contenuto (largo 3px) sta alla
				sinistra della lista (larga invece 1px).
			</p><p>
				Clickando su un punto della barra, potrete
				vedere &ndash; grazie al JavaScript e al CSS, i
				due blocchi invertiti. Pretty cool, uh?
			</p>
		</div>
	</div><div class="widelist">
		<div class="section">
			<?=$m->mkreverse('revertable', 'Lista')?>
			<p>
				La lista
			</p><p>
				Può contenere
			</p><p>
				Elenchi di cose
			</p><p>
				Ma sono paragrafi, non liste.
			</p>
		</div>
	</div>
</div><div class="small">
	<div class="section">
		<p>
			Poi ci sono dei simpatici codici &ndash; inseribili
			direttamente nell'URL &ndash; che danno effetti
			mirabolanti.
		</p><p>
			Esistono infatti due cose strambe quando si scrive un
			sito.
		</p><ul>
			<li>
				niente funziona mai al primo colpo
			</li><li>
				ci si scorda quello che si è scritto ieri	
			</li>
		</ul><p>
			Per risolvere il primo problema ho inserito la
			possibilità di debuggare questo motore, basta scrivere
			/debug/ dentro l'indirizzo della pagina, in un qualunque
			punto.
		</p><p>
			Per l'altra cosa, spesso capita che io stesso mi scordi
			chi dice cosa. Qualcuno di voi ha letto Tru Naluten?
			Qualcuno si ricorda come parlano i personaggi
			secondari?
		</p><p>
			Beh, io si. Ma il mio amico Bounce no. Per lui ho
			realizzato quindi il comando /bounce/ che può essere
			inserito nell'URL. Provate un po'...
		</p><p>
			Tra l'altro, il nome è un link alla pagina dei
			personaggi. Ma non clickateci qui, perché questa sezione
			(Storie, come potete vedere dal debug) non ha una pagina
			per i personaggi.
		</p><p>
			E se lo volete sapere, è perché il link viene generato
			automaticamente e non ho palle di scrivere una funzione
			che associ ad ogni personaggi la corretta pagina.
		</p>
	</div>
</div><div class="section">
	<p>
		Dimenticavo. Le sezioni, se voglio, possono anche occupare tutto
		lo spazio disponibile. Ma lo trovo abbastanza scomodo, perché
		gli occhi devono fare molta strada per tornare all'inizio della
		riga successiva. Le righe sono molto lunghe, e lo diventano
		anche di più quando si ha un bel monitorone come quello di
		Mitch.
	</p>
</div><div class="small">
	<div class="section">
		<p>
			Quindi ecco spiegato perché lascio tutto quello spazio
			vuoto ai fianchi.
		</p><p>
			Ma lo faccio anche per altri motivi. In particolare,
			perché in questo modo posso spaziare fuori dai bordi.
		</p><div class="inside">
			<p>
				Spesso lo faccio in questo modo.
			</p><p>
				Questo è un blocco di classe
				&lsquo;inside&rsquo;. Indica i blocchi di testo
				in cui il protagonista parla con se stesso.
			</p>
			<?=$d->speak('simak','Non a caso, quando parlo con Ci,
			lo vedete dentro questo blocco')?>
		</div><p>
			Ma i veri dialoghi non stanno dentro, stanno invece
			fuori.
		</p><div class="outside">
			<p>
				Quando i personaggi parlano veramente,
				all'esterno, ecco il blocco
				&lsquo;outside&rsquo;.	
			</p>
			<?=$d->speak('lyznardh','Perché alcune voci sono udibili
			soltanto all&apos;esterno, soprattutto quelle forti')?>
		</div>
	</div><div class="section">
		<p>
			Che altro posso dire?
		</p><p>
			Forse avrete notato che non ci sono più le barre di
			scorrimento. Ci sono state per un breve periodo. Le ho
			rimosse evitando di mostrare l'overflow dei blocchi
			principali, catturando gli eventi del mouse e facendo
			mirabolanti movimenti nascosti. Ancora il JavaScript.
		</p><p>
			Non vi funziona? Forse è per la mia scarsa attenzione al
			supporto crossbrowser. Ma se non vi funziona, non potete
			essere arrivati qui, lol. Ridete con me.
		</p><p>
			Ah, già! Se clickate su &quot;You are a Pirate&quot; nel
			footer della pagina potete trovare il pannello segreto.
		</p><p>
			Non è altro che il form di login. Ma non potete usarlo,
			perché la registrazione non è affatto prevista. L'unico
			utente riconosciuto sono io, i controlli sono
			hard-coded, ma soprattutto non offron alcun benefico,
			perché l'unica cosa che compare dopo il login è un
			pannellino che saluta ed offre la possibilità di
			cancella file arbitrariamente.
		</p><p>
			Ma se avete letto la storia precedente, avrete
			immaginato che nemmeno questo funziona. Eh già, perché
			l'utente di sistema (nodoby, nel mio caso) non ha
			permessi di scrittura per i folder e non può quindi né
			rimuovere né spostare alcunché. Che tristezza.
		</p>
	</div>
</div>
<?php } ?>
