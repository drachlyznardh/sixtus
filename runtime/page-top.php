<!DOCTYPE html>
<html lang="it">
	<head>
		<!-- All your --><base href="http://<?=$_SERVER['SERVER_NAME']?>/" /><!-- are belong to us -->	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author"
			content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?=$attr['keywords']?>" />
		<title><?=$attr['short']?></title>
		<link rel="icon" href="runtime/style/ico/<?=($attr['gray']?'gray':'white')?>.ico" />
		<link rel="stylesheet" type="text/css" href="runtime/style/<?=($attr['gray']?'gray':'white')?>.css" />
		<link rel="stylesheet" type="text/css" href="runtime/style/voices.css" />
		<link rel="stylesheet" type="text/css" href="runtime/style/common.css" />
		<link rel="stylesheet" type="text/css" href="runtime/style/big-screen.css"
				media="screen and (min-device-width: 1024px), projection" />
		<link rel="stylesheet" type="text/css" href="runtime/style/wide-screen.css"
				media="screen and (max-device-width: 1023px) and (min-device-width: 480px)" />
		<link rel="stylesheet" type="text/css" href="runtime/style/small-screen.css"
				media="handheld, only screen and (max-device-width: 479px)" />
	</head><body>
		<div id="main">
			<div id="content">
				<div id="head">
<?php require_once('page-head.php'); ?>
				</div> <!-- Head -->
				<div id="core">
<?php require_once('page-check.php'); ?>
