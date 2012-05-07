<?php
	session_start();
	
	// All included files here
	include "/home/user/included/studyportal/session.php";
	include "/home/user/included/studyportal/sp_connect.php";
	include "users.php";
	
	include "header.php";
	

?>

	<h1>testing</h1>
	
	<?php
	
	// If session is not set, show the login form
	if(!isset($_SESSION['sessionID']))
	{
		echo '<p>Session is not set!</p>';
		echo '<div id="login">';
		echo '<p>Please login to view the contents of this page</p>';
				loginForm();
		echo '</div>';
	}
	else
	{
		echo '<p>Session was set with the following information:<br>';
		echo 'Username = ' . $_SESSION['firstname'] .' ' . $_SESSION['lastname'] . '</p>';
	}
	
	?>

<?php

	// include footer
	include "footer.php";

?>