<?php

	session_start();
	
	// All included files here
	include "/home/user/included/studyportal/session.php";
	include "/home/user/included/studyportal/sp_connect.php";
	include "functions.php";
	
	include "header.php";
	

?>

	<!-- HTML code for divs -->
	<div id="...">
	
		<?php
		
			// PHP code for this div

			// Create conditional statements of what to show depending of the user type
			// i.e. if(is_superuser = true)...
			
			// Make connection:
			// $query = "SELECT * FROM table";
			// $result = mysql_query($query,$connect);
			
			// If necessary, do something for the returned results ($result)
			
			// Process data sent from a form (see the comment line below)
			
			// Call function for viewing something (i.e. a form, a list)
			
			// Close connection:
			// mysql_close($connect)
		
		?>
	
	</div>

<?php

	// include footer
	include "footer.php";

?>