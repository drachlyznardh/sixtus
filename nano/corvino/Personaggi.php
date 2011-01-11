<?php

	$m->mkpage('Personaggi', 'Chi sono e cosa fanno');

	function mkpage ($d, $m) {
?>
<div class="small">
	<div class="section">
		<p>
			Anche il mio neotitolato NaNoWriMo 2010, che ora ha nome
			&ldquo;Corvino Multicolore&rdquo;, si merita una sezione
			personaggi.
		</p><p>
			Perciò, eccoveli. Ancora una volta, segnalo i possibili
			spoiler contenuti in questa pagina, ma se siete qui
			probabilmente non ve ne frega.
		</p>
	</div>
</div><div class="wider">
	<div class="widecontent">
		<div class="section"><a id="Corvino"></a>
			<h2>
				Corvino
			</h2><p>
				Il debole, lamentoso, inutile e pigro
				protagonista comincia come studentello annoiato.
			</p><p>
				La sua situazione però si evolve: non appena la
				sua mente smette di preoccuparsi delle sue
				inutili magagne, il ragazzo scopre mirabolanti
				poteri basati sulla gamma dei colori
				dell'arcobaleno.
			</p>
		</div><div class="section"><a id="Camelia"></a>
			<h2>
				Camelia
			</h2><p>
				Questa ragazza è la prima fiamma di Corvino, e
				sembra misteriosamente interessata a lui.
			</p><p>
				Ovviamente, la cosa è ben più seria: questa
				ragazza è in realtà una strega vecchia di
				parecchi secoli, se ne va in giro rubando la
				giovinezza alla gente e lo stesso vuol fare con
				Corvino.
			</p>
		</div>
	</div><div class="widelist">
		<div class="section">
			<h2>
				Uman(oid)i
			</h2><p>
				<?=$m->legend('Corvino')?>
			</p><p>
				<?=$m->legend('Camelia')?>
			</p>
		</div>
	</div>
</div><div class="revwider">
	<div class="widecontent">
		<div class="section"><a id="Battesimo"></a>
			<h2>
				Battesimo
			</h2><p>
				Il lupo che per primo attenta alla vita di
				Corvino. Si rivela essere poco più che un docile
				cagnone selvativo.
			</p>
		</div><div class="section"><a id="Smeraldino"></a>
			<h2>
				Smeraldino
			</h2><p>
				Il corvo che tenta di completare l'opera del
				lupo. Interviene solo a sproposito.
			</p>
		</div><div class="section"><a id="Fisthanlarunai"></a>
			<h2>
				Fisthanlarunai
			</h2><p>
				Anche se non compare fino alla fine della prima
				draft, questo drago lungo come due autobus vive
				sul fondo di un lago in Argentina.
			</p><p>
				Dopo aver servito la più potente guerriera
				strega ancora in vita, affronta Corvino in un
				terribile scontro.
			</p>
		</div>
	</div><div class="widelist">
		<div class="section">
			<h2>
				Animali
			</h2><p>
				<?=$m->legend('Battesimo')?>
			</p><p>
				<?=$m->legend('Smeraldino')?>
			</p><p>
				<?=$m->legend('Fisthanlarunai')?>
			</p>
		</div>
	</div>
</div><div id="longstreghe" class="wider">
	<div class="widecontent">
		<div class="section">
			<h2>
				Streghe	
			</h2><a id="Strega"></a><a id="Streghe"></a><p>
				Le streghe sono terribili creature &ndash; dotate di
				spaventosi poteri magici &ndash; che vivono sia
				<?=$m->legend('di qua')?> che <?=$m->legend('di
				là')?>.
			</p>
		</div><div class="section">
			<h2>
				Multicolore
			</h2><a id="Multicolore"></a><p>
				Uno degli appellativi di
				<?=$m->legend('Corvino')?>, dicesi di colui che
				può assumere più d'un colore contemporaneamente.
			</p>
		</div><div class="section">
			<h2>
				Trasparente
			</h2><a id="Trasparente"></a><p>
				Altro appellativo per
				<?=$m->legend('Corvino')?>, dicesi di colui che
				può evitare di assumere un colore. &Egrave;
				grazie a questo potere che il ragazzo riesce a
				passare <?=$m->legend('di là')?> senza lasciare
				traccia.
			</p>
		</div>
	</div>
</div>
<?php } ?>
