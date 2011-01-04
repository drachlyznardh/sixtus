<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="<?=$base?>/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="Tru Naluten <?=isset($page['keyword'])?$page['keyword']:''?>" />
		<link rel="alternate" type="application/rss+xml" title="TruNaluten - News" href="rss.xml" />

		<title><?=$page['title']?></title>
		
		<link rel="stylesheet" type="text/css" href="style/raw.css" />
		<script type="text/javascript" src="lib/scr.js"></script>
		<script type="text/javascript" src="lib/scroll.js"></script>
<?php
	if (isset($master->source['scripts']))
		foreach ($master->source['scripts'] as $script)
			echo "\n\t\t" . '<script type="text/javascript" src="lib/'. $script .'"></script>';

	if (isset($master->source['styles']))
		foreach ($master->source['styles'] as $style)
			echo "\n\t\t" . '<link rel="stylesheet" type="text/css" href="style/'. $style .'" />';

?>

		<link rel="shortcut icon" type="image/x-icon" href="style/ico/raw.ico" />
		
	</head>
	<body>
		<div id="main">
			<div id="leftside" class="scrollable">
	
<?php require ("$tmpl/side-div.php"); ?>
			</div> <!-- Side -->
			<div id="container" class="scrollable">
				<div id="head">
					<div class="clearbox">

						<div class="section">
							<p id="home"><?=$s->ilink ('','home');?></p>
							<h1 id="title"><?=$page['title']?></h1>
							<p id="subtitle"><?=$page['subtitle']?></p>
						</div>

					</div> <!-- Clear Box -->
				</div> <!-- Head -->

				<div id="content">
					<div class="clearbox">

						<div class="section">
						<?php if (isset($related['prev'])) { ?>
							<h2>Negli episodi precedenti</h2>
							<p>Questa serie continua dalla pagina precedente,
								<?=$s->ilink ($related['prev'])?>
							</p></div><div class="section">
						<? } ?>
						
						<?=mkpage($d, $s, $context)?>
						
						<?php if (isset($related['next'])) { ?>
							</div><div class="section">
							<h2>Continua...</h2>
							<p>Questa serie prosegue alla pagina successiva,
								<?=$s->ilink ($related['next'])?>
							</p>
						<?php } ?>
						
						</div> <!-- Section -->
<?php if ((isset($related) && $related) || (isset ($page['side']) && $page['side'])) { ?>
					</div> <!-- Clear Box -->
				</div> <!-- Content -->

				<div id="foot">
					<div class="clearbox">
						<div class="section">

<?php require_once ($tmpl . '/footer-div.php') ?>
						</div>
					</div> <!-- Clear Box -->
				</div> <!-- Foot -->
			</div>	
				<div <?php if (isset($flag['fixed-nav']) && !$flag['fixed-nav']) echo ('class="nav"');

					else echo ('id="rightside"
					class="scrollable"'); ?>>
					<div class="content"><div class="clearbox">
<?php } ?>
<?php if (isset($related['prev']) || isset($related['index']) || isset($related['next'])) { ?>
						<div class="section">
							<h2>Pagine collegate</h2>
							<?php if (isset($related['prev'])) { ?>
								<p>Precedente:
									<?=$s->ilink ($related['prev'])?>
								</p>
							<?php }
							if (isset($related['index'])) { ?>
								<p>Indice:
									<?=$s->ilink ($related['index'])?>
								</p>
							<?php }
							if (isset($related['next'])) { ?>
								<p>Successivo:
									<?=$s->ilink ($related['next'])?>
								</p>
							<?php }
							if (isset($related['download'])) { ?>
								<p><a href="<?=$request?>download/">Download</a></p>
							<?php } ?>
						</div> <!-- Section -->
<?php } 
	if (isset($page['side'])) {
		echo ('<!-- Requiring ['. $page['side'] .'] -->');
		require_once ($sides .'/'. $page['side']);
		echo ('<!-- Requiring ['. $page['side'] .'] End -->');
		echo ("\n");
	}
?>
				</div> <!-- Nav --> </div></div>
				
				</div>
				
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
