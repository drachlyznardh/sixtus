<!DOCTYPE html>
<html lang="it">
	<head>
		<!-- All your --><base href="http://<?=$_SERVER['SERVER_NAME']?>/" /><!-- are belong to us -->	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author"
			content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?=$p['keywords']?>" />
		<title><?=$p['short']?></title>
		<link rel="icon" href="runtime/style/ico/<?=$attr['style']?>.ico" />
		<link rel="stylesheet" type="text/css" href="runtime/style/<?=$attr['style']?>.css" />
		<link rel="stylesheet" type="text/css" href="runtime/style/voices.css" />
		<link rel="stylesheet" type="text/css" href="runtime/style/common.css" />
		<link rel="stylesheet" type="text/css" href="runtime/style/big-screen.css"
				media="screen and (min-device-width: 1025px), projection" />
		<link rel="stylesheet" type="text/css" href="runtime/style/wide-screen.css"
				media="screen and (max-device-width: 1024px) and (min-device-width: 481px)" />
		<link rel="stylesheet" type="text/css" href="runtime/style/small-screen.css"
				media="handheld, only screen and (max-device-width: 480px)" />
	</head><body>
		<div id="main">
			<div id="content">
				<div id="head">
<?php require_once('head.php'); ?>
				</div> <!-- Head -->
				<div id="core">
<?php if ($attr['check']) require_once('check.php'); ?>
