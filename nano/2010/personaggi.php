<?php
	$title=array('Personaggi', 'Chi sono e cosa fanno');
	function mkpage ($d) {
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<p id="li-intro">
				<?=$d->link($d->self, 'Introduzione', 'INTRO')?>
			</p><h2 class="reverse">
				Personaggi
			</h2><p id="li-umanoidi">
				<?=$d->link($d->self, 'Uman(oid)i', 'UMANOIDI')?>
			</p><p id="li-bestie">
				<?=$d->link($d->self, 'Bestie', 'BESTIE')?>
			</p><p id="li-glossario">
				<?=$d->link($d->self, 'Glossario', 'GLOSSARIO')?>
			</p>
		</div>
	</div><div class="widecontent">
		<div class="tab" id="tab-intro">
			<div class="section">
	<p>
		Anche il mio neotitolato NaNoWriMo 2010, che ora ha nome “Corvino
		Multicolore” si merita una sezione personaggi.
	</p><p>
		Perciò, eccoveli. Ancora una volta, segnalo i possibili
		spoiler contenuti in questa pagina, ma se siete qui
		probabilmente non ve ne frega.
	</p>
			</div>
		</div><div class="tab" id="tab-umanoidi">
			<div class="section"><a id="Corvino"></a>
	<h2>
		Corvino
	</h2><p>
		Il debole, lamentoso, inutile e pigro protagonista comincia come
		studentello annoiato.
	</p><p>
		La sua situazione però si evolve: non appena la sua mente smette di
		preoccuparsi delle sue inutili magagne, il ragazzo scopre mirabolanti
		poteri basati sulla gamma dei colori dell'arcobaleno.
	</p>
</div><div class="section">
	<h2>
		Camelia
	</h2><p>
		Questa ragazza è la prima fiamma di Corvino, e sembra misteriosamente
		interessata a lui.
	</p><p>
		Ovviamente, la cosa è ben più seria: questa ragazza è in realtà una
		strega vecchia di parecchi secoli, se ne va in giro rubando la
		giovinezza alla gente e lo stesso vuol fare con Corvino.
	</p>
			</div>
		</div><div class="tab" id="tab-bestie">
			<div class="section"><a id="Battesimo"></a>
	<h2>
		Battesimo
	</h2><p>
		Il lupo che per primo attenta alla vita di Corvino. Si rivela essere
		poco più che un docile cagnone selvativo.
	</p>
</div><div class="section"><a id="Smeraldino"></a>
	<h2>
		Smeraldino
	</h2><p>
		Il corvo che tenta di completare l'opera del lupo. Interviene solo a
		sproposito.
	</p>
</div><div class="section"><a id="Fisthanlarunai"></a>
	<h2>
		Fisthanlarunai
	</h2><p>
		Anche se non compare fino alla fine della prima draft, questo drago
		lungo come due autobus vive sul fondo di un lago in Argentina.
	</p><p>
		Dopo aver servito la più potente guerriera strega ancora in vita,
		affronta Corvino in un terribile scontro.
	</p>
			</div>
		</div><div class="tab" id="tab-glossario">
			<div class="section">
	<h2 id="STREGHE">
		Streghe	
	</h2><a id="Strega"></a><a id="Streghe"></a><p>
		Le streghe sono terribili creature – dotate di spaventosi poteri magici
		–  che vivono sia <?=$d->link($d->self, 'di qua', 'GLOSSARIO')?> che
		<?=$d->link($d->self, 'di là', 'GLOSSARIO')?>.
	</p>
</div><div class="section">
	<h2>
		Multicolore
	</h2><a id="Multicolore"></a><p>
		Uno degli appellativi di <?=$d->link($d->self, 'Corvino', 'UMANOIDI')?>,
		dicesi di colui che può assumere più d'un colore contemporaneamente.
	</p>
</div><div class="section">
	<h2>
		Trasparente
	</h2><a id="Trasparente"></a><p>
		Altro appellativo per <?=$d->link($d->self, 'Corvino', 'UMANOIDI')?>,
		dicesi di colui che può evitare di assumere un colore. È grazie a questo
		potere che il ragazzo riesce a passare <?=$d->link($d->self, 'di qua',
		'GLOSSARIO')?> senza lasciare traccia.
	</p>
</div><div class="section">
	<h2>
		Di qua / Di là
	</h2><p>
		Esiste una barriera che divide il mondo dove abitano le creature
		naturali e il mondo dove abitano le creature magiche. Alcune creature
		sono in grado di attraversare questa barriere.
	</p><p>
		Quale lato sia il qua e quale il là dipende da chi parla.
	</p>
			</div>
		</div>
	</div>
</div>
<?php } ?>
