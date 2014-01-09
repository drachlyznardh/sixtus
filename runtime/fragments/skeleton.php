<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --><base href="http://<?=$_SERVER['SERVER_NAME']?>/" /><!-- are belong to us -->	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author"
			content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="News" />
		<title>Novità</title>
		<link rel="stylesheet" type="text/css" href="sys/style/<?=$attr['style']?>.css" />
		<link rel="stylesheet" type="text/css" href="sys/style/voices.css" />
		<link rel="stylesheet" type="text/css" href="sys/style/common.css" />
		<link rel="shortcut icon" type="image/x-icon" href="sys/style/ico/<?=$attr['style']?>.ico" />
	</head>
	<body>
		<div id="main">
			<div id="content">
				<div id="head">
					<!-- Require_once("Sys/Fragment/Head") -->
					<?php require_once("sys/fragments/head.php"); ?>
				</div> <!-- Head -->
				<div id="core">
					<!-- Require_once($Request['Source']) -->
					<?php require_once($request['source']); ?>
				</div> <!-- Core -->
				<div id="foot">
					<!-- Require_once("Sys/Fragment/Foot") -->
					<?php require_once("sys/fragments/foot.php"); ?>
				</div> <!-- Foot -->
			</div>
			<div id="right-side">
				<!-- Require_once("Sys/Fragment/Right-side") -->
				<?php require_once("sys/fragments/right-side.php"); ?>
			</div>
			<div id="left-side">
				<!-- Require_once("Sys/Fragment/Left-side") -->
				<?php require_once("sys/fragments/left-side.php"); ?>
			</div>
		</div>
	</body>
</html>
