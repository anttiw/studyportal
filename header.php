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
		
			
			<?php
			
				// Show the navigation bar contents depending on the user status (is_admin, is_superuser)
				
				if(isset($_SESSION['sessionID']))
				{
				
					echo '<p>';
					if($_SESSION['is_admin'] == true || $_SESSION['is_superuser'] == true)
					{
						echo '<a href="accountman.php">Account Management</a></br>';
						echo '<a href="courses.php">Courses</a>';
					}
					else
					{
						
						echo '<a href="courses.php">Courses</a>';
					}
					echo '<p>';
				
				}
			
			?>
		
		</div>
		
		<!-- User information & logout -->
		<div id="userinfo">
			
				<?php
				
					if(isset($_SESSION['sessionID']))
					{
						echo '<p>You are logged in as: ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '</p>';
						echo '<p><a href="users.php?action=logout">Log out</a></p>';
					}
					else
					{
						echo '<p>You are not logged in</p>';
					}
				
				?>
				
			</div>