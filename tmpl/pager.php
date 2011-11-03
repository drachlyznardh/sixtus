<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="<?=$base?>/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?php foreach (explode('/', $self) as $keyword) echo ' '.$keyword; ?>" />
		<link rel="alternate" type="application/rss+xml" title="TruNaluten - News" href="rss.xml" />

		<title><?=$title[0]?></title>
		
		<link rel="stylesheet" type="text/css" href="style/raw.css" />
		<?php
			if ($opt['style'] == 'Dado')
				echo ('<link rel="stylesheet" type="text/css" href="style/dado.css" />');
		?>
		<link rel="stylesheet" type="text/css" href="style/voices.css" />
		<script type="text/javascript" src="lib/tricks.js"></script>

		<link rel="shortcut icon" type="image/x-icon" href="style/ico/raw.ico" />
	</head>
	<body> 
		<div id="main">
			<div id="container">
				<div id="head">
					<div class="section">
						<div class="inside em"><p style="text-align:center">
							<a href="http://gods.roundhousecode.com">Gods</a>
							. <a href="http://roundhousecode.com">RoundhouseCode</a>
							. <a href="http://roundhousecode.com">com</a>
							<?php
								$sum = false;
								foreach ($search['category'] as $category) {
									$sum .= $category .'/';
									echo (' / '.$d->link($sum, $category));
								}
								if ($last != 'index') {
									echo (' / ');
									echo $d->link($self, strtoupper($pagename), false);
								}
								if ($tab['name']) {
									echo (' § ');
									echo $d->link($tab['req'].strtoupper($tab['name']).'/', strtoupper($tab['name']), 0);
								}
							?>
							/
						</p></div><h1 style="text-align:center">
							<?=$title[0]?>
						</h1><div class="outside em"><p style="text-align: center">
								<?=$title[1]?>	
						</p></div>
					</div>
				</div><div id="content">
<?php
	if (isset($opt['debug'])) require_once('tmpl/debug.php');
	if (isset($prev)) {
		echo ('<div class="section"><h2>Negli episodi precedenti</h2><p>Questa serie continua dalla pagina precedente, ');
		if (isset($prev[3]))
			echo ($d->link($prev[0], $prev[1], $prev[2], $prev[3]));
		else if (isset($prev[2]))
			echo ($d->link($prev[0], $prev[1], $prev[2]));
		else
			echo ($d->link($prev[0], $prev[1]));
		echo ('.</p></div>');
	}

	if (function_exists('mkpage')) mkpage($d);
	if (count($pages) > 1) $d->included = true;
	foreach ($pages as $p) $p($d);

	if (isset($next)) {
		echo ('<div class="section"><h2>Continua…</h2><p>Questa serie prosegue alla pagina successiva, ');
		if (isset($next[3]))
			echo ($d->link($next[0], $next[1], $next[2], $next[3]));
		else if (isset($next[2]))
			echo ($d->link($next[0], $next[1], $next[2]));
		else
			echo($d->link($next[0], $next[1]));
		echo('.</p></div>');
	}
?>
				</div> <!-- Content -->
				<div id="foot"><?php require_once ('tmpl/footer.php'); ?></div> <!-- Foot -->
			</div> <!-- Container -->
			<div id="rightside"><?php
				require_once ('tmpl/related.php');
				echo ('<br />');
				foreach ($sides as $s) $s($d);
				echo ('<br />');
				require_once ('tmpl/side/'.$rside);
			?></div> <!-- RightSide -->
			<div id="leftside"><?php require_once ('tmpl/lside.php'); ?></div> <!-- LeftSide -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
