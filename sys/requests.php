<?php

	$key = 'request';
	$fields = array ('request', 'page');
	$table = 'requests';

	$new['title']  = 'Aggiungi richiesta';
	$new['legend'] = 'Nuova richiesta';
	$new['label']  = 'Richiesta';
	$new['name']   = 'request';

?>

<?php require_once ($forms .'/update-form.php'); ?>
<?php require_once ($forms .'/remove-form.php'); ?>
					</div><div class="section">
<?php require_once ($forms .'/new-form.php'); ?>
					</div><div class="section">
<?php $t->drawTable ($key, $fields, $table); ?>

