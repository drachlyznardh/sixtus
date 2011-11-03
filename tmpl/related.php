<!-- Related --><div class="section">
<?php
		if (isset($prev)) {
			echo ('<div class="inside"><p>');
			if (isset($prev[3]))
				echo ($d->link($prev[0], $prev[1], $prev[2], $prev[3]));
			else if (isset($prev[2]))
				echo($d->link($prev[0], $prev[1], $prev[2]));
			else
				echo ($d->link($prev[0], $prev[1]));
			echo (' / <span class="em">Precedente</span>');
			echo ('</p></div>');
		}
?>
	<p style="text-align: center">
		/ <span class="em">
		<?=$d->link($sum, $search['category'][count($search['category']) - 1])?>
		</span> /
	</p>
<?php
		if (isset($next)) {
			echo('<div class="outside"><p class="reverse">');
			echo ('<span class="em">Successivo</span> / ');
			if (isset($next[3]))
				echo ($d->link($next[0], $next[1], $next[2], $next[3]));
			else if (isset($next[2]))
				echo ($d->link($next[0], $next[1], $next[2]));
			else
				echo ($d->link($next[0], $next[1]));
			echo ('</p></div>');
		}
?>
</div><!-- /Related -->
