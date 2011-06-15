<?php if (!isset($multinav)) { ?>
	<div class="section">
		<h2 id="arrowstr-rside" class="opened" onclick="javascript:cascade('str-rside')">
			Tutte le storie
		</h2><div id="longstr-rside">
			<p><?=$d->link('Storie/', 'Indice')?></p>
			<p><?=$d->link('Storie/2010/', 'Serie &apos;10')?></p>
		</div>
	</div>
<?php } ?>
<div class="section">
	<h2 id="arrowstr2011-rside" class="opened"
			onclick="javascript:cascade('str2011-rside');">
		Storie 2011
	</h2><div id="longstr2011-rside">
		<ol start="18" style="list-style-type: upper-roman;">
			<li><?=$d->link('Storie/2011/XVIII/', 'Liber Javae')?></li>
			<li><?=$d->link('Storie/2011/XIX/', 'Permessi')?></li>
			<li><?=$d->link('Storie/2011/XX/', 'Guida')?></li>
			<li><?=$d->link('Storie/2011/XXI/', 'Programmazione 40.000')?></li>
			<li><?=$d->link('Storie/2011/XXII/', 'Tecniche avanzate')?></li>
			<li><?=$d->link('Storie/2011/XXIII/', 'Cose complicate')?></li>
			<li><?=$d->link('Storie/2011/XXIV/', 'Il futuro')?></li>
			<li><?=$d->link('Storie/2011/XXV/', 'No')?></li>
			<li><?=$d->link('Storie/2011/XXVI/', 'La sconfitta')?></li>
			<li><?=$d->link('Storie/2011/XXVII/', 'LaTeX')?></li>
		</ol>
	</div><h2 class="reverse">
		Il Magnetismo
	</h2><div class="inside"><ol start="28">
		<li><?=$d->link('Storie/2011/XXVIII/', 'L&apos;odio')?></li>
		<li><?=$d->link('Storie/2011/XXIX/', 'Il Magnete')?></li>
		<li><?=$d->link('Storie/2011/XXX/', 'L&apos;interpretazione')?></li>
	</ol></div><ol start="31" style="padding-left: 5em">
		<li><?=$d->link('Storie/2011/XXXI/','Deus Ex Machina')?></li>
		<li><?=$d->link('Storie/2011/XXXII/','Dottor Odio')?></li>
		<li><?=$d->link('Storie/2011/XXXIII/','L&apos;inaspettata')?></li>
		<li><?=$d->link('Storie/2011/XXXIV/','Considerazioni')?></li>
		<li><?=$d->link('Storie/2011/XXXV/','Accuse')?></li>
		<li><?=$d->link('Storie/2011/XXXVI/','Quel tizio')?></li>
		<li><?=$d->link('Storie/2011/XXXVII/','PHP')?></li>
		<li><?=$d->link('Storie/2011/XXXVIII/','Raccontare')?></li>
		<li><?=$d->link('Storie/2011/XXXIX/','Forever Alone')?></li>
		<li><?=$d->link('Storie/2011/XL/','Domanda&amp;Offerta')?></li>
		<li><?=$d->link('Storie/2011/XLI/','Raccontare II')?></li>
		<li><?=$d->link('Storie/2011/XLII/','La vecchiaia')?></li>
		<li><?=$d->link('Storie/2011/XLIII/','Gli anni')?></li>
		<li><?=$d->link('Storie/2011/XLIV/','Pillole')?></li>
		<li><?=$d->link('Storie/2011/XLV/','Wireless')?></li>
		<li><?=$d->link('Storie/2011/XLVI/','L&apos;uomo con due ombrelli')?></li>
		<li><?=$d->link('Storie/2011/XLVII/','Impresa (II)')?></li>
	</ol>
</div>
<?php if (!isset($multinav)) { ?>
	<div class="section">
		<h2>Attenzione!!!</h2>
		<p>
			La maggior parte di queste storie è triste, triste un sacco, triste a botta!
		</p><p>
			La lettura può indurre, nelle persone particolarmente sensibili,
			casi di suicidio anche reiterati.
		</p>
	</div>
<?php } ?>
