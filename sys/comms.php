<?php

	$key = 'comm';
	$fields = array ('comm', 'user', 'page', 'content', 'date', 'res');
	$table = 'comms';

	$new['title']  = 'Aggiungi commento';
	$new['legend'] = 'Nuova commento';
	$new['label']  = 'Commento';
	$new['name']   = 'comm';

?>

<?php require_once ($forms .'/update-form.php'); ?>
<?php require_once ($forms .'/remove-form.php'); ?>
					</div><div class="section">
<?php require_once ($forms .'/new-form.php'); ?>
					</div><div class="section">
<?php $t->drawTable ($key, $fields, $table); ?>

