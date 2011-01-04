<?php 

	$page['title'] = 'Tru Naluten';
	$page['subtitle'] = 'Per saper dov&apos;andare';
	unset ($page['side']);

	$flag['fixed-nav'] = false;

	function mkpage ($d, $s, $context) {
?>
	<p>Questa &egrave; la pagina giusta per chi vuole informazioni su Tru Naluten.</p>
	<h2>Tru Naluten</h2>
	<p>
		Tru Naluten è una pubblicazione con periodo del tutto imprevedibile, che vaga
		nella mia mente da tempo immemore e subisce incredibili variazioni di registro,
		di personaggi, luoghi, atmosfera, genere... spesso fa anche ridere.
	</p>

		<!-- Switch Out -->
		</div> <!-- Section -->
	</div> <!-- Clear Box -->
</div> <!-- Content -->
<div class="nav">
	<div class="clearbox">
		<div class="section">
		<! -- Switch In -->

	<h2>Tru Naluten</h2>
	<p><?=$s->ilink ('Tru/Naluten/', 'Indice'); ?></p>
	<p><?=$s->ilink ('Tru/Naluten/Personaggi/', 'Personaggi'); ?></p>
	
		<!-- Switch Out -->
		</div> <!-- Section -->
	</div> <!-- Clear Box -->
</div> <!-- Nav -->

<div class="wide"><div class="darkbox"></div></div>

<div class="content">	
	<div class="clearbox">
		<div class="section">
		<!-- Switch In -->

	<h2>Primo Volume</h2>
	<p>
		In Tru Naluten succedono cose. Cose a caso, fondamentalmente. Nel primo volume
		vediamo sostanzialmente nient&apos;altro che il protagonista, Simak, farsi un
		fiume di seghe mentali, assieme a suoi compagni d&apos;avventura, Ci e il Lyz.
	</p><p>
		Le cose procedono a vanvera fino al giungere inaspettato di questi tre in un
		villaggio vicino, dove si manifesta l'invasione del mondo da parte di terribili
		mostri blu. Alla fine, esplode il mondo.
	</p>

		<!-- Switch Out -->
		</div> <!-- Section -->
		
	</div> <!-- Clear Box -->
</div><div class="nav">
	<div class="clearbox">

		<div class="section">
		<!-- Switch In  -->

<h2>Volume I</h2>
<ol style="list-style-type: upper-roman">
	<li><?=$s->ilink ('Tru/Naluten/I/', 'Camminavo'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/II/', 'Sacomne'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/III/', 'Il mio nome'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/IV/', 'Le altre voci'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/V/', 'La mia faccia'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/VI/', 'L&apos;altro me'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/VII/', 'La meta'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/VIII/', 'La Porta'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/IX/', 'La fine del mondo'); ?></li>
</ol>

		<!-- Switch Out -->
		</div> <!-- Section -->
	</div> <!-- Clear Box -->
</div> <!-- Nav -->

<div class="wide"><div class="darkbox"></div></div>

<div class="content">	
	<div class="clearbox">
		<div class="section">
		<!-- Switch In -->

<h2>
	Secondo Volume
</h2><p>
	Simak recluta Jo come suo araldo, e la manda a fare la profetessa presso alcuni
	ribelli che si battono per la libertà contro certi alcuni oppressori giunti
	dall&apos;altro lato dell&apos;oceano...
</p>

		<!-- Switch Out -->
		</div> <!-- Section -->
		
	</div> <!-- Clear Box -->
</div><div class="nav">
	<div class="clearbox">

		<div class="section">
		<!-- Switch In  -->

<h2>Volume II</h2>
<ol start="10" style="list-style-type: upper-roman">
	<li><?=$s->ilink ('Tru/Naluten/X/', 'La trovatella'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/XI/', 'Abbandono &amp; recupero'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/XII/', 'Conversazione'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/XIII/', 'Dubbio'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/XIV/', 'Proposta'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/XV/', 'La fuga'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/XVI/', 'La sua gente'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/XVII/', 'Battaglia navale'); ?></li>
	<li><?=$s->ilink ('Tru/Naluten/XVIII/', 'Duello'); ?></li>
	<li><?=$s->ilink('Tru/Naluten/XIX/','La
	Lezione')?></li>
</ol>
							
<?php } ?>
