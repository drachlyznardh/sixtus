<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="<?=$base?>/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?=$section.$file.' '.$title[0]?>" />
		<link rel="alternate" type="application/rss+xml" title="TruNaluten - News" href="rss.xml" />

		<title><?=$title[0]?></title>
		
		<link rel="stylesheet" type="text/css" href="style/raw.css" />
		<?php if (isset($opt['dado'])) {?>
		<link rel="stylesheet" type="text/css" href="style/dado.css" />
		<?php } ?>
		<?php if ($amode == 'luber' || $amode == 'bolo') { ?>
		<link rel="stylesheet" type="text/css" href="style/notab.css" />
		<?php } else { ?>
		<script type="text/javascript" src="lib/tloader.js"></script>
		<?php } ?>
		<link rel="stylesheet" type="text/css" href="style/voices.css" />
		<script type="text/javascript" src="lib/tricks.js"></script>

		<link rel="shortcut icon" type="image/x-icon" href="style/ico/raw.ico" />
		
	</head>
	<body 
		<?php if ($amode=='gods') { ?>onload="javascript:tcheck();
			if(location.hash)t.show(location.hash.substr(1)); else t.show('i')"
		<?php } ?>
		onhashchange="javascript:t.show(location.hash.substr(1))">

		<div id="main">
			<div id="container" class="scrollable">
				<div id="head">
					<div class="section">
						<h2 id="home">
							<?=$d->link($location,$section)?>
						</h2><h1 id="title">
							<?=$title[0]?>
						</h1><h2 id="subtitle">
							<?=$title[1]?>
						</h2>
					</div>
				</div><div id="content">

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
						
				</div> <!-- Content -->

				<div id="foot">

<?php require_once ('tmpl/footer.php'); ?>
				</div> <!-- Foot -->
			</div>	
			<div id="rightside" class="scrollable">

<?php require_once ('tmpl/related.php'); ?>
<?php require_once ('tmpl/side/'.$rside); ?>
<!--?php require_once ('tmpl/dolike.php'); ?-->
			</div> <!-- RightSide -->

			<div id="leftside" class="scrollable">
	
<?php require ('tmpl/lside.php'); ?>
			</div> <!-- LeftSide -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
