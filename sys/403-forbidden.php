<?php

	$attr['title'] = '403 Forbidden';
	$attr['subtitle'] = 'No. Just no. I have my reasons';

	require_once('sys/fragments/in-before.php');
?><div class="section">
	<p>
		La richiesta [<code><?=$request['original']?></code>] non può essere
		soddisfatta. Probabilmente si tratta di un segreto.
	</p>
</div><?php
	require_once('sys/fragments/in-middle.php');
?><div class="section">
	<p>404 Not Found</p>
</div><?php
	require_once('sys/fragments/in-after.php');
?>
