<?php
	if (isset($prev) || isset($next)) {
?>
	<div class="section">
		<h2>
			Pagine collegate
		</h2>
<?php
		if (isset($prev)) {
?>
		<p>
			Precendente: <?=$d->link($prev[1], $prev[0])?>	
		</p>
<?php
		}
		if (isset($next)) {
?>
		<p>
			Successivo: <?=$d->link($next[1], $next[0])?>	
		</p>
<?php
		}
?>
	</div>
<?php
	}
?>
