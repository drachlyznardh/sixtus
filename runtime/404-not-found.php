<?php

	$attr['title'] = '404 Not Found';
	$attr['short'] = '404 Not Found';
	$attr['subtitle'] = 'No such file or directory';
	$attr['keywords'] = '';

	$related['prev'] = false;
	$related['next'] = false;

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
	<h2>404 Not Found</h2>
	<p>No such file or directory.</p>
</div><?php
	require_once('page-bottom.php');
?>
