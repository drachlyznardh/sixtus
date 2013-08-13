<?php

	$attr['style'] = 'gray';
	$attr['title'] = 'Test';
	$attr['subtitle'] = 'Per vedere se la roba funziona';

	require_once("sys/fragments/in-before.php");

	//if ($request['tabname'] == 'i' or $request['alltabs']) {
?>
<!-- /Test§i [Start] -->
<div class="section">
	<p>
		/test.php§i
	</p>
</div>
<!-- /Test§i [Stop] -->
<?php //}
	require_once("sys/fragments/in-middle.php");
?>
<div class="section">
	<p>
		Test.Right-Side
	</p>
</div>
<?php
	require_once("sys/fragments/in-after.php");
?>
