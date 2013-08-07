<?php
	
	$attr['title'] = 'Storia XCVI';
	$attr['subtitle'] = 'Storia XCVI';
	$attr['keywords'] = 'Storia Storie XCVI Mutande Katia';

	$related['prev'] = array('Storie/2013/XCV/', 'Le mutande di Katia');
	#$related['next'] = false;
	$related['next'] = array('Storie/2013/XCVI/', 'La formattazzazzazione');

	require_once('sys/fragments/in-before.php');

	if ($request['tab'] == 'i' || $request['tab'] == false || $attr['tabs'] != 'singletab') {
?><div class='section'>
	<p>
		Storie/2013/XCVI/ : Tab#I
	</p>
</div><?php
	}
	if ($request['tab'] == 'ii' || $attr['tabs'] != 'singletab')
	{ ?><div class="section">
	<p>Storie/2013/XCVI/ : Tab#II</p>
	<p>$Request[Tab] = [<?=$request['tab']?>], $Attr[Theme] = [<?=$attr['theme']?>]</p>
</div><?php }
	if ($request['tab'] == 'iii' || $attr['tabs'] != 'singletab')
	{ ?><div class="tab">
	<div class="section">
		<p>Storie/2013/XCVI/ : Tab§III</p>
	</div>
</div><?php }
	require_once('sys/fragments/in-middle.php');
	require_once('sys/fragments/related.php');
?><div class='section'>
	<h2>
		La formattazzazzazzione
	</h2><h2 class='reverse'>
		Storia <code>XCVI</code>
	</h2><ol><li>
			<?=make_tid($attr, $request['tab'], $search['page'][0], 'i', 'Primo')?> – <code>01/05</code>
		</li><li>
			<?=make_tid($attr, $request['tab'], $search['page'][0], 'ii', 'Secondo')?> – <code>02/05</code>
		</li><li>
			<?=make_tid($attr, $request['tab'], $search['page'][0], 'iii', 'Terzo')?>
		</li><li>
			<?=make_tid($attr, $request['tab'], $search['page'][0], 'vi', 'Quarto')?>
		</li><li>
			<?=make_tid($attr, $request['tab'], $search['page'][0], 'v', 'Quinto')?>
	</li></ol>
</div><?php
	require_once('sys/fragments/in-after.php');
?>
