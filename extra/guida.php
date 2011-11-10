Title#Guida
Subtitle#Perché la gente arriva ma non sa dov'è la roba
Next#Extra/Record/#Record

Start#Side
mktid#Perché una guida?#intro
	</p><p>
		L'<?=$d->mktid('Autore', 'gods')?>
		e i suoi <?=$d->mktid('Allegri compagni', 'compagni')?>
	</p><h2>
		Guida
	</h2><h3>
		<?=$d->mktid('Contenuti', 'contenuti')?>
	</h3><p class="reverse">
		<?=$d->mktid('Storie', 'contenuti', 'Storie')?>
		/ <?=$d->mktid('MiniStorie', 'contenuti', 'MiniStorie')?>
		/ <?=$d->mktid('Recensioni', 'contenuti', 'Recensioni')?>
	</p><p class="reverse">
		<?=$d->mktid('Tru Naluten', 'contenuti', 'TruNaluten')?>
		/ <?=$d->mktid('NaNoWriMo', 'contenuti', 'NaNoWriMo')?>
	</p><h3>
		<?=$d->mktid('Meta', 'meta')?>
	</h3><p class="reverse">
		<?=$d->mktid('Extra', 'meta', 'Extra')?>
		/ <?=$d->mktid('Modi', 'meta', 'Modi')?>
		/ <?=$d->mktid('Stili', 'meta', 'Stili')?>
		/ <?=$d->mktid('Voci', 'meta', 'Voci')?>
	</p>
Stop#Side
Start#Page

</div> <?php } if ($this->addpage ()) { ?>
<div class="small">
	<?php if ($d->mktab('intro')) { ?><div class="section">
		<p>
			Questa è la paginetta che ti spiega le cose.
		</p><h2>
			Perché la Guida?
		</h2><p>
			Mi sono reso conto che costruire un sito, programmarne il
			comportomanto e aggiungere qualche nuova <span
			class="code">feature</span> ogni tanto è una cosa, mentre
			condividire con gli altri è un'altra.
		</p><p>
			Ci sono molte cose che semplicemente voi non potete sapere, a meno
			che io non ve lo dica. Ecco perché c'è una guida.
		</p><p>
			C'è stata una <?$d->link('Storie/2010/XX/', 'storia')?>, una volta,
			che tentava di fare la stessa cosa… beh, quella storia non se la
			ricorda nessuno, e ad ogni modo ormai è antiquata.
		</p>
	</div><div class="section">
		<p>
			Ora, qualche parola sulla struttura del sito: potete vedere la prima
			colonna, a sinistra. Quella non cambia quasi mai, è passata per
			alcune piccole modifiche in passato ma senza mai modificare il suo
			scopo. È la barra di navigazione, che contiene una serie di link
			alle sezioni del sito.
		</p><p>
			La seconda colonna, al centro, contiene della yadda, le cose che
			dico e le cose che mi capitano. In cima c'è il titolo, in fondo ci
			sono dei messaggi stupidi.
		</p><p>
			La terza colonna, ampiamente cangante, contiene sempre una quantità
			di link. Ci sono quelli per navigare avanti o indietro tra le pagine
			della stessa serie, quelli per passare da una sezione all'altra, e
			altre cose utili. Provate ad usarla, scoprirete il resto della
			guida.
		</p>
	</div><?php } if ($d->mktab('gods')) { ?><div class="section">
		<p>
			Ed ecco la pagina in cui parlo di me.
		</p><p>
			Il GODS sono io, sono il leggendario autore di Tru Naluten, sono
			l'autoeletto “capo” di “quelli dell'Austud”, sono quello che piglia
			e va a compiere imprese podistiche senza alcun preavviso.
		</p><p>
			Volete una foto?
		</p><p class="foto">
			<a target="_blank" href="Extra/Rampa/Davanti.jpg"><img
				src="Extra/Rampa/Davanti.mini.jpg" /></a>
		</p><p>
			Ma non temete: anche se nella foto ero parecchio stanco, e anche se
			non so chi siete, sappiate che vi guarderei male in ogni caso.
		</p>
	</div><?php } if ($d->mktab('compagni')) { ?><div class="section">
		<p>
			Grazie a qualche dio, non sono da solo, nelle mie avventure.
		</p><p>
			Gli <span class="em">Allegri compagni</span> vengono spesso nominati
			nelle storie, ma non mi sono mai preso la briga di spiegare chi
			fossero. Ecco un bell'elenco. 
		</p>
	</div><div class="section">
		<h2>
			Quelli dell'Aula Studio
		</h2><p>
			Fin da quando ci siamo spostati nel nuovo edificio, la nostra
			compagnia è nota per prendere possesso dei tavoli, far gran casino e
			dominare sia la vita vera che l'internet.
		</p><ul><li>
				il <span class="bolo">buon Bolo</span> è la persona che conosco
				da più tempo, entro queste mura; abbiamo cominciato insieme,
				abbiamo collaborato per gli esami per lungo tempe etc etc etc…
				spesso mi rivolgo a lui direttamente, per evitare che usi i suoi
				terribili poteri di	<span class="code">Grammar Nazi</span> per
				spottare errori nelle mia pagine.
			</li><li>
				il <span class="dacav">giovane Simgi Dacav</span>, vecchio più
				di tutti noi messi assieme, è un troll potente e meticoloso, ne
				ha viste di tutti i colori e possiede incredibili poteri. Non
				mangiando brioche e girando spesso con la cremina per le mani, è
				noto all'esterno come <span class="em">Mr. Benessere</span>.
			</li><li>
				<span class="mitch">Mitch</span>, il <span class="em">re del
				gossip</span> conosce tutto e tutti, ha una lunga esperienza
				nell'aiutare i nabbi e una grande pazienza. Attualmente, s'è
				trovato un vero mestiere.
			</li><li>
				il <span class="jazz">signor Jazzinghen</span>, ch'è molto
				importante (tutti lo chiamano “signore”) è un acquisto
				relativamete recente (in confronto al Dacav, ovviamente), è
				estramamente rumoroso e blah.
			</li><li>
				il tre volte dottore <span class="war">War(rior)</span> alleggia
				nei dintorni, perché lui fa cose. Ne sa un sacco.
		</li></ul>
	</div><div class="section">
		<h2>
			Altri allegri compagni
		</h2><p>
			Non tutti i miei amici studiano in questa facoltà, non ci spendono
			la vita, ma fanno anche altre cose.
		</p><ul><li>
				<span class="em">Luber</span>, ad esempio, ha un lavoro vero e
				una vita vera. Fa cose, recensisce anime terribili e gioca con
				me ad Exalted.
			</li><li>
				<span class="em">Dave</span> ossia <span class="em">Il
				Troll</span> invece è una creatura a parte. Narra la leggenda
				che fosse qui in facoltà da tempo immemore, ma poi – per motivi
				ignoti ai mortali – sparì ritirandosi a vita eremitica. Torna
				ogni tanto, attraverso visioni oppure in forma astrale.
		</li></ul>
	</div><?php } if ($d->mktab('contenuti')) { ?><div class="section">
		<a id="Storie"></a><p>
			Le storie sono il vero cuore della baracca.
		</p><h2>
			Storie
		</h2><p>
			Si cominciò un po' di tempo fa, mi par che fosse attorno al settembre
			2010. Prima di quello, io e i miei allegri compagni, il <span
			class="em">popolo dell'aula studio</span>, tenevamo le storie per
			tradizione orale, come facevano gli antichi.
		</p><div style="float:right;width:50%">
			<a id="MiniStorie"></a>
			<div class="section" style="margin-left:10px;margin-top:1px"><h2 class="reverse">
				Le MiniStorie
			</h2><p style="padding-left:5px;">
				Ci sono state anche delle storie troppo brevi per meritare una
				pagina intera. Hanno cominciato a comparire nella pagina delle
				news nel settembre 2011.
			</p></div>
		</div><p>
			Da allora, ho sbrodolato una crescente e sorprendente quantità di
			storie. A volte sono semplicemente stupide, a volte invece raccontano
			pezzi di vita vissuta, a volte invece sono lo sfogo per le emozioni che
			non riesco a tenermi dentro, ma di cui non voglio parlare.
		</p><p>
			Perché scrivere è più comodo. Ed è anche divertente. Ma non fidatevi
			di quello che scrivo, per carità: tutto quello che finisce nelle
			storie viene scritto di getto, non viene revisionato da nessuno… in
			più, tutti i contenuti sono spesso inaffidabili, contengono falsità
			e opinioni assolutamente personali.
		</p><div style="float:none;clear:both"></div>
	</div><br /><div class="section">
		<a id="Recensioni"></a><h2>
			Recensioni
		</h2><p>
			Perché, se all'inizio raccontavo soltanto delle cose, un giorno ho
			finito per scrivere una storia immensamente lunga che in pratica
			recensiva (nel mio personale e peculiare stile) un certo
			<?=$d->link('Storie/2011/XXXVIII/','anime')?>.
		</p><p>
			Da quel punto in poi ho deciso che forse sarebbe stato il caso di
			riservare uno spazio dedicato a cose come quella. E poi ho cominciato.
		</p>
			Ho cominciato a recensire film, quindi. Ce ne sono parecchi. Per la
			magggior parte brutti. È per questo che ho creato una categoria apposta.
		</p><p>
			L'arte dei film brutti è una cosa rara e raffinata. Pochi li sanno fare,
			pochi li sanno apprezzare. E spesso non ho briga di scrivere…
		</p>
	</div><div class="section">
		<p>
			Ma non solo film!
		</p><p>
			Mi sono messo a recensire tutto quel che mi passa per le mani:
			videogiochi, libri, serie tv. In effetti, gli show sono quel che va per
			la maggiore, perché ne guardo tanti.
		</p>
	</div><br /><div class="section">
		<a id="TruNaluten"></a><p>
			Le pagine più antiche presenti sul sito, tecnicamente.
		</p><h2>
			Tru Naluten
		</h2><p>
			Questo racconto è l'originale motivo per cui il sito esiste. Si
			tratta di una lunga e grossa storia fantasy, per la maggior
			parte ancora non scritta: mi porto dietro il progetto da una
			decina d'anni, ormai…
		</p><p>
			I capitoli escono con una sporadicità spaventevole, ma non
			temete, so esattamente dove andrà la storia.
		</p>
	</div><br /><div class="section">
		<a id="NaNoWriMo"></a><h2>
			NaNoWriMo
		</h2><p>
			Il NaNoWriMo, avvenimento al quale partecipo dal 2010, è una cosa
			interessante, ma anche lunga. E quindi si merita la sua sezione
			dedicata.
		</p>
	</div><?php } if ($d->mktab('meta')) { ?><div class="section"><a id="Meta"></a>
		<p>
			Metasezione!!!
		</p><h2>
			Meta [ Extra ]
		</h2><p>
			Questa sezione è appunto dedicata a questa sezione.
		</p>
	</div><div class="section">
		<p>
			All'inizio (in realtà, fino a poco tempo fa, qualcosa come alcune
			settimane…) utilizzavo la sezione ‘extra’ soltanto come luogo in cui
			mettere tutte le immagini che compaiono sul sito; al tempo, erano tre.
		</p><p>
			Poi, con il passare del tempo, quelle immagini sono invecchiate, si sono
			coperte di polvere e da quella polvere è germinata della muffa, che alla
			fine, evolutasi fino allo stato di creatura senziente, è divenuta questa
			pagina che state leggendo.
		</p>
	</div><div class="section"><a id="Modi"></a>
		<p>
			Ci sono modi e modi.
		</p><h2>
			Meta [ Modi ]
		</h2><p>
			O forse dovrei chiamarle “modalità”?
		</p><p>
			Oh beh, una volta c'era un solo stile CSS. Una volta dopo, ce ne furono
			tre: quello blu, quello rosso e quello nero.
		</p><p>
			Gestire tutta quella roba diventò un gran lavoraccio, e con il tempo
			tornai ad avere un singolo stile… quello che dovreste vedere
			normalmente.
		</p>
	</div><div class="section">
		<p>
			Ma la vita è piena di sorprese. Un bel dì mi venne in mente di dividere
			le pagine in tab, e scoprii che non tutti i browser supportano l'evento
			<span class="em">onHashChange</span>, in particolare non il browser
			dell'amico Luber.
		</p><p>
			Questo triste fatto gli rese impossibile accedere ad una buona parte dei
			contenuti… decisi allora di aggiungere il <span class="code">Luber
			Mode</span>, che spalma tutti i tab uno in fila all'altro. E siccome
			anche il <span class="bolo">buon Bolo</span> aveva lo stesso problema,
			creai un alias a suo nome.
		</p>
	</div><div class="section"><a id="Stili"></a>
		<h2>
			Meta [ Stili ]
		</h2><p>
			Infine, un bel dì mio fratello capitò sul sito e si lamentò di non
			riuscire a distinguere una beata mazza di quel che vedeva. Per lui c'è
			quindi il <span class="code">Dado mode</span>, dai colori più classici.
		</p>
	</div><div class="section">
		<p>
			Potete passare dalla modalità standard (la mia) alle altre calcando
			qualche link in alto a sinistra. Se invece sapete scrivere, potete
			infilare le parole chiave direttamente nell'URL.
		</p>
	</div><?php } ?>
</div><?php } ?>
Stop#Page
