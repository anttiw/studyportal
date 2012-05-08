<?php

	session_start();
	
	// COURSES.PHP
	
	// All included files here
	include "/home/user/included/studyportal/session.php";
	include "/home/user/included/studyportal/sp_connect.php";
	include "functions.php";
	
	include "header.php";

?>

	<!-- HTML code for divs -->
	<div id="groups">
	
		<?php
		
			if($_SESSION['is_admin'] == true)
			{
			
				echo '<h3>Create a new group</h3>';
				
				// The create new group form
				echo '<form name="createGroup" method="POST" action="courses.php">
						<p>
						Group name:</br>
						<input type="text" name="groupname" /></br>
						Number of members:</br>
						<input type="text" name="num_members" /></br>
						</p>
						</form>';
			
			}
		
			
		
		?>
	
	</div>

<?php

	// include footer
	include "footer.php";

?>