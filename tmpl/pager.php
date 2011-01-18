<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="<?=$loco->base?>/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?=$m->thiskeyword()?>" />
		<link rel="alternate" type="application/rss+xml" title="TruNaluten - News" href="rss.xml" />

		<title><?=$m->getPage()->getTitle()?></title>
		
		<link rel="stylesheet" type="text/css" href="style/raw.css" />
		<link rel="stylesheet" type="text/css" href="style/voices.css" />
		<script type="text/javascript" src="lib/scr.js"></script>

		<link rel="shortcut icon" type="image/x-icon" href="style/ico/raw.ico" />
		
	</head>
	<body>


		<div id="main">
			<div id="leftside" class="scrollable">
	
<?php require ($loco->mktmpl('side-div')); ?>
			</div> <!-- Side -->
			<div id="container" class="scrollable">
				<div id="head">
					<div class="clearbox">

						<div class="section">
							<h2 id="home">
								/ <?=$m->showPath()?>
							</h2>
							<h1
							id="title"><?=$m->getPage()->getTitle()?></h1>
							<h2
							id="subtitle"><?=$m->getPage()->getSubtitle()?></h2>
						</div>

					</div> <!-- Clear Box -->
				</div> <!-- Head -->

				<div id="content">
					<div class="clearbox">

<?php if ($m->debug) $m->show();
	if (isset($m->prev)) {
?>
						<div class="section">
							<h2>Negli episodi precedenti</h2>
							<p>Questa serie continua dalla pagina precedente,
								<?=$m->ilink($m->prev)?>
							</p>
						</div>
<? }

	mkpage($d, $m);

	if (isset($m->next)) {
?>
						<div class="section">
							<h2>Continua...</h2>
							<p>Questa serie prosegue alla pagina successiva,
								<?=$m->ilink($m->next)?>
							</p>
						</div> <!-- Section -->
<?php } ?>
						
					</div> <!-- Clear Box -->
				</div> <!-- Content -->

				<div id="foot">
					<div class="clearbox">
						<div class="section">

<?php require_once ($loco->mktmpl('/footer-div')); ?>
						</div>
					</div> <!-- Clear Box -->
				</div> <!-- Foot -->
			</div>	
			<div id="rightside" class="scrollable">
				<div class="clearbox">

<?php require_once ($loco->mktmpl('/related')); ?>
<?php require_once ($m->thisside()); ?>
				</div> <!-- ClearBox -->
			</div> <!-- RightSide -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
