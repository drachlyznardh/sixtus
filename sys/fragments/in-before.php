<html lang="it">
	<head>
		<!-- All your --><base href="http://<?=$_SERVER['SERVER_NAME']?>/" /><!-- are belong to us -->	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author"
			content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?=$attr['keywords']?>" />
		<title><?=$attr['title']?></title>
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
					<!-- Require_once("Sys/Fragment/Check") -->
					<?php require_once('sys/fragments/check.php'); ?>
