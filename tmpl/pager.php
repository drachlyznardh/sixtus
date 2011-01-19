<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="<?=$base?>/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?=$keyword?>" />
		<link rel="alternate" type="application/rss+xml" title="TruNaluten - News" href="rss.xml" />

		<title><?=$title[0]?></title>
		
		<link rel="stylesheet" type="text/css" href="style/raw.css" />
		<link rel="stylesheet" type="text/css" href="style/voices.css" />
		<script type="text/javascript" src="lib/scr.js"></script>

		<link rel="shortcut icon" type="image/x-icon" href="style/ico/raw.ico" />
		
	</head>
	<body>


		<div id="main">
			<div id="leftside" class="scrollable">
	
<?php require ('tmpl/lside.php'); ?>
			</div> <!-- Side -->
			<div id="container" class="scrollable">
				<div id="head">
					<div class="clearbox">

						<div class="section">
							<h2 id="home">
								<?=$section?>
							</h2>
							<h1
							id="title"><?=$title[0]?></h1>
							<h2
							id="subtitle"><?=$title[1]?></h2>
						</div>

					</div> <!-- Clear Box -->
				</div> <!-- Head -->

				<div id="content">
					<div class="clearbox">

<?php if (isset($opt['debug'])) require_once('tmpl/debug.php');
	if (isset($prev)) {
?>
						<div class="section">
							<h2>Negli episodi precedenti</h2>
							<p>Questa serie continua dalla pagina precedente,
								<?=$d->link($prev[1], $prev[0])?>
							</p>
						</div>
<? }

	mkpage($d);

	if (isset($next)) {
?>
						<div class="section">
							<h2>Continua...</h2>
							<p>Questa serie prosegue alla pagina successiva,
								<?=$d->link($next[1], $next[0])?>
							</p>
						</div> <!-- Section -->
<?php } ?>
						
					</div> <!-- Clear Box -->
				</div> <!-- Content -->

				<div id="foot">
					<div class="clearbox">
						<div class="section">

<?php require_once ('tmpl/footer.php'); ?>
						</div>
					</div> <!-- Clear Box -->
				</div> <!-- Foot -->
			</div>	
			<div id="rightside" class="scrollable">
				<div class="clearbox">

<?php require_once ('tmpl/related.php'); ?>
<?php require_once ('tmpl/side/'.$rside); ?>
				</div> <!-- ClearBox -->
			</div> <!-- RightSide -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
