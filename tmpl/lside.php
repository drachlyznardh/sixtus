<div class="section">
	<p>
		<?=$d->link('News/', 'Ultime novità')?>
	</p><h2 class="reverse">
		Meta
	</h2><p>
		<?=$d->link('Extra/Autore/', 'Il GODS')?>
		| <?=$d->link('Extra/Guida/', 'Chi? Cosa? Dove?', 0)?>
	</p><h2>
		Modi
	</h2><p>
		<?php
			if ($amode == 'gods') echo ('<span class="em">Gods</span>');
			else echo('<a href="'.$d->self.'">Gods</a>');
			echo (' | ');
			if ($amode == 'bolo') echo ('<span class="em">Bolo</span>');
			else echo('<a href="'.$d->self.'Bolo/">Bolo</a>');
			echo (' / ');
			if ($amode == 'luber') echo ('<span class="em">Luber</span>');
			else echo('<a href="'.$d->self.'Luber/">Luber</a>');
			echo (' | ');
			echo ($d->link('Extra/Guida', '?', 'TAB'));
		?></p><p><?php
			if (isset($opt['dado'])) {
				echo ('<a href="'.$d->self.'">Raw</a>');
				echo (' | ');
				echo ('<span class="em">Dado</span>');
			} else {
				echo ('<span class="em">Raw</span>');
				echo (' | ');
				echo ('<a href="'.$d->self.'Dado/">Dado</a>');
			}
			echo (' | ');
			echo ($d->link('Extra/Guida/', '?', 'STILE'));
		?>
	</p>
</div><br /><div class="section">
	<h2>
		Cose interessanti
	</h2><p>
		<?=$d->link('Storie/', 'Storie')?>
		[ <?=$d->link('Storie/2010/', '2010')?>
		| <?=$d->link('Storie/2011/', '2011')?> ]
	</p><p>
		<?=$d->link('Storie/Gaem/', 'La storia interattiva')?>
	</p><p>
		<?=$d->link('Tru/Naluten/', 'Tru Naluten')?>
		[ <?=$d->link('Tru/Naluten/Vol.I/I/', 'vol.I')?>
		| <?=$d->link('Tru/Naluten/Vol.II/X/', 'vol.II')?>
		| <?=$d->link('Tru/Naluten/Vol.III/XX/','vol.III')?> ]
	</p><p>
		<?=$d->link('Recensioni/', 'Recensioni')?>
		[ <?=$d->link('Recensioni/Classifica/', 'Classifica') ?> ]
	</p><p>
		<?=$d->link('NaNoWriMo/', 'NaNoWriMo')?>
		[ <?=$d->link('NaNoWriMo/2010/', '2010')?>
		| <?=$d->link('NaNoWriMo/2011/', '2011')?> ]
	</p>
</div><br /><div class="section">
	<h2> 
		<span class="em" title="Un po&apos;culattoni? No, no, solo allegri.">Allegri</span> compagni
	</h2><div id="longallegri-lside">
		<p>
			Le <a href="http://kiyuko.org/blog/">idee</a> del Bolo
		</p><p>
			Le <a href="http://simgidacav.wordpress.com/">seghe</a> del Dacav
		</p><p>
			Le <a href="http://mikezasch.wordpress.com/">lamentele</a> di Mitch
		</p><p>
			Le <span class="wrong">tristi</span>
			<a href="http://jazzinghen.wordpress.com/">videogiocate</a> di Jazzinghen
		</p><p>
			Le <a href="http://mecharete.blogspot.com/">cose fighe</a> di Luber
		</p>
	</div>
</div>
