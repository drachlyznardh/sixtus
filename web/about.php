<?php

	if(!$attr['included'])
	{
		$attr['title'] = 'Guida';
		$attr['subtitle'] = 'Perché la gente arriva ma non sa dov&apos;è la roba';
		$attr['keywords'] = '';
		if(!$attr['part']) $attr['part'] = 'intro';
		if(!$attr['current']) $attr['current'] = 'intro';

		$related['prev'] = array('Legend/', 'Legend');
		$related['next'] = array('Extra/Record/', 'Record');

		require_once('sys/fragments/in-before.php');
	}
?>
<!--[Body/Start]-->
<?php if (tab_condition($attr, 'intro')) { ?>
<div class="tab"><a id="INTRO"></a><div class="<?=($attr['sections']?'section':'invisible')?>"><p> Questa è la paginetta che ti spiega le cose. </p>
<h2>Perché la Guida?</h2>
<p> Mi sono reso conto che costruire un sito, programmarne il comportomanto e  aggiungere qualche nuova <code>feature</code> ogni tanto è una  cosa, mentre condividire con gli altri è un&apos;altra. </p>
<p> Ci sono molte cose che semplicemente voi non potete sapere, a meno che io  non ve lo dica. Ecco perché c&apos;è una guida. </p>
<p> C&apos;è stata una  <a href="<?=make_canonical($attr, 'Storie/2010/XX/', false, false)?>">storia</a>, una volta, che tentava di fare la stessa cosa… beh, quella storia non se la  ricorda nessuno, e ad ogni modo ormai è antiquata. </p>
</div><div class="<?=($attr['sections']?'section':'invisible')?>"><p> Ora, qualche parola sulla struttura del sito: potete vedere la prima  colonna, a sinistra. Quella non cambia quasi mai, è passata per  alcune piccole modifiche in passato ma senza mai modificare il suo  scopo. È la barra di navigazione, che contiene una serie di link  alle sezioni del sito. </p>
<p> La seconda colonna, al centro, contiene della yadda, le cose che  dico e le cose che mi capitano. In cima c&apos;è il titolo, in fondo ci  sono dei messaggi stupidi. </p>
<p> La terza colonna, ampiamente cangante, contiene sempre una quantità  di link. Ci sono quelli per navigare avanti o indietro tra le pagine  della stessa serie, quelli per passare da una sezione all&apos;altra, e  altre cose utili. Provate ad usarla, scoprirete il resto della  guida. </p>
</div></div>
<?php } ?>
<?php if (tab_condition($attr, 'gods')) { ?>
<div class="tab"><a id="GODS"></a><div class="<?=($attr['sections']?'section':'invisible')?>"><p> Ed ecco la pagina in cui parlo di me. </p>
<p> Il GODS sono io, sono il leggendario autore di Tru Naluten, sono  l&apos;autoeletto “capo” di “quelli dell&apos;Austud”, sono quello che piglia  e va a compiere imprese podistiche senza alcun preavviso. </p>
<p> Volete una foto? </p>

<p class="foto"><a target="_blank" href="Extra/Rampa/Davanti.jpg"><img src="Extra/Rampa/Davanti.mini.jpg" /></a></p><p> Ma non temete: anche se nella foto ero parecchio stanco, e anche se  non so chi siete, sappiate che vi guarderei male in ogni caso. </p>
</div></div>
<?php } ?>
<?php if (tab_condition($attr, 'compagni')) { ?>
<div class="tab"><a id="COMPAGNI"></a><div class="<?=($attr['sections']?'section':'invisible')?>"><p> Grazie a qualche dio, non sono da solo, nelle mie avventure. </p>
<p> Gli <em>Allegri compagni</em> vengono spesso nominati  nelle storie, ma non mi sono mai preso la briga di spiegare chi  fossero. Ecco un bell&apos;elenco. </p>
</div><div class="<?=($attr['sections']?'section':'invisible')?>">
<h2>Quelli dell'Aula Studio</h2>
<p> Fin da quando ci siamo spostati nel nuovo edificio, la nostra  compagnia è nota per prendere possesso dei tavoli, far gran casino e  dominare sia la vita vera che l&apos;internet. </p>
<ul>
<li>il <span class="bolo">buon Bolo</span> è la persona che conosco da più tempo, entro queste mura; abbiamo cominciato insieme, abbiamo  collaborato per gli esami per lungo tempe etc etc etc… spesso mi rivolgo  a lui direttamente, per evitare che usi i suoi terribili poteri di  <code>Grammar Nazi</code> per spottare errori nelle mia pagine.</li>
<li>il <span class="dacav">giovane Simgi Dacav</span>, vecchio più di tutti noi messi assieme, è un troll potente e meticoloso, ne  ha viste di tutti i colori e possiede incredibili poteri. Non  mangiando brioche e girando spesso con la cremina per le mani, è  noto all&apos;esterno come <em>Mr. Benessere</em>. </li>
<li><span class="mitch">Mitch</span>, il <em>re del gossip</em> conosce tutto e tutti, ha una lunga esperienza  nell&apos;aiutare i nabbi e una grande pazienza. Attualmente, s&apos;è  trovato un vero mestiere. </li>
<li>il <span class="jazz">signor Jazzinghen</span>, ch'è molto importante (tutti lo chiamano “signore”) è un acquisto  relativamete recente (in confronto al Dacav, ovviamente), è  estramamente rumoroso e blah. </li>
<li>il tre volte dottore <span class="war">War(rior)</span> alleggia nei dintorni, perché lui fa cose. Ne sa un sacco. </li>
</ul>
</div><div class="<?=($attr['sections']?'section':'invisible')?>">
<h2>Altri allegri compagni</h2>
<p> Non tutti i miei amici studiano in questa facoltà, non ci spendono  la vita, ma fanno anche altre cose. </p>
<ul>
<li><em>Luber</em>, ad esempio, ha un lavoro vero e una vita vera. Fa cose, recensisce anime terribili e gioca con me ad Exalted. </li>
<li><em>Dave</em> ossia <em>Il Troll</em> invece è una creatura a parte. Narra la leggenda che fosse  qui in facoltà da tempo immemore, ma poi – per motivi ignoti ai mortali  – sparì ritirandosi a vita eremitica. Torna ogni tanto, attraverso  visioni oppure in forma astrale. </li>
<li><em>Arber</em> è l'uomo che conosce tutti; anche più di Mitch. Gira in facoltà da tempo immemore ed ogniqualvolta ci si becca per un caffè, lui  incontra qualcuno e si perde via… </li>
</ul>
</div></div>
<?php } ?>
<?php if (tab_condition($attr, 'contenuti')) { ?>
<div class="tab"><a id="CONTENUTI"></a><div class="<?=($attr['sections']?'section':'invisible')?>"><a id="Storie"></a><p> Le storie sono il vero cuore della baracca. </p>
<h3>Storie</h3>
<p> Si cominciò un po&apos; di tempo fa, mi par che fosse attorno al settembre 2010.  Prima di quello, io e i miei allegri compagni, il <span class="em">popolo  dell&apos;aula studio</span>, tenevamo le storie per tradizione orale, come  facevano gli antichi. </p>
<div class="mini-right-out"><div class="mini-right-in"><a id="MiniStorie"></a>
<h3>Le MiniStorie</h3>
<p> Ci sono state anche delle storie troppo brevi per meritare una pagina  intera. Hanno cominciato a comparire nella pagina delle news nel  settembre 2011. </p>
</div></div><p> Da allora, ho sbrodolato una crescente e sorprendente quantità di  storie. A volte sono semplicemente stupide, a volte invece raccontano  pezzi di vita vissuta, a volte invece sono lo sfogo per le emozioni che  non riesco a tenermi dentro, ma di cui non voglio parlare. </p>
<p> Perché scrivere è più comodo. Ed è anche divertente. Ma non fidatevi  di quello che scrivo, per carità: tutto quello che finisce nelle  storie viene scritto di getto, non viene revisionato da nessuno… in  più, tutti i contenuti sono spesso inaffidabili, contengono falsità  e opinioni assolutamente personali. <a id="recensioni"></a></p>
<h3 class="reverse">Recensioni</h3>
<p> Perché, se all&apos;inizio raccontavo soltanto delle cose, un giorno ho  finito per scrivere una storia immensamente lunga che in pratica  recensiva (nel mio personale e peculiare stile) un certo  <a href="<?=make_canonical($attr, 'Storie/2011/XXXVIII/', '', '')?>">anime</a></p>
<p> Da quel punto in poi ho deciso che forse sarebbe stato il caso di  riservare uno spazio dedicato a cose come quella. E poi ho cominciato. </p>
<p> Ho cominciato a recensire film, quindi. Ce ne sono parecchi. Per la  magggior parte brutti. È per questo che ho creato una categoria apposta:  l&apos;arte dei film brutti è una cosa rara e raffinata. Pochi li sanno fare,  pochi li sanno apprezzare. E spesso non ho briga di scrivere… </p>
 <strong>Ma non solo film!</strong> Mi sono messo a recensire tutto quel che<p> mi passa per le mani: videogiochi, libri, serie tv. In effetti, gli show  sono quel che va per la maggiore, perché ne guardo tanti. </p>
</div><div class="<?=($attr['sections']?'section':'invisible')?>"><a id="TruNaluten"></a>
<div class="mini-right-out"><div class="mini-right-in"><a id="Extra"></a>
<h3 class="reverse">Extra</h3>
 <code>Ricorsione!?!</code> In effetti, c&apos;è una sezione Extra, che<p> contiene le cose che non so dove mettere. Non c&apos;è tanta roba, in  effetti; se ci fosse, avrebbe la sua sezione dedicata, ma non c&apos;è.  Quindi tutto finisce nel mucchio. </p>
<p> Forse (e dico <strong>forse</strong>) comparirà una funzione di  ricerca… </p>
</div></div><p> Le pagine più antiche presenti sul sito, tecnicamente. In realtà, sono il  motivo per cui il sito esiste. Ma con il tempo sono state soppiantate dalle  <code>Storie</code>.</p>
<h3>Tru Naluten</h3>
<p> Questo racconto è l&apos;originale motivo per cui il sito esiste. Si tratta di  una lunga e grossa storia fantasy, per la maggior parte ancora non scritta:  mi porto dietro il progetto da una decina d&apos;anni, ormai… </p>
<p> I capitoli escono con una sporadicità spaventevole, ma non temete, so  esattamente dove andrà la storia. <strong>GIURO</strong> che lo so!!! <a id="NaNoWriMo"></a></p>
<div class="mini-left-out"><div class="mini-left-in"><a id="Legend"></a>
<h3>Legend RPG</h3>
<p> Sezione aggiunta dopo parecchio tempo, verso <code>Marzo 2012</code>,  dedicata ad un certo sistema di <em>Gioco di Ruolo</em> e alla campagna da  me <code>master</code>ata con esso. </p>
<p> Sperando che niente d&apos;importante esploda. E poi c&apos;è anche la campagna di  War. </p>
</div></div>
<br/>
<h3 class="reverse">NaNoWriMo</h3>
<p> Il NaNoWriMo, avvenimento al quale partecipo dal 2010, è una cosa  interessante, ma anche lunga. E quindi si merita la sua sezione dedicata. E  dopo quello, ci sono stati altri anni e altra fuffa… </p>
<p> Tristemente, l&apos;intera cosa è piuttosto inconcludente. </p>
<div style="float:none; clear:both"></div>
</div></div>
<?php } ?>
<?php if (tab_condition($attr, 'meta')) { ?>
<div class="tab"><a id="META"></a><div class="<?=($attr['sections']?'section':'invisible')?>"><a id="Extra"></a><p> Metasezione!!! </p>
<h2>Meta [ Extra ]</h2>
<p> Questa sezione è appunto dedicata a questa sezione. </p>
</div><div class="<?=($attr['sections']?'section':'invisible')?>"><p> All&apos;inizio (in realtà, fino a poco tempo fa, qualcosa come alcune  settimane…) utilizzavo la sezione ‘extra’ soltanto come luogo in cui  mettere tutte le immagini che compaiono sul sito; al tempo, erano tre. </p>
<p> Poi, con il passare del tempo, quelle immagini sono invecchiate, si sono  coperte di polvere e da quella polvere è germinata della muffa, che alla  fine, evolutasi fino allo stato di creatura senziente, è divenuta questa  pagina che state leggendo. </p>
</div><div class="<?=($attr['sections']?'section':'invisible')?>"><a id="modi"></a><p> Ci sono modi e modi. </p>
<h2>Meta [ Modi ]</h2>
<p> O forse dovrei chiamarle “modalità”? </p>
<p> Oh beh, una volta c&apos;era un solo stile CSS. Una volta dopo, ce ne furono  tre: quello blu, quello rosso e quello nero. </p>
<p> Gestire tutta quella roba diventò un gran lavoraccio, e con il tempo  tornai ad avere un singolo stile… quello che dovreste vedere  normalmente. </p>
</div><div class="<?=($attr['sections']?'section':'invisible')?>"><p> Ma la vita è piena di sorprese. Un bel dì mi venne in mente di dividere  le pagine in tab, e scoprii che non tutti i browser supportano l&apos;evento  <span class="em">onHashChange</span>, in particolare non il browser dell&apos;amico Luber. </p>
<p> Questo triste fatto gli rese impossibile accedere ad una buona parte dei  contenuti… decisi allora di aggiungere il <span class="code">Luber  Mode</span>, che spalma tutti i tab uno in fila all&apos;altro. E siccome  anche il <span class="bolo">buon Bolo</span> aveva lo stesso problema,  creai un alias a suo nome. </p>
</div><div class="<?=($attr['sections']?'section':'invisible')?>"><a id="stili"></a>
<h2>Meta [ Stili ]</h2>
<p> Infine, un bel dì mio fratello capitò sul sito e si lamentò di non  riuscire a distinguere una beata mazza di quel che vedeva. Per lui c&apos;è  quindi il <span class="code">Dado mode</span>, dai colori più classici. </p>
</div><div class="<?=($attr['sections']?'section':'invisible')?>"><p> Potete passare dalla modalità standard (la mia) alle altre calcando  qualche link in alto a sinistra. Se invece sapete scrivere, potete  infilare le parole chiave direttamente nell&apos;URL. </p>
</div></div>
<?php } ?>
<!--[Body/Stop]-->
<?php 
	if(!$attr['included'])
	{
		require_once('sys/fragments/in-middle.php');
	}
?>
<!--[Side/Start]-->
<?php if (side_condition($attr)) { ?>
<div class="tab"><div class="<?=($attr['sections']?'section':'invisible')?>">
<p> <?=make_tid($attr, 'Perché una guida?', 'intro', false)?></p>
<p> <?=make_tid($attr, 'L&apos;Autore', 'gods', false)?> e i suoi  <?=make_tid($attr, 'Allegri compagni', 'compagni', false)?></p>
<h2>Guida</h2>

<h3> <?=make_tid($attr, 'Contenuti', 'contenuti', false)?></h3>

<p class="reverse"> <?=make_tid($attr, 'Storie', 'contenuti', 'Storie')?> e  <?=make_tid($attr, 'MiniStorie', 'contenuti', 'MiniStorie')?> /  <?=make_tid($attr, 'Recensioni', 'contenuti', 'Recensioni')?> /  <?=make_tid($attr, 'Tru Naluten', 'contenuti', 'TruNaluten')?> /  <?=make_tid($attr, 'NaNoWriMo', 'contenuti', 'NaNoWriMo')?> /  <?=make_tid($attr, 'Legend', 'contenuti', 'Legend')?> RPG /  <?=make_tid($attr, 'Extra', 'contenuti', 'Extra')?></p>
<h3> <?=make_tid($attr, 'Meta', 'meta', false)?></h3>

<p class="reverse"> <?=make_tid($attr, 'Extra', 'meta', 'Extra')?> /  <?=make_tid($attr, 'Modi', 'meta', 'Modi')?> /  <?=make_tid($attr, 'Stili', 'meta', 'Stili')?> /  <?=make_tid($attr, 'Voci', 'meta', 'Voci')?></p>
</div><br /><div class="<?=($attr['sections']?'section':'invisible')?>">
<h2>Gli (altri) Extra</h2>

<p> La pagina dei <a href="<?=make_canonical($attr, 'Extra/Record/', false, false)?>">Record</a> / I prodigi della <a href="<?=make_canonical($attr, 'Extra/Scimmia/', false, false)?>">scimmia celeste</a> / Appunti di <a href="<?=make_canonical($attr, 'Extra/SO1/', false, false)?>">Sistemi Operativi 1</a> / L'elenco delle <a href="<?=make_canonical($attr, 'Extra/Immagini/', false, false)?>">Immagini</a> / il <a href="<?=make_canonical($attr, 'Extra/Diario/', false, false)?>">diario</a> del capitano / <a href="<?=make_canonical($attr, 'Extra/MLCAD/', false, false)?>">MLCad &amp; LPub</a> / <a href="<?=make_canonical($attr, 'Extra/BUX/', false, false)?>">Bu&chi;</a> / <a href="<?=make_canonical($attr, 'Extra/LABOFDOOM/', false, false)?>">Lab Of Doom</a> / <a href="<?=make_canonical($attr, 'Extra/Fitness/', false, false)?>">Fitness</a> / <a href="<?=make_canonical($attr, 'Extra/Back2LOD/', false, false)?>">Back 2 the LOD</a></p>
</div></div>
<?php } ?>
<!--[Side/Stop]-->
<?php 
	if(!$attr['included'])
	{
		require_once('sys/fragments/in-after.php');
	}
?>
