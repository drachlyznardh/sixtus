<!-- Related --><div class="section">
<?php
	$prev = $p->getPrev();
	if ($prev) {
		echo ('<div class="inside"><p>/ ');
		echo ($prev);#$d->link($prev[0], $prev[1], $prev[2], $prev[3]));
		echo (' / <span class="em">Precedente</span>');
		echo ('</p></div>');
	}
?>
	<p style="text-align: center">
		<?php
			$sum = false;
			foreach ($search['category'] as $category) {
				$sum .= $category .'/';
				echo (' / '.$d->link($sum, $category));
			}
			echo (' /');
		?>
	</p>
<?php
	$next = $p->getNext();
	if ($next) {
		echo('<div class="outside"><p class="reverse">');
		echo ('<span class="em">Successivo</span> / ');
		echo ($next);#$d->link($next[0], $next[1], $next[2], $next[3]));
		echo (' /</p></div>');
	}
	$related = $p->getRelated();
	if ($related) {
		$first = false;
		echo ('<h3>Vedi anche</h3><ul><li>');
		if ($related[0] === false) array_shift ($related);
		echo $related[0];
		array_shift ($related);
		foreach ($related as $rel) {
			if ($rel === false) {
				echo ('</li><li>');
				$first = true;
			} else if ($first) {
				echo ($rel);
				$first = false;
			} else echo (' | '.$rel);
		}
		echo ('</li></ul>');
	}
?>
</div><!-- /Related -->
