<?php

	$page['title'] = 'Storie';
	$page['subtitle'] = 'Cose stupide, divertenti ma tristi, spesso vere';

	function mkpage ($d, $s, $context) {
?>
	<p>
		Questa &egrave; la sezione pi&ugrave; idiota del sito.
	</p><p>
		Qui compaiono scritti che sono parti spontanei della mia mente,
		fondamentalmente sproloqui nei quali mi lamento di quello che mi
		succede... A volte fanno ridere.
	</p>
</div><div class="section">
	<h2>
		Disclaimer
	</h2><p>
		Tutte le storie qu&igrave; riportate saranno anche delle
		cazzatine, ma sono tutte rigorosamente ispirate ad eventi reali.
		Se vi sentite chiamati in causa e v'offendete, cazzi vostri.
	</p><p>
		Se siete dei bambini innocenti, leggete e divertitevi ma vedete
		di non imitarmi che magari vi fate del male.
	</p><p>
		Sappiate inoltre che la maggior parte di questi racconti viene
		scritta di getto, senza mai guardare indietro. Se siete il Bolo
		o se trovate qualche erroraccio, contattatemi indicando almeno
		qualche indizio.
	</p>
</div>
<div class="wider">
	<div class="floatleft">
		<div class="section">

	<a id="2010"></a>
	<p>
		Ecco dunque lo sperimento.
	</p><p>
		Nell'ormai lontano 2010 cominciai a
		bbuttare giù delle storie stupide e divertenti, perché piuttosto
		che lasciarle scomparire nel nulla avrei preferito consegnarle
		all'ignobile interweb.
	</p><p>
		E lo feci.
	</p>
</div><div class="section">
	<p>
		E come posso affermare, ora che tutto è finito, sappiate che
		dalla nona storia si narra quella ch'è nota come &ldquo;La Saga
		della $rossa&rdquo;, triste brandello di storia vera che fece
		deprimere intere generazioni di prima allegri compagni.
	</p><p>
		Molte persone, credo, si persero d'animo nel leggere di questa
		saga, che comunque diede alcuni buoni risultati.
	</p>

		</div>
	</div><div class="floatright">
		<div class="section">

	<?=mkcascade('str2010','Storie 2010', false)?>
	<div id="longstr2010">
		<ol style="list-style-type: upper-roman">
			<li><?=$s->ilink('Storie/I/', 'Apologia')?></li>
			<li><?=$s->ilink('Storie/II/', 'Correre')?></li>
			<li><?=$s->ilink('Storie/III/', 'Progetti')?></li>
			<li><?=$s->ilink('Storie/IV/', 'Impresa')?></li>
			<li><?=$s->ilink('Storie/V/', 'Condizioni')?></li>
			<li><?=$s->ilink('Storie/VI/', 'Un posto in cui stare')?></li>
			<li><?=$s->ilink('Storie/VII/', 'Gundam')?></li>
			<li><?=$s->ilink('Storie/VIII/', 'Sassi')?></li>
		</ol>
		<div class="inside">
			<h2>La Saga di $rossa</h2>
			<ol start="9" style="list-style-type: upper-roman">

			<li><?=$s->ilink('Storie/IX/', 'Attenzione')?></li>
			<li><?=$s->ilink('Storie/X/', 'Due Storie')?></li>
			<li><?=$s->ilink('Storie/XI/', 'Tre Storie')?></li>
			<li><?=$s->ilink('Storie/XII/', 'La musa')?></li>
			<li><?=$s->ilink('Storie/XIII/', 'Il modello definitivo')?></li>
			<li><?=$s->ilink('Storie/XIV/', 'L&apos;incontro')?></li>
			<li><?=$s->ilink('Storie/XV/', 'La spinta')?></li>
			<li><?=$s->ilink('Storie/XVI/', 'Il lunedì della verità')?></li>

			</ol>
		</div>
		<ol start="17" style="list-style-type:upper-roman">
			<li><?=$s->ilink('Storie/XVII/', 'Il finale')?></li>
		</ol>
	</div>

		</div>
	</div>
</div>
<div class="section">
	<p>
		E poi venne il 2011. Non c'è ancora molto.
	</p>
</div>
<div class="wider">
	<div class="floatleft">
		<div class="section">

<a id="2011"></a>
<p>
	Scriverò quando ci sarà qualcosa da scrivere.
</p>

		</div>
	</div><div class="floatright">
		<div class="section">

	<?=mkcascade('str2011', 'Storie 2011', false)?>
	<div id="longstr2011">
		<ol start="18" style="list-style-type: upper-roman">
			<li><?=$s->ilink('Storie/XVIII/', 'Liber Javae')?></li>
		</ol>
	</div>

		</div>
	</div>

<?php } ?>
