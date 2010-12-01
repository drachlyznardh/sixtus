<?php

	$key = 'page';
	$fields = array ('page', 'title', 'subtitle', 'keywords', 'need', 'comms', 'permission');
	$table = 'pages';

	$new['title']  = 'Aggiungi pagina';
	$new['legend'] = 'Nuova pagina';
	$new['label']  = 'Page';
	$new['name']   = 'page';

?>

<?php require_once ($forms .'/update-form.php'); ?>
<?php require_once ($forms .'/remove-form.php'); ?>
					</div><div class="section">
<?php require_once ($forms .'/new-form.php'); ?>
					</div><div class="section">
<?php $t->drawTable ($key, $fields, $table); ?>

