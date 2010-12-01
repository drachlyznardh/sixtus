<?php

	$key = 'need';
	$fields = array ('need', 'style', 'script', 'side');
	$table = 'needs';

	$new['title']  = 'Aggiungi bisogno';
	$new['legend'] = 'Nuova bisogno';
	$new['label']  = 'Bisogno';
	$new['name']   = 'need';

?>

<?php require_once ($forms .'/update-form.php'); ?>
<?php require_once ($forms .'/remove-form.php'); ?>
					</div><div class="section">
<?php require_once ($forms .'/new-form.php'); ?>
					</div><div class="section">
<?php $t->drawTable ($key, $fields, $table); ?>

