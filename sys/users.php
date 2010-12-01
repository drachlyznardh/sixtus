<?php

	$key = 'user';
	$fields = array ('user', 'name', 'password', 'permission');
	$table = 'users';

	$new['title']  = 'Aggiungi utenti';
	$new['legend'] = 'Nuovo utente';
	$new['label']  = 'Utente';
	$new['name']   = 'user';

?>

<?php require_once ($forms .'/update-form.php'); ?>
<?php require_once ($forms .'/remove-form.php'); ?>
					</div><div class="section">
<?php require_once ($forms .'/new-form.php'); ?>
					</div><div class="section">
<?php $t->drawTable ($key, $fields, $table); ?>

