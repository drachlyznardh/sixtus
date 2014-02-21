<?php
	if ($attr['check']) {
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
<div class="section">
	<p>Now displaying [
		<span class="big-screen">Big-Screen</span>
		<span class="wide-screen">Wide-Screen</span>
		<span class="small-screen">Small-Screen</span>
	] CSS sheet.</p>
	<h3 class="reverse">Page parameters</h3>
	<p>$p = [<?=var_dump($p)?>]</p>
	<p>$r = [<?=var_dump($r)?>]</p>
	<p>$c = [<?=var_dump($c)?>]</p>
	<h3 class="reverse">Runtime parameters</h3>
	<p>Token = [<?=var_dump($token)?>]</p>
	<p>Attr = [<?=var_dump($attr)?>]</p>
	<p>Heading = [<?=var_dump($heading)?>]</p>
	<p>Request = [<?=var_dump($request)?>]</p>
	<p>Target File = [<?=$target_file?>] on [<?=$_SERVER['HTTP_HOST']?>]</p>
</div>
<?php } ?>
