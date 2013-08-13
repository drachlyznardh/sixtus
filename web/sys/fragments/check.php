<?php
	if (
		!isset($attr) ||
		!isset($attr['title']) ||
		!isset($attr['subtitle']) ||
		!isset($attr['keywords'])
	) {
?>
<div class="section">
	<h2>
		Check failed
	</h2>
	<?php
		if (isset($attr)) {
			if (!isset($attr['title'])) echo ('<p>Missin title</p>');
			if (!isset($attr['title'])) echo ('<p>Missin title</p>');
			if (!isset($attr['keywords'])) echo ('<p>Missin keywords</p>');
		} else echo ('<p>Missing $Attr</p>');
	?>
</div>
<?php } ?>
