<?php

	session_start();
	
	// All included files here
	include "/home/user/included/studyportal/session.php";
	include "/home/user/included/studyportal/sp_connect.php";
	include "functions.php";
	
	include "header.php";
	

?>

	<?php
	
	// If session is not set, show the login form
	// If(!isset($_SESSION['sessionID']))
	// {
	
		echo '<div id="login">';
		echo '<p>Please login to view the contents of this page</p>';
				loginForm();
		echo '</div>'
	
	// }
	// elseif($_SESSION['is_admin'] == 1)
	// {
	// }
	// else
	// {
	//		When the user is a student
	// }
	
	?>

<?php

	// include footer
	include "footer.php";

?>