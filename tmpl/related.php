<?php
	if ($m->getPage()->hasOptions()) {
		echo ('<!-- Options -->'."\n");
		echo ("\t".'<div class="section">'."\n");
		echo ("\t\t".'<h2>Opzioni di pagina</h2>'."\n");
		if ($m->getPage()->hasOption('multipart'))
			if ($m->checkMode('complete'))
				echo ("\t\t".'<p>Visualizza in <a href="'.'">parti</a>.</p>'."\n");
			else
				echo ("\t\t".'<p>Visualizza in <a href="'.'">parti</a>.</p>'."\n");
		if ($m->getPage()->hasOption('downloadable'))
			echo ("\t\t".'<p>Scarica questa pagina come <a href="">PDF</a>.</p>'."\n");
		echo ("\t".'</div>'."\n");
		echo ('<!-- Options / End -->'."\n");
	}
	
	if ($m->getPage()->hasRelated()) {
		echo ('<!-- Related -->');
		echo ("\t".'<div class="section">'."\n");
		$prev = $m->getPage()->getRelated('prev');
		$index = $m->getPage()->getRelated('index');
		$next = $m->getPage()->getRelated('next');
		if ($prev) { echo("\t\t".'<p>Precedente: '.($m->ilink($prev)).'</p>'."\n"); }
		if ($index) { echo("\t\t".'<p>Indice: '.($m->ilink($index)).'</p>'."\n"); }
		if ($next) { echo("\t\t".'<p>Successivo: '.($m->ilink($next)).'</p>'."\n"); }
		echo ("\t".'</div>'."\n");
		echo ('<!-- Related / End-->');
	}
 ?>
