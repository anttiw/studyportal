<!DOCTYPE html>
<html>
<head>
<title>STUDYPORTAL</title>
<link rel="stylesheet" href="styles.css"/>
<script type="text/javascript" src="insert/path/here.js"></script>
<script type="text/javascript">
	// Javascript goes here
</script>
</head>
<body>

	<div id="wrapper">
	
		<header></header>
		
		<div id="nav">
		
			<h1>Navigation bar</h1>
		
			<div id="userinfo">
			
				<?php
				
					echo '<p>You are logged in as: ' . $_SESSION['sessionID'] . '</p>';
				
				?>
				
			</div>
		
		</div>