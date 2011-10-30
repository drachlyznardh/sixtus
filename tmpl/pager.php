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
			if (isset($opt['dado']))
				echo ('<link rel="stylesheet" type="text/css" href="style/dado.css" />');

			if ($amode == 'luber' || $amode == 'bolo')
				echo ('<link rel="stylesheet" type="text/css" href="style/notab.css" />');
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
							/ 
							<?php
								$sum = false;
								foreach ($search['category'] as $category) {
									$sum .= $category .'/';
									echo ($d->link($sum, $category) .' / ');
								}
								echo $d->link($self, strtoupper($pagename), false);
								if ($tabname)
									echo (' . '.$d->frag($self, strtoupper($tabname), strtoupper($tabname)));
							?>
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
		if (isset($prev[2])) echo ($d->link($prev[0], $prev[1], $prev[2]));
		else echo ($d->link($prev[1], $prev[0]));
		echo ('.</p></div>');
	}

	mkpage($d);

	if (isset($next)) {
		echo ('<div class="section"><h2>Continua…</h2><p>Questa serie prosegue alla pagina successiva, ');
		if (isset($next[2])) echo ($d->link($next[0], $next[1], $next[2]));
		else echo($d->link($next[1], $next[0]));
		echo('.</p></div>');
	}
?>
				</div> <!-- Content -->
				<div id="foot"><?php require_once ('tmpl/footer.php'); ?></div> <!-- Foot -->
			</div>	
			<div id="rightside"><?php require_once ('tmpl/related.php'); require_once ('tmpl/side/'.$rside); ?></div> <!-- RightSide -->
			<div id="leftside"><?php require_once ('tmpl/lside.php'); ?></div> <!-- LeftSide -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
