<?php

	$key = 'page';
	$fields = array ('page', 'path', 'prev', 'index', 'next');
	$table = 'links';

	$new['title']  = 'Aggiungi collegamento';
	$new['legend'] = 'Nuova collegamento';
	$new['label']  = 'Page';
	$new['name']   = 'page';

?>

<?php require_once ($forms .'/update-form.php'); ?>
<?php require_once ($forms .'/remove-form.php'); ?>
					</div><div class="section">
<?php require_once ($forms .'/new-form.php'); ?>
					</div><div class="section">
<?php $t->drawTable ($key, $fields, $table); ?>

