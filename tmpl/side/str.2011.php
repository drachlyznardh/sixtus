<?php 
	$check = isset($multinav);
	if (!$check) {
?>
	<div class="section">
		<h2 id="arrowstr-rside" class="opened" onclick="javascript:cascade('str-rside')">
			Tutte le storie
		</h2><div id="longstr-rside">
			<p><?=$d->link('Storie/2010/', 'Serie &apos;10')?></p>
			<p><?=$d->link('Storie/2011/', 'Serie &apos;11')?></p>
		</div>
	</div>
<?php } ?>
<div class="section">
	<h2 id="arrowstr2011-rside" class="<?=$check?'opened':'closed'?>"
			onclick="javascript:cascade('str2011-rside');">
		Storie 2011
	</h2><div id="longstr2011-rside" style="display:<?=$check?'block':'none'?>">
		<ol start="18" style="list-style-type: upper-roman;">
				<li class="cat-cosefighe"><?=$d->link('Storie/2011/XVIII/', 'Liber Javae')?></li>
			<li><?=$d->link('Storie/2011/XIX/', 'Permessi')?></li>
			<li><?=$d->link('Storie/2011/XX/', 'Guida')?></li>
			<li><?=$d->link('Storie/2011/XXI/', 'Programmazione 40.000')?></li>
			<li class="cat-cosefighe"><?=$d->link('Storie/2011/XXII/', 'Tecniche avanzate')?></li>
			<li><?=$d->link('Storie/2011/XXIII/', 'Cose complicate')?></li>
			<li><?=$d->link('Storie/2011/XXIV/', 'Il futuro')?></li>
			<li><?=$d->link('Storie/2011/XXV/', 'No')?></li>
			<li><?=$d->link('Storie/2011/XXVI/', 'La sconfitta')?></li>
			<li class="cat-cosefighe"><?=$d->link('Storie/2011/XXVII/', 'LaTeX')?></li>
		</ol><h2 class="reverse">
			Il Magnetismo
		</h2><div class="inside"><ol start="28">
			<li><?=$d->link('Storie/2011/XXVIII/', 'L&apos;odio')?></li>
			<li><?=$d->link('Storie/2011/XXIX/', 'Il Magnete')?></li>
			<li><?=$d->link('Storie/2011/XXX/', 'L&apos;interpretazione')?></li>
		</ol></div>
	</div>
</div><div class="section">
	<h2 id="arrowstr2011-rside-I" class="<?=$check?'opened':'closed'?>"
			onclick="javascript:cascade('str2011-rside-I')">
		Primavera 2011
	</h2><div id="longstr2011-rside-I" style="display:<?=$check?'block':'none'?>">
		<ol start="31" style="padding-left: 5em">
			<li><?=$d->link('Storie/2011/XXXI/','Deus Ex Machina')?></li>
			<li><?=$d->link('Storie/2011/XXXII/','Dottor Odio')?></li>
			<li><?=$d->link('Storie/2011/XXXIII/','L&apos;inaspettata')?></li>
			<li><?=$d->link('Storie/2011/XXXIV/','Considerazioni')?></li>
			<li><?=$d->link('Storie/2011/XXXV/','Accuse')?></li>
			<li><?=$d->link('Storie/2011/XXXVI/','Quel tizio')?></li>
			<li class="cat-cosefighe"><?=$d->link('Storie/2011/XXXVII/','PHP')?></li>
			<li><?=$d->link('Storie/2011/XXXVIII/','Raccontare')?></li>
			<li><?=$d->link('Storie/2011/XXXIX/','Forever Alone')?></li>
			<li><?=$d->link('Storie/2011/XL/','Domanda&amp;Offerta')?></li>
			<li><?=$d->link('Storie/2011/XLI/','Raccontare II')?></li>
			<li><?=$d->link('Storie/2011/XLII/','La vecchiaia')?></li>
			<li><?=$d->link('Storie/2011/XLIII/','Gli anni')?></li>
			<li><?=$d->link('Storie/2011/XLIV/','Pillole')?></li>
			<li class="cat-cosefighe"><?=$d->link('Storie/2011/XLV/','Wireless')?></li>
			<li><?=$d->link('Storie/2011/XLVI/','L&apos;uomo con due ombrelli')?></li>
			<li><?=$d->link('Storie/2011/XLVII/','Impresa (II)')?></li>
	</ol></div>
</div><div class="section">
	<h2 id="arrowstr2011-rside-II"
			class="closed"
			onclick="javascript:cascade('str2011-rside-II')">
		Estate 2011
	</h2><div id="longstr2011-rside-II"
			style="display: none">
		<ol start="48" style="padding-left: 5em">
			<li class="cat-heart"><?=$d->link('Storie/2011/XLVIII/','Non ce n&apos;è abbastanza')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2011/XLIX/','Quel che non è abbastanza')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2011/L/','Quel che dovrei fare')?></li>
			<li><?=$d->link('Storie/2011/LI/', 'Il Druido')?></li>
			<li class="cat-cosefighe"><?=$d->link('Storie/2011/LII/', 'Sgaggio Tiem')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2011/LIII/', 'Quel che ho fatto')?></li>
			<li><?=$d->link('Storie/2011/LIV/','Niente')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2011/LV/','Spezzato')?></li>
			<li><?=$d->link('Storie/2011/LVI/','Correre di notte')?></li>
			<li><?=$d->link('Storie/2011/LVII/','Il potere')?></li>
			<li><?=$d->link('Storie/2011/LVIII/','Deus Ex Machina Evolved')?></li>
			<li><?=$d->link('Storie/2011/LIX/','Violenza e soddisfazione')?></li>
			<li><?=$d->link('Storie/2011/LX/','Filler')?></li>
			<li><?=$d->link('Storie/2011/LXI/','Cattivo')?></li>
			<li class="cat-heart"><?=$d->link('Storie/2011/LXII/','Normale')?></li>
	</ol></div>
</div><div class="section">
	<h2 id="arrowstr2011-rside-III"
			class="opened"
			onclick="javascript:cascade('str2011-rside-III')">
		Autunno 2011
	</h2><div id="longstr2011-rside-III"
			style="display: block">
		<ol start="63" style="padding-left: 5em">
			<li><?=$d->link('Storie/2011/LXIII/','Gli scagnozzi del Dr.Odio')?></li>
			<li><?=$d->link('Storie/2011/LXIV/','La metafora','INTRO')?></li>
	 		<li><?=$d->link('Storie/2011/LXV/','Il 13 ottobre','INTRO')?></li>
		</ol><ol start="67" style="padding-left:5em">
			<li><?=$d->link('Storie/2011/LXVII/',
				'Ancora ce la posso fare', 'INTRO')?></li>
	</ol></div>
</div>
<?php if (!$check) require_once('tmpl/side/.disclaimer.php'); ?>
