<?php

	$m->mkpage('Il lampione','Corvino Multicolore &ndash; VIII');
	$m->mkrelated('prev','Capitolo VII','NaNoWriMo/Corvino/Multicolore/VII/');
	$m->mkrelated('next','Capitolo IX','NaNoWriMo/Corvino/Multicolore/IX/');

	function mktab($d, $m, $chapter, $number, $title, $file, $next=false) {
	
		echo ("\n".'<div class="tab" id="tab'.$number.'" style="display: none">');
		echo ("\n\t".'<div class="section"><a id="'.$number.'"></a>');
		echo ("\n\t\t".'<h2>'.$chapter.', '.$number.' &ndash; '.$title.'</h2>');
		require_once ($file);
		echo ("\n\t\t".'<h2 class="reverse">'.$chapter.', '.$number.' &ndash; '.$title.' /fine</h2>');
		if ($next)
			echo ("\n\t\t".'<p>Salta alla <a
			onclick="javascript:tab.show(\''.$next.'\', true)">prossima
			sezione</a>.</p>');
		echo ("\n\t".'</div>');
		echo ("\n".'</div>');

	}

	function mkli($title, $number) {
	
		echo ("\t\t\t\t\t");
		echo ('<li class="reverse" id="tarrow'.$number.'" onclick="javascript:tab.show(\''.$number.'\', true)">');
		echo ($title.'</li>');
		echo ("\n");
	}

	function mkpage ($d, $m) {
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<ol style="list-style-type:lower-roman">
				<?php
					mkli ('Quella mattina', 'i');
					mkli ('A casa', 'ii');
					mkli ('Al parcheggio', 'iii');
					mkli ('Di corsa', 'iv');
					mkli ('A casa, di nuovo', 'v');
				?>
			</ol>
		</div>
	</div><div class="widecontent">
		<?php
			mktab ($d, $m, 'VIII', 'i',   'Quella mattina', 'viii.d/i.php', 'ii');
			mktab ($d, $m, 'VIII', 'ii',  'A casa', 'viii.d/ii.php', 'iii');
			mktab ($d, $m, 'VIII', 'iii', 'Al parcheggio', 'viii.d/iii.php', 'iv');
			mktab ($d, $m, 'VIII', 'iv',  'Di corsa', 'viii.d/iv.php', 'iv');
			mktab ($d, $m, 'VIII', 'v',   'A casa, di nuovo', 'viii.d/v.php');
		?>
	</div>
</div>
<script type="text/javascript">var tab = new Tabler('i');tab.show('i')</script>
<?php } ?>
