<?php

	$page['title'] = 'Dubbio';

	$related['prev']['title'] = 'Capitolo XII';
	$related['prev']['request'] = 'Tru/Naluten/XII/';
	$related['next']['title'] = 'Capitolo XIV';
	$related['next']['request'] = 'Tru/Naluten/XIV/';

	function mkpage ($d, $s, $context) {
?>

	<h2>Tru Naluten XIII &ndash; Dubbio</h2>
	<div class="inside">
		<?php $d->speak ('simak', 'Siamo un mare di merda'); ?>
		<?php $d->speak ('lyz', 'Lo siamo?'); ?>
		<?php $d->speak ('simak', 'Decisamente e assolutamente'); ?>
	</div>
	<p>A volte le cose non vanno come vorrei.</p>
	<div class="inside">
		<?php $d->speak ('lyz', 'E perch&eacute; dovremmo essere nella merda?'); ?>
		<?php $d->speak ('simak', 'Ci, non ho voglia di discutere con l&apos;idiota: fallo tu'); ?>
		<?php $d->speak ('ci', 'Certo, Simak. Dunque, Lyz, come sai la reazione del soggetto `Jo` &egrave; stata diversa da quello che Simak si aspettava. La sua collaborazione &egrave; incerta e questo difatto &egrave; un ostacolo per il piano'); ?>
		<?php $d->speak ('lyz', 'Ah, gia, il piano... Posso ricordarvi che il piano &egrave; stupido e che un esercito non ci serve affatto? Tantomeno un esercito di mortali! Cazzo, Simak, ti basterebbe un fischio per schiodare dall&apos;Inferno legioni su legioni di... di... beh, di ogni genere di cosa!'); ?>
		<?php $d->speak ('simak', 'Quando sei stupido, stupido Lyz. So bene che posso richiamare tutto e tutti, dovunque; e so bene che non mi serve un esercito. Ma se ho scelto cos&igrave;, &egrave; perch&egrave; un buon motivo. Hai scordato anche quello? E dire ch&apos;ero io quello senza memoria...'); ?>
		<?php $d->speak ('lyz', 'Ehm... ?'); ?>
		<?php $d->speak ('simak', 'Ci, continua tu per me...'); ?>
		<?php $d->speak ('ci', 'Certamente. Come consuetudine, eLyznardh ha posto delle condizioni a se stesso per completare l&apos;impresa. Questa volta, inoltre, le limitazioni introdotte sono significativamente superiori a tutte le precedenti'); ?>
		<?php $d->speak ('ci', 'In particolare, eLyznardh ha imposto che &ndash; nonostante l&apos;invasione &ndash; non sia torto un capello ad alcuno, mortale o immortale, Chadan o Zathotan. Inoltre, eLyznardh ha comandato che Datundhum non subisca danni, e che Cheskaldhum non cada'); ?>
		<?php $d->speak ('lyz', 'Ah, ora ricordo. Tutte quella storia per cui dobbiamo portare la guerra all&apos;universo intero, senza rompere niente. Giusto?'); ?>
		<?php $d->speak ('ci', 'S&igrave;. Inoltre, eLyznardh ha scelto di non intervenire direttamente nei combattimenti'); ?>
		<?php $d->speak ('lyz', 'Si, me n&apos;ero dimenticato apposta, per evitare di dire nuovamente:'); ?>
		<?php $d->shout ('lyz', 'Ma che cazzo hai nella testa?!?!'); ?>
		<?php $d->speak ('lyz', 'Simak, tu sei il pi&ugrave; grosso idiota che io abbia mai conosciuto! Ma in fondo questo &egrave; il nostro modo di fare, giusto? eLyznardh &egrave; stupido perch&eacute; dentro ci siamo io e te, Simak! Ora, se permetti, mi dimenticher&ograve; nuovamente di questa faccenda. Per il tuo bene, spero che tu non me la faccia ricordare una seconda volta'); ?>
	</div>
	<p>Mentre quello s&apos;incazza e se la risolve da solo, io e Ci possiamo discutere del da farsi, visto che abbiamo un nuovo imprevisto.</p>
	<div class="inside">
		<?php $d->speak ('simak', 'Dunque, quali sono le nostre speranze attuali?'); ?>
		<?php $d->speak ('ci', 'Considerando le limitazioni autoimposte, e tenuto conto della tua magra figura di ieri, non molte. Se dovessi esprirermi formalmente, ti darei un [<span class="em">18.5%</span>]'); ?>
		<?php $d->speak ('simak', 'Se non m&apos;invento qualcosa, non verr&agrave; con noi...'); ?>
		<?php $d->speak ('ci', '&Egrave; improbabile che decida di seguirci, in base alla situazione attuale'); ?>
		<?php $d->speak ('ci', 'Il protocollo suggerirebbe semplicemente di guidare il suo futuro tagliando le altre vie possibili'); ?>
		<?php $d->speak ('simak', 'Ho scelto di non agire a quel modo, Ci. A quale scopo, infatti, obbligare questi mortali ad essere liberi? Gi&agrave; &egrave; accaduto in Zathot, e sai bene quanto &egrave; costato, a noi e a loro'); ?>
		<?php $d->speak ('simak', 'Se queste creature devono scorrazzare per il mio regno, allora che ne portino il peso. E non sar&ograve; io a guidare questa marmaglia, ma sar&agrave; uno di loro'); ?>
		<?php $d->speak ('ci', 'Il soggetto non &egrave; affatto dello stesso parere. L&apos;esercito, per come intendi realizzarlo, diverrebbe pericoloso sotto la sua guida'); ?>
		<?php $d->speak ('simak', 'E lo sarebbe anche di pi&ugrave; se li lasciassi senza una guida. Devo solo trovare un modo gentile affinch&egrave; lei scelga di accettare'); ?>
		<?php $d->speak ('lyz', 'Giochi fuori casa, caro il mio Simak. Fa&apos; come fanno i mortali, dunque'); ?>
		<?php $d->speak ('simak', 'E come fanno, i mortali? E come fanno cosa?'); ?>
		<?php $d->speak ('lyz', 'Andiamo, sai cosa intendo! I mortali hanno appreso da noi il modo di indirizzare la volont&agrave; altrui, e lo hanno fatto da tempo immemore'); ?>
		<?php $d->speak ('simak', 'Non ti seguo...'); ?>
		<?php $d->speak ('lyz', 'Dai, cazzone! Da quando esistono maschi e femmine, tutti gli esseri di Datundhum hanno giocherellato per portare un loro simile a costruire un nido assieme. Anche tu, per quanto differente da loro, hai fatto cose simili'); ?>
		<?php $d->speak ('simak', 'Stai proponendo un inganno, Lyz?'); ?>
		<?php $d->speak ('lyz', 'Suvvia, `inganno` &egrave; una parola meschina. Sto parlando di `suggerire` una via...'); ?>
		<?php $d->speak ('simak', 'Lyz, come puoi suggerire un&apos;idea del genere ad uno come me. Mi conosci bene, conviviamo nella stessa testa da innumerevoli eoni'); ?>
		<?php $d->speak ('lyz', 'Proprio perch&eacute; ti conosco bene ti sto spingendo verso una grande sfida'); ?>
		<?php $d->speak ('simak', 'C&apos;&eacute; differenza tra una grande sfida e una sfida impossibile. Credo di sapere dove stai puntando, e so che non pu&ograve; funzionare. Non sono fatto a quel modo!'); ?>
		<?php $d->speak ('lyz', 'Ah ah! Eccoti, dunque, signor <span class="em">&quot;solo Sacomne mi capisce&quot;</span>, eccoti rinunciare alla sfida'); ?>
		<?php $d->speak ('simak', '<span class="forte">Tu!</span> Tu mi stai dando del codardo?'); ?>
		<?php $d->speak ('lyz', 'Esatto, <span class="em">grande Simak</span>. Avrai anche grandi poteri, grande scienza, grandi passioni, ma sotto sotto rimani ancora quel piccolo insignificante Cheskal che si nasconde e resta indietro mentre i suoi fratelli minori imparano la vita prima di lui'); ?>
	</div>
	<p>A volte antichi ricordi tornano alla mia mente. Sono ricordi amari, dei tempi in cui non ero pronto per affrontare il mondo che c&apos;era l&agrave; fuori.</p>
	<p>Quando capita, prima mi deprimo.</p>
	<p>Poi mi arrabbio.</p>
	<p>Infine mi rialzo, prendo in mano la situazione ed ottengo quello che voglio. Perch&eacute; sono eLyznardh.</p>
	<div class="inside">
		<?php $d->speak ('simak', '<span class="em">Quel</span> Simak &egrave; morto, morto per mano di eLyznardh'); ?>
		<?php $d->speak ('simak', 'Ed fui <span class="em">io</span> a guidare quella mano'); ?>
		<?php $d->speak ('simak', 'Ebbene, Datol Lyz, questa &egrave; una sfida, ed io la accetto. Poni le tue condizioni'); ?>
	</div>
	<p>eLyz ride sonoramente. &Egrave; sinceramente divertito, poich&eacute; era molto tempo che non accettavo una sua sfida. Ma questa volta, essa fa il gioco di entrambi.</p>
	<div class="inside">
		<?php $d->speak ('lyz', 'Ebbene, queste sono le condizioni che pongo per la sfida. Jo guider&agrave; il nostro esercito, ma giurer&agrave; fedelt&agrave; a Simak soltanto, poich&eacute; sar&agrave; Simak soltanto ad agire. Io giuro qui e subito di trattenermi da qualunque intromissione, fino al giorno in cui Jo assumer&agrave; il comando'); ?>
		<?php $d->speak ('ci', 'Ed io sottoscrivo e giuro lo stesso'); ?>
		<?php $d->speak ('simak', 'Ed io infine accetto queste condizioni, dunque'); ?>
		<?php $d->speak ('lyz', 'Non sia impaziente, bello, non ho ancora finito'); ?>
		<?php $d->speak ('simak', 'Ah no?'); ?>
		<?php $d->speak ('lyz', 'No, infatti: abbia dunque la cortesia di lasciarmi finire'); ?>
		<?php $d->speak ('simak', 'Prego, faccia, faccia pure'); ?>
		<?php $d->speak ('lyz', 'Orbene, dicevo... Ah, s&igrave;: sar&agrave; Simak soltanto, il Cheskald Simak'); ?>
		<?php $d->speak ('simak', 'Rinuncier&ograve; dunque ai miei titoli e ai miei poteri per tutto il tempo che sar&agrave; necessario'); ?>
		<?php $d->speak ('lyz', 'Fino al di lei giuramento, oppure &ndash; in caso di assoluta necessit&agrave; &ndash; fino a quando i tre presenti riterranno opportuno interrompere questo divieto'); ?>
		<?php $d->speak ('simak', 'Ebbene, &egrave; tutto?'); ?>
		<?php $d->speak ('lyz', '&Egrave; tutto'); ?>
		<?php $d->speak ('simak', 'Allora addio, signori. Ci rivedremo qui tra sette giorni, e quando torner&ograve; eLyznardh avr&agrave; un araldo che guider&agrave; i suoi eserciti'); ?>
		<?php $d->speak ('lyz', 'Sette giorni, eh? Buona fortuna, dunque'); ?>
		<?php $d->speak ('ci', 'Buona fortuna, <span class="em">Cheskald</span> Simak'); ?>
	</div>
</div><div class="section">
	<p>L&apos;ho fatto grossa, stavolta.</p>
	<p>Non avrei dovuto rinunciare ai miei poteri con tanta leggerezza, considerata la situazione in cui navigo. Mi sono fatto fregare.</p>
</div><div class="section">
	<p>...</p>
	<p>...</p>
	<p>Sono decisamente nella merda. Saltare righe nella speranza che mi venga qualche idea non funzioner&agrave;...</p>
	<p>...</p>
	<p>E neanche esitare per guadagnare tempo... forse... o forse invece...</p>
	<p>No, no, che vado a pensare? Non servir&agrave;! Devo riconsiderare le mie forze, restare calmo e non nutrire alte aspettative per l'immediato futuro. Mal che vada, sar&agrave; la prima volta che perdo una sfida.</p>
</div><div class="section">
	<div class="outside">
		<?php $d->speak ('simadran', 'E per quanto scoprirsi d&apos;un tratto nudi e inermi, sperduti nel grande mondo sia brutta cosa, lasciamo per qualche tempo il piccolo grande Simak per occuparci invece di qualcuno che navi in acque ben pi&ugrave; minacciose'); ?>
		<?php $d->speak ('simadran', 'Trattasi di una certa giovane donna che abbiamo lasciato alla sua festa di compleanno, leggermente alterata &ndash; se cos&igrave; ci &egrave; concesso dire &ndash; ma non a sufficienza perch&eacute; qualche invitato potesse pensare a qualcosa di diverso dall&apos;eccitamento per la suddetta festa'); ?>
		<?php $d->speak ('simadran', 'Avevano lasciato cadere la povera ragazza tra le braccia del padre, il quale &ndash; mirabilmente guidato da una visione simile a quella di lei, ma molto pi&ugrave; positiva (non si dica che eLyznardh scelga male le visioni che invia) &ndash; cercava in ogni modo di raddrizzarle il morale, mentre procedeva goffamente a tentoni, con domande fin troppo vaghe, nel tentativo di comprendere la visione della figlia'); ?>
		<?php $d->speak ('simadran', 'A sua discolpa diremo che l&apos;amore paterno che dimostr&ograve; con abbracci e tentativi di compresione valse a ripagare la sua incapacit&agrave; di afferare la gravit&agrave; della situazione'); ?>
		<?php $d->speak ('simadran', 'Tale infatti fu l&apos;ardimento che impieg&ograve; per consolare la figlia che dimentic&ograve; di consolare se stesso ed arriv&ograve; a dimenticare il terribile annuncio ricevuto avuto dalla visione, e cio&egrave; che l&apos;indomani avrebbe dovuto salutare la sua figlia adorata per l&apos;ultima volta. Nella sua dimenticanza, accompagn&ograve; Jo, sfinita, nella sua stanza, l&apos;aiut&ograve; a coricarsi e poi si ritir&ograve; per abbandonarsi ad un sonno senza sogni'); ?>
	</div>
</div><div class="section">
	<div class="outside">
		<?php $d->speak ('simadran', 'Ed ora che le creature mortali riposano, possiamo tornare da quell&apos;anima che non dorme ormai da alcuni secoli degli uomini'); ?>
		<?php $d->speak ('simadran', 'Quella creatura &egrave; perduta &ndash; per la prima volta da tempo, ma non per la prima volta &ndash; e cerca di ricordarsi del modo in cui si salv&ograve; quelle altre volte che si ritrov&ograve; in situazioni simili'); ?>
		<?php $d->speak ('simadran', 'Ahim&egrave;, non ci riusc&igrave; affatto. S&igrave;, perch&eacute; &ndash; per quanto fosse eLyznardh il pi&ugrave; grande e potenti di tutti i viventi del suo tempo, e per quanto egli fosse eLyznardh &ndash; c&apos;&eacute; da dire che Simak, il Cheskald Simak, da solo, non valeva poi un gran ch&eacute;... Ecco dunque quel che successe il mattino seguente, in quello stesso prato dove Jo vide la sua nuova casa per la prima volta'); ?>
	</div>
	<p>Per conservare le apparenze, dato che ho gi&agrave; &ndash; ufficialmente &ndash; rinunciato ai miei poteri, eLyz e Ci mi hanno, per cos&igrave; dire, &quot;prestato&quot; eLyznardh per l'incontro di questa mattina. In pratica, anzich&egrave; usare il mio corpo come ho fatto da sempre (da quando sono eLyznardh), mi tocca indossarlo come fosse un costume troppo grande. Non &egrave; una gran sensazione...</p>
	<p>Potrei sopportare molto meglio la cosa, se non si trattasse di un impegno &quot;ufficiale&quot;. Questa parola &ndash; &quot;ufficiale&quot; &ndash; mi sta uccidendo, oggi. &Egrave; pazzesco, &egrave; inammissibile, &egrave; inaccettabile! Sono qui come sostituto di me stesso: &egrave; il Lyznardh che dovrebbe essere qui a ricevere questa ragazza, questa &quot;eletta&quot;, come un sacrificio, come un tributo. &Egrave; stato il Lyznardh a salvare la vita della ragazza quand&apos;era ancora un cucciolo d&apos;uomo, &egrave; stato il Lyznardh a portarla qui, ad affidarla a quest&apos;uomo che ora me la sta venendo a riconsegnare, &egrave; stato il Lyznardh ad inviare una visione a lui ed a parlare con lei, ieri, combinando quel gran casino per cui alla fine io sono qua... Non &egrave; mia la colpa, &egrave; del Lyznardh: dovrebbe esserci lui qui, non io. Se devo esserci io, dovrei almeno avere a disposizione le capacit&agrave; che mi sono guadagnato negli anni. E invece no, sono qui in mutande. Beh, in mutande e un enorme costume da aracnosauro con sei gambe, che &ndash; sinceramente &ndash; non ho mai imparato ad usare.</p>
</div><div class="section">
	<p>E mentre io sono qui che mi dispero per la mia condizione, ecco che la piccola Jo, al braccio del padre, percorre quel sentiero che ha percorso per tutta la sua vita su questo sasso coperto di vita. Ed ora io devo portarla via. Non dovrei avere paura. Ho scelto io Jo. L'ho scelta come mio araldo appena l&apos;ho conosciuta, l&apos;ho portata io qui, perch&eacute; crescesse tra i suoi simili, perch&eacute; si guadagnasse qualcosa da perdere, il giorno in cui sarei tornato a prenderla. Ora invece, dopo aver giocherellato con la sua vita, persino con il suo vecchio pianeta, mi ritrovo qui, da solo, senza poteri, senza difese...</p>
	<p>Eccoli dunque, infine.</p>
	<p>Loro, i due mortali, i cui anni assieme valgono quelli di un abete, il cui fusto sembra immobile eppure cresce migliaia di volte pi&ugrave; rapido del monte che ora in tre calchiamo, questo stesso monte che poggia su una terra ch&apos;&egrave; mille volte pi&ugrave; vecchia; questa stessa terra che ha visto la vita dischiudersi lentamente non &egrave; che un pezzo di sasso che passa i suoi giorni a pascolare attorno ad un globo incandescente milioni di volte pi&ugrave; massiccio, ma anch&apos;esso non &egrave; che un granello di sabbia perso nel mare di stelle, stelle troppo giovani per ricordare i tempi in cui, quand&apos;ero giovane, dal quel cielo strappavo le loro antenate affinch&egrave; Sacomne le portasse al collo.</p>
	<p>Quei due mortali tremano al mio cospetto. Non per quello che sono &ndash; impazzirebbero &ndash; ma per quello che sembro, per l&apos;aspetto terribile di questo corpo che ora abito come ospite. Ma fanno comunque bene a tremare.</p>
	<p>Me ne sto fermo, senza dire nulla. Non sono dell&apos;umore per grandi discorsi, ora. Inoltre, grandi discorsi rovinerebbero questo momento. Jo e suo padre si avvicinano, rallentano, si fermano, non sanno che fare. Con un ampio gesto della mano, invito Jo ad avvicinarsi, tenendo gli occhi fissi sul padre. Lei si stacca da lui, lo fissa, lo abbraccia e lo bacia, poi si allontana di un passo, di due, di tre; l&apos;uomo rimane impassibile.</p>
	<p>Porgo il braccio alla ragazza; lei rimane sorpresa, e pensa a come raggiungere il mio gomito, che fluttua ben oltra la testa di lei. Le mie sopracciglia si inarcano ad esprimere il disappunto che trattengo dalla mie labbra, mentre allargando le ginocchia (tutte) mi abbasso fino a portare il mio braccio all'altezza delle sue spalle. Poich&eacute; non intendo abbassarmi ulteriormente, spero che lei capisca e aspetto; dopo un attimo le mie speranze vengono esaudite ed ella s&apos;attacca con entrambe le braccia. Ora che l&apos;ho al fianco, l&apos;accompagno per un quarto di giro, finch&eacute; mi frappongo tra lei e il padre:</p>
	<div class="outside">
		<?php $d->speak ('lyznardh', 'Mi hai servito bene, Jona'); ?>
		<?php $d->speak ('lyznardh', 'Tutto quello che chiederai, ti verr&agrave; accordato sette volte'); ?>
		<?php $d->speak ('lyznardh', '<span class="em">Quel</span> giorno, se lo vorrai, siederai con me alla mia tavola'); ?>
	</div>
	<p>Detto questo, prendo Jo e scompaio dalla vista; non visto da occhi mortali, mi porto in alto, verso la vetta del monte, dove nessuno pu&ograve; disturbarci.</p>
</div><div class="section">
	<p>Lascio che Jo si stacchi dal braccio, poi mi rialzo per assumere una posizione pi&ugrave; composta:</p>
	<div class="outside">
		<?php $d->speak ('lyznardh', 'Ebbene, Jo, lascia che mi presenti nuovamente, perch&eacute; ancora non mi conosci affatto'); ?>
	</div>
	<p>Detto questo, porto la destra vicino al petto, allargo la sinistra all&apos;indietro, abbasso il capo e riversisco. Attendo dunque un secondo in posizione, poi inarco la schienza, strabuzzo gli occhi, alzo la coda e le braccia, gonfio la gola, volto gli occhi all&apos;indietro, mi piego in avanti portando il muso vicino a terra, spalanco la bocca e con un rigurgito lascio cadere quello che a Jo sembra un sacco trasparente con dentro i resti di un pasto. Inutile dire che la cosa, per quanto a me non dia alcun fastidio, agli occhi di lei appare incredibile e soprattutto disgustosa.</p>
</div><div class="section">	
	<p>Ora che eLyznardh ha esarito il suo compito &ndash; e che quella concessione di effetti speciali accordatami dai due coinquilini &egrave; giunta al termine &ndash; lascio che eLyz e Ci si portino via il corpo mostruoso, ed esso scompare. Rimango soltanto io, a terra, avvolto da una mistura di bava e seta; speso qualche secondo ad abituarmi all&apos;assenza di molte delle appendici fisiche (e mentali) a cui mi sono dovuto abituare, mi rialzo su due gambe, strappo l'involucro in cui sono rinchiuso e respiro l'aria di montagna:</p>
	<div class="outside">
		<?php $d->speak ('simak', 'Piacere, io sono Simak!'); ?>
	</div>
	<p>Allungo la mano destra.</p>

<?php } ?>
