<?php

	$page['title'] = 'La meta';
	$page['subtitle'] = 'Ne ho una?';

	$related['prev']['title'] = 'Capitolo VI';
	$related['prev']['request'] = 'Tru/Naluten/VI/';
	$related['next']['title'] = 'Capitolo VIII';
	$related['next']['request'] = 'Tru/Naluten/VIII/';

	function mkpage ($d, $s, $context) {
?>
						<p>Simak ha riacquistato la memoria &ndash; almeno in parte &ndash; e ritrovato la sua identit&agrave;, ed ora si prepara a riprendere il suo viaggio.</p>
					</div><div class="section">
						<h2>La meta</h2>
						<p>Cosa fa uno, quando torna a casa? Si siede, si prende un caff&eacute;, si riposa. Cosa faccio io, ora che sono tornato in me? Niente caff&eacute;, a quanto pare &ndash; il tizio a cui l'avevo chiesto &egrave; scappato senza dire nulla di sensato &ndash; e qui non c&apos;&eacute; nulla di comodo su cui sedersi. Che fare dunque?</p>
						<div class="inside">
							<?php $d->speak ('ci', 'Che fare, dunque?'); ?>
							<?php $d->speak ('simak', 'Ce ne andiamo'); ?>
							<?php $d->speak ('ci', 'E dove?'); ?>
							<?php $d->speak ('simak', 'Proseguiremo verso la prossima <span class="em">Porta</span>, e giunti l&igrave; la attraverseremo. &Egrave; semplice'); ?>
							<?php $d->speak ('ci', 'Calcolo la rotta [<span class="em">attendere prego...</span>]'); ?>
							<?php $d->speak ('lyz', 'Devo continuare a piedi, vero?'); ?>
							<?php $d->speak ('simak', 'Si, esatto. Cammineremo lentamente, a passo di <span class="em" title="che significa: &laquo;Mortale che cammina sulla Terra&raquo;">Minar kl&apos;vah du&apos;Datundhum</span>. Nessuno si accorger&agrave; di noi'); ?>
						</div>
						<p>O almeno spero. Meno mi muover&ograve;, meno danni arrecher&ograve; a questo luogo.</p>
					</div><div class="section">
						<div class="inside">
							<?php $d->speak ('ci', '[<span class="em">Ricerca completata</span>]'); ?>
							<?php $d->speak ('simak', 'Dunque?'); ?>
							<?php $d->speak ('ci', 'Dobbiamo &ndash; ovviamente &ndash; continuare sulla strada che percorrevamo prima del tuo &quot;<span class="em">risveglio</span>&quot;, poich&eacute; eravamo gia ben indirizzati'); ?>
							<?php $d->speak ('simak', 'Distanza?'); ?>
							<?php $d->speak ('ci', 'Circa un giorno e mezzo di cammino, considerando la velocit&agrave; apparente del sole e il dislivello da affrontare'); ?>
							<?php $d->speak ('lyz', 'Bene! Quanto ho aspettato!'); ?>
							<?php $d->speak ('ci', 'Veramente, non molto, Lyz: hai dovuto attendere soltanto [<span class="em">2h:13&apos;:45&quot;:123</span>], di cui [<span class="em">1h:48&apos;:34&quot;:754</span>] spesi in stato di incoscenza'); ?>
							<?php $d->speak ('lyz', 'Non intendevo questo'); ?>
							<?php $d->speak ('ci', 'Lo so. Mi piace stuzzicarti'); ?>
						</div>
						<p>Ho come l&apos;impressione che il mio risveglio abbia influito anche su questi due... Forse, ora sono pi&ugrave; simili a come li ricordo.</p>
						<p>La sensazione &egrave; quella di rivedere due fratelli che litigano tra loro: &egrave; passato tanto tempo, ma nulla sembra cambiato; nonostante la nostra et&agrave; sia abbastanza grande da rendere la differenza estremamente sottile, riesco comunque a provare un dolce senso di superiorit&agrave; nei loro confronti &ndash; una cosa che mi mancava, senza che lo sapessi &ndash; tralasciando il fatto che sono lontano anni luce dalla mia meta &ndash; e non &egrave; un&apos;esagerazione &ndash; e che tutto ci&ograve; che ero &egrave; cambiato.</p>
						<p>&Egrave; bello essere tornato.</p>
					</div><div class="section">
						<p>Mi fermo a pensare... &Egrave; metaforico, ovviamente: il Lyznardh non ha bisogno di me per muoversi, ci pensa il Lyz. Lui pu&ograve; occuparsi allegramente di tutto, mentre io sonnecchio o rifletto. Questa &egrave; una delle cose interessanti che ho ricordato nell&apos;ultimo quarto d&apos;ora: <span class="em">eLyznardh</span> &egrave; davvero una macchina bel oliata. Se ci provo, non riesco bene a ricordare da quanto tempo io, Ci e eLyz stiamo insieme... dev&apos;essere un&apos;eternit&agrave; &ndash; forse lo &egrave; davvero. Anzi, lo &egrave; proprio! Ricordo che una volta, Ci disse:</p>
						<div class="inside">
							<?php $d->speak ('ci', 'Per quanto mi riguarda, posso definire come &quot;<span class="em">Eternit&agrave;</span>&quot; un qualsiasi periodo di tempo, la cui durata sia superiore alla vita di Umundhum. Similmente, definisco il termine &quot;<span class="em">da sempre</span>&quot; come qualsiasi periodo di tempo a partire da una data antecedente la fondazione di Umundhum, ed anche &quot;<span class="em">per sempre</span>&quot; qualsiasi periodo di tempo che finisca in una data seguente alla distruzione di Umundhum. Le tre precedenti, supponendo che Umundhum abbia fine'); ?>
						</div>
						<p>Credo avesse ragione.</p>
					</div><div class="section">
						<p>Che cos&apos;&eacute;? Avverto un senso di distaza, come se mi trovassi di fronte ad un abisso; come se fossi lontano da qualcosa...</p>
						<div class="dream">
							<?php $d->speak ('corona', 'Dicesi &quot;<span class="em">nostalgia</span>&quot;, Simak'); ?>
							<?php $d->speak ('simak', 'Gi&agrave;, come scordarlo...'); ?>
							<?php $d->speak ('corona', 'E cos&igrave;, sei tornato te stesso, eh, Simak?'); ?>
							<?php $d->speak ('simak', 'Forse. Ma non provo piacere, nell&apos;essere tornato &ndash; se &egrave; questo che intendi: &egrave; diverso'); ?>
							<?php $d->speak ('corona', 'Diverso come?'); ?>
							<?php $d->speak ('simak', ' Come quando ci si volta indietro per rivedere la propria vita, come quando ci si ferma davanti allo specchio per osservare la propria faccia... Io sono una persona che si &egrave; rivista allo specchio dopo molto tempo, e trova che l&apos;immagine che lo specchio mostra &egrave; dissimile &ndash; e non poco &ndash; da quello che la mente immaginava... Ecco, sono una persona che non si piace; anzi, che ora ricorda di saper bene di non piacersi'); ?>
							<?php $d->speak ('corona', 'E dunque, perch&egrave; rimanere te stesso, Simak?'); ?>
							<?php $d->speak ('simak', '&Egrave; inevitabile'); ?>
							<?php $d->speak ('corona', 'Lo &egrave; davvero?'); ?>
							<?php $d->speak ('simak', 'Oh s&igrave;, lo &egrave; davvero: &quot;<span class="em">Vi deve essere eLyznardh: uno ed uno soltanto, sempre</span>&quot;. Mai ho trovato chi fosse degno di sostituirmi, mai qualcuno che potesse reggere'); ?>
							<?php $d->speak ('corona', 'Nemmeno tra i nemici?'); ?>
							<?php $d->speak ('simak', 'Ah, gia... tra i nemici, qualcuno v&apos;&egrave; stato. Peccato che abbiano incontrato la morte per mano mia. E questo &ndash; dovrai riconoscerlo &ndash; di fatto ne fa degli indegni'); ?>
							<?php $d->speak ('corona', 'Verr&agrave; ben il degno'); ?>
							<?php $d->speak ('simak', 'Un giorno, quando sar&ograve; troppo stanco per andare avanti, sar&agrave; meglio che egli sia arrivato'); ?>
							<?php $d->speak ('corona', 'E se fosse gia arrivato?'); ?>
							<?php $d->speak ('simak', 'Chi, lui? Usurpa il nome, il mio volto e il mio trono: che sia dunque degno anche di usurpare il mio titolo? Forse. Ma credo invece che presto comparir&agrave; anch&apos;egli nella lunga lista di coloro che sono caduti per mia mano'); ?>
							<?php $d->speak ('corona', 'Altro sangue sulle tue mani, Simak. Altra distruzione seminata per la tua ambizione. Ormai, non vi &egrave; quasi <span class="em" title="che significa: &laquo;Figlio di Zathot&raquo;">Zathotan</span> che non ricordi la morte per tua mano; e per cosa, poi? Per lei?'); ?>
							<?php $d->speak ('simak', 'Non la nominare. Che ne sai tu, <span class="em">Coscienza</span>, di quello che pu&ograve; valere un sincero legame? Tu hai gia abbandonato molte volte il tuo compagno: io invece resto fedele a lei fin da sempre. E lei a me'); ?>
							<?php $d->speak ('corona', 'Vivrai dunque per questo legame? Esso non sar&agrave; pi&ugrave;, un giorno: verr&agrave; spezzato. E quando lei verr&agrave; meno al suo giuramento, che cosa farai, Simak? Che cosa onorerai? Vivrai forse del mero ricordo? O forse, <span class="em">morirai</span> del mero ricordo?'); ?>
							<?php $d->speak ('simak', 'Sei infida. Ed anche crudele. Ma soprattutto hai torto, e mi compiaccio nel ricordartelo'); ?>
							<?php $d->speak ('corona', 'Vivi un&apos;illusione, Simak. E non sei assicurato: quel giorno perderai tutto, quello che hai e quello che sei. Allora, sar&agrave; compiuto'); ?>
							<?php $d->speak ('simak', 'Ho sentito abbastanza'); ?>
							<?php $d->speak ('corona', 'D&apos;accordo, Simak: alla prossima'); ?>
							<?php $d->speak ('simak', 'Ah. Sbagli, Coscienza'); ?>
						</div><div class="dream">
							<?php $d->speak ('simak', 'Ha torto, vero?'); ?>
							<?php $d->speak ('sacomne', 'Per sempre, giurai. Per sempre sar&agrave;. Per te, Simak, come al principio, ora e sempre'); ?>
							<?php $d->speak ('simak', 'Ora e sempre, per te, Sacomne'); ?>
						</div>
						<p>Verr&agrave; colui che &egrave; degno. E quando verr&agrave;, sar&ograve; ben lieto di passargli questo fardello. Ma fino ad allora, questo compito rimane mio, ed io soltanto lo porter&ograve; avanti!</p>
						<p>Il mio compito, per&ograve;, non mi obbliga a rimanere sveglio durante gli spostamenti, pertanto ora schiaccer&ograve; un sonnellino.</p>
						<div class="dream">
							<p>Buona</p>
							<p>notte...</p>
							<p>...</p>
							<p>...</p>
						</div>
					</div><div class="section">
						<div class="inside">
							<?php $d->speak ('ci', 'La Porta &egrave; in vista!'); ?>
							<?php $d->speak ('simak', 'Yawn! &apos;ngiorno...'); ?>
							<?php $d->speak ('lyz', 'Oh, guarda come dorme bene il pupo... Perch&eacute; non ti rendi utile?'); ?>
							<?php $d->speak ('simak', '&Egrave; perch&eacute; ho piena fiducia in te, Lyz'); ?>
							<?php $d->speak ('lyz', 'No, &egrave; perch&eacute; sei un fancazzista! Mentre <span class="em">io</span> cammino tu dormi, mentre <span class="em">io</span> combatto tu filosofeggi, mentre <span class="em">io</span> mi do da fare per concludere questa missione in incognito del cazzo, tu cosa fai? Sogni la rossa e parli da solo?!?'); ?>
							<?php $d->speak ('simak', 'Si, si, Lyz, sappiamo tutti quanto tu sia efficiente nel tuo lavoro. Ecco, prendi uno zuccherino...'); ?>
							<?php $d->speak ('lyz', 'Ma che fai, mi pigli per il culo?!?'); ?>
							<?php $d->speak ('simak', 'No, certo che no. Sono pi&ugrave; convinto che te lo meriti. Anzi, to&apos;, <span class="em">due</span> zuccherini'); ?>
							<?php $d->speak ('lyz', 'Allora vuoi botte, eh? Vieni quaggi&ugrave; e facciamo un po&apos; i conti!'); ?>
							<?php $d->speak ('simak', '<span class="forte">&Egrave; forse una sfida?</span>'); ?>
							<?php $d->speak ('lyz', 'Ehm... no!'); ?>
							<?php $d->speak ('simak', '<span class="forte">Perch&eacute; tu sai bene come terminano le cose, quando vengo sfidato</span>'); ?>
							<?php $d->speak ('lyz', 'Mh! Certo. Scusa, capo'); ?>
						</div>
						<p>Avevo scordato quanto eLyz potesse essere strafottente. Ma per fortuna, mi sono anche ricordato di come posso strigliarlo.</p>
						<div class="inside">
							<?php $d->speak ('simak', 'Perdona l&apos;interruzione, Ci. Prosegui'); ?>
							<?php $d->speak ('ci', 'Certo. Dunque, la Porta &egrave; in vista, a circa settanta minuti di cammino di fronte a noi'); ?>
							<?php $d->speak ('lyz', 'Giusto un po&apos; di pazienza...'); ?>
						</div>
						<p>Eccola, infatti.</p>
						<p>La Porta si staglia all&apos;orizzonte. Sporge da dietro le montagne, e la sua architrave sfiora le nuvole. &Egrave; ancora presto per apprezzare appieno i suoi decori nel dettaglio, ma gia ora i disegni cominciano ad apparire: la Porta &egrave; completamente decorata, forse con un&apos;iscrizione, e sui battenti sono scolpiti due grossi <span class="em" title="che significa: &laquo;Abitanti del Cielo&raquo;">Chadand</span> in armatura cerimoniale, nell&apos;atto di fronteggiarsi.</p>
						<p>&Egrave; impressionante, nonostante stia li da sempre, conserva ancora la sua magnificenza. Con ottima probabilit&agrave;, conserva anche la sua mitica robustezza: non sar&agrave; facile passare.</p>
						<p>Tuttavia, io passer&ograve;: la mia meta &egrave; oltre quella porta. Non varr&agrave; qualche mitico <span class="em">sasso</span> a fermarmi.</p>

<?php } ?>
