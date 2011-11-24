<div class="section">
	<h3>
		<?=$d->link('News/','Ultime Novità')?>
	</h3><p class="reverse">
		<?=$d->link('News/Archivio/', 'Archivio')?>
		[ <?=$d->link('News/2011/', '2011')?> ]
		/ <?=$d->link('Extra/Guida/', 'FAQ')?>
	</p>
</div><br /><div class="section">
	<h2 class="reverse">
		Cose interessanti
	</h2><h3>
		<?=$d->link('Storie/', 'Storie')?>
	</h3><p class="reverse">
		<?=$d->link('Storie/2010/', '2010')?>
		/ <?=$d->link('Storie/2011/', '2011')?>
		/ <?=$d->link('Storie/Gaem/', 'La storia interattiva')?>
	</p><h3>
		<?=$d->link('Tru/Naluten/', 'Tru Naluten')?>
	</h3><p class="reverse">
		<?=$d->link('Tru/Naluten/Personaggi/', 'Personaggi')?>
		/ <?=$d->link('Tru/Naluten/Vol.I/', 'Vol.I')?>
		/ <?=$d->link('Tru/Naluten/Vol.II/', 'Vol.II')?>
		/ <?=$d->link('Tru/Naluten/Vol.III/','Vol.III')?>
	</p><h3>
		<?=$d->link('Recensioni/', 'Recensioni')?>
	</h3><p class="reverse">
		<?=$d->link('Recensioni/', 'Indice', 'INDICE') ?>
		/ <?=$d->link('Recensioni/', 'Classifica', 'CLASSIFICA') ?>
		/ <?=$d->link('Recensioni/', 'Progressi', 'INCORSO') ?>
	</p><h3>
		<?=$d->link('NaNoWriMo/', 'NaNoWriMo')?>
	</h3><p class="reverse">
		<?=$d->link('NaNoWriMo/2010/', '2010')?>
		/ <?=$d->link('NaNoWriMo/Corvino/Multicolore/', 'Corvino Multicolore')?>
		/ <?=$d->link('NaNoWriMo/2011/', '2011')?>
	</p>
</div><div class="section">
	<div class="inside"><p><?php
			if ($opt['style'] == 'Raw') $self = $d->self;
			else $self = $d->self.$opt['style'].'/';

			echo ($d->link('Extra/Guida/', 'Modi', 'META', 'Modi'));
			echo (' [ ');
			if ($opt['mode'] == 'Gods') echo ('<span class="em">Gods</span>');
			else echo('<a href="'.$self.'">Gods</a>');
			echo (' | ');
			if ($opt['mode'] == 'Bolo') echo ('<span class="em">Bolo</span>');
			else echo('<a href="'.$self.'Bolo/">Bolo</a>');
			echo (' / ');
			if ($opt['mode'] == 'Luber') echo ('<span class="em">Luber</span>');
			else echo('<a href="'.$self.'Luber/">Luber</a>');
			echo (' ] ');
	?></p></div><div class="outside"><p class="reverse"><?php
			if ($opt['mode'] == 'Gods') $self = $d->self;
			else $self = $d->self.$opt['mode'].'/';

			echo (' [ ');
			if ($opt['style'] == 'Dado') {
				echo ('<a href="'.$self.'">Raw</a>');
				echo (' | ');
				echo ('<span class="em">Dado</span>');
			} else {
				echo ('<span class="em">Raw</span>');
				echo (' | ');
				echo ('<a href="'.$self.'Dado/">Dado</a>');
			}
			echo (' ] ');
			echo ($d->link('Extra/Guida/', 'Stili', 'META', 'Stili'));
	?></p></div>
</div><br /><div class="section">
	<h2> 
		<span class="em" title="Un po&apos;culattoni? No, no, solo allegri.">Allegri</span> compagni
	</h2><p>
		Le <a href="http://kiyuko.org/blog/">idee</a> del <span
		class="bolo">Bolo</span>
	</p><p>
		Le <a href="http://simgidacav.wordpress.com/">seghe</a> del <span
		class="dacav">Dacav</span>
	</p><p>
		Le <a href="http://mikezasch.wordpress.com/">lamentele</a> di <span
		class="mitch">Mitch</span>
	</p><p>
		Le <a href="http://jazzinghen.wordpress.com/">opinioni</a> di <span
		class="jazz">Jazzinghen</span>
	</p><p>
		Le <a href="http://mecharete.blogspot.com/">cose fighe</a> di <span
		class="em">Luber</span>
	</p>
</div>
