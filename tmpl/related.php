<?php
	if (isset($prev) || isset($next)) {
?>
	<div class="section">
		<h2>
			Pagine collegate
		</h2>
<?php
		if (isset($prev)) {
			echo ('<p>Precedente: ');
			if (isset($prev[2])) echo($d->link($prev[0], $prev[1], $prev[2]));
			else echo ($d->link($prev[1], $prev[0]));
			echo ('</p>');
		}
		if (isset($next)) {
			echo('<p>Successivo: ');
			if (isset($next[2])) echo ($d->link($next[0], $next[1], $next[2]));
			else echo ($d->link($next[1], $next[0]));
			echo('</p>');
		}
?>
	</div>
<?php
	}
?>
