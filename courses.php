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
						<input type="text" name="groupname" size="27" /></br>
						Number of members:</br>
						<input type="text" name="num_members" size="2" />
						<input type="submit" name="genGroupList" value="Generate Member List" />
						</p>
						</form>
						<hr>';
				
				if(isset($_POST['genGroupList']))
				{
					echo '<p>Testing! Number of members was: ' .$_POST['num_members'].'</p>';
					
					$numMembers = $_POST['num_members'];
					$groupName = $_POST['groupname'];
					
					echo '<form name="groupMembers" method="POST" action="courses.php">
							<p>';
					
						// Loop through all of the inserted "members"
						for($i = 1 ; $i <= $numMembers ; $i++)
						{
							echo 'Member '.$i.':</br>
							<input type="text" name="member'.$i.'" size="27"></br>';
						}
					
					echo '</p>
							</form>';
				}
			
			}
		
			
		
		?>
	
	</div>

<?php

	// include footer
	include "footer.php";

?>