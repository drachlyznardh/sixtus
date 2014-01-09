<?php

	$attr['title'] = '404 Not Found';
	$attr['subtitle'] = 'No such file or directory';

	require_once('page-top.php');
?><div class="section">
	<p>
		La richiesta [<code><?=$request['original']?></code>] non ha prodotto
		alcun risultato. È possibile che l'URL contenga un errore, che link sia
		stato scritto male o che io mi sia sbagliato.
	</p>
</div><?php
	require_once('page-middle.php');
?><div class="section">
	<p>404 Not Found</p>
</div><?php
	require_once('page-bottom.php');
?>
