<?php

	$title=array('Extra', 'Di come scrivo questa storia');

	function mkpage($d){
?>
<div class="section">
	<p>
		E visto che questo libro è vivo e in continua
		evoluzione, ho pensato di tener traccia dei suoi
		cambiamenti.
	</p>
</div>
<div id="longs" class="wider">
	<div class="widelist">
		<div class="section">
			<h2 id="straights" class="reverse wider" onclick="javascript:reverse('s')">
				Modifiche
			</h2><ol>
				<li id="li-i">
					<a onclick="javascript:t.show('i')">La visione</a> &ndash; 11/01/2011
				</li><li id="li-ii">
					<a onclick="javascript:t.show('ii')">Le sezioni</a> &ndash; 23/01/2011
				</li><li id="li-iii">
					<a onclick="javascript:t.show('iii')">L'ispirazione</a> &ndash; 16/04/2011
				</li>
			</ol>
		</div>
	</div><div class="widecontent">
		<div class="tab" id="tab-i">

<div class="section">
	<h2>
		La visione
	</h2><h2 class="reverse">
		11 gennaio 2011
	</h2><p>
		Stamattina ho visto chiaramente come il finale sia molto
		più lontano di quanto credessi.
	</p><p>
		Perchè ero convito che il finale fosse dietro l'angolo:
		<?=$d->legend('Corvino')?> sarebbe dovuto comparire di fronte alle
		<?=$d->legend('Streghe')?>, sboroneggiando e calciando
		culi, per poi sedersi sul trono della regina.
	</p><p>
		E invece no. Quello che ho visto stamane cambia tutto:
		le <?=$d->legend('Streghe')?> sono infatti ben preparate
		a ricevere il <?=$d->legend('Multicolore')?>. Risultato?
		<?=$d->legend('Corvino')?> finisce vittima di un
		terribile arcano streghesco che lo catapulta chissà dove
		chissà quando, costringendolo a fare i conti con un
		sacco di altra roba.
	</p><p>
		In particolare, il <?=$d->legend('Trasparente')?> dovrà
		fare i conti con i proprio <?=$d->legend('Colori')?>,
		che si rivelano nient'affatto amichevoli. Ma non dovrà
		vivere queste disavventure da solo, ovviamente. Come
		emerge da quello che prima avevo intitolato capitolo
		finale &ndash; e come avrò modo di spiegare a fondo
		nella sua versione estesa e ben scritta &ndash;
		<?=$d->legend('Corvino')?> apprende dalla defunta
		<?=$d->legend('Ippolita Beatrice')?> il potere di
		esternare i propri <?=$d->legend('Acquisiti')?>, non
		necessariamente a piacimento. E se tenere con se un lupo
		e un corvo può essere fattibile, fare la stessa cosa con
		un drago di sessanta metri può essere problematico.
	</p><div class="inside">
		<p>
			Come faceva Eragon? Lui se l'è cavata, no?
		</p>
	</div><p>
		Ed ovviamente, anche il drago grande come due autobus è
		in realtà il minore dei mali di fronte alla cara
		<?=$d->legend('Camelia')?>, la cui presenza si rivela
		man mano più inquietante.
	</p>
</div>

		</div><div class="tab" id="tab-ii">

<div class="section">
	<h2>
		Le sezioni
	</h2><h2 class="reverse">
		23 gennaio 2011
	</h2><p>
		Come quelle di questo articolo. Perché ho notato come pagine
		come questa possano crescere parecchio...
	</p><p>
		E non é che le sezioni molto lunghe mi diano fastidio, è solo
		che quelle corte mi piacciono di più. Quindi mi sono messo
		d'impegno ed ho studiato il JavaScript.
	</p><p>
		Con i miei nuovi poteri sono stato in grado di dividere queste
		pagine HTML in sezioni separate e invisibili, che poi vengono
		palesata grazie ad oppurtune chiamate del Javascript.
	</p><p>
		E quando il Bolo mi dirà &laquo;che succede se volessi stampare
		la pagina? Come prendo tutti i contenuti?&raquo; beh, quel
		giorno mi metterò a realizzare i PDF dei capitoli. Forse.
	</p>
</div>

	</div><div class="tab" id="tab-iii">
		<div class="section">
			<p>
				Dunque, mi sono rimesso a guardare un po' di serie robottose,
				tra le quali il caro Gundam SEED. Se /m/ sapesse, probabilmente
				(ri)comincerei a ricevere lettere di minaccia e cose del genere.
			</p><p>
				La cosa importante è un'altra, però; m'è infatti tornato in
				mente quando - all'inizio almeno - la serie mi fosse piaciuta
				per il motivo che spesso ci fa piacere le storie. Trattasi
				dell'identificazione con i protagonisti; giungo quindi alla
				conclusione che Corvino non dovrebbe scatenare il conflitto dal
				nulla, né dovrebbe fuggire, ma dovrebbe combattere contro (o forse
				scappare da) qualcosa di concreto. Qualcosa di cattivo che mi
				dia fastidio scrivere.
			</p><p>
				Qualcosa da odiare veramente; non per quello che è ma per quello
				che fa; credo che a Corvino, dopo la crisi sentimentale e la
				scoperta dei propri poteri, occorra perdere qualcosa
				d'importante. Difatto, credo che non sarà più un incidente a
				uccidere i suoi genitori, ma qualcosa di più spettacolare e
				malvagio; Corvino dev'essere molto più Batman e molto più Amuro.
			</p><p>
				Questo significa, probabilmente, che dovrò in qualche modo
				posticipare il funerale, chiudere un poco la parte
				dell'apprendistato, dei due duelli con Battesimo e Smeraldino,
				trovare una scusa per anticipare l'uccisione di Camelia, far
				scoppiare un gran casino, uccidere i genitori, dare un qualche
				ruolo allo zio Torto, scatenare qualche casino che metta Corvino
				alla disperata ricerca dell'Oracolo e di Fisthanlarunai, e poi
				qualche guerra.
			</p><p>
				Tutta la storia dei demoni colorati verrà dopo, qualche tempo
				dopo l'inizio del regno.
			</p>
		</div>
	</div>
</div><script type="text/javascript" src="lib/tloader.js"></script><script type="text/javascript">
	var t = new TLoader();
	if (location.hash) t.show(location.hash.substr(1).toLowerCase());
	else t.show('i');
</script>
<?php } ?>
