<?php

	session_start();
	
	// All included files here
	include "/home/user/included/studyportal/session.php";
	include "/home/user/included/studyportal/sp_connect.php";
	include "functions.php";
	
	include "header.php";
	
	// Prohibit students from seeing this page (not tested!)
	if($_SESSION['is_admin'] == false)
	{
		header("location: index.php");
	}
	
?>
	
		<?php
		
			// Check the user's status
			// SUPERUSER BLOCK!
			if($_SESSION['is_superuser'] == true)
			{
				// INSERTING AND MODIFYING AN ADMIN ACCOUNT
				echo '<div class="insertuser">';
				
					// Code for adding a new admin account
					if(isset($_POST['addAdmin']))
					{
						// Receive & check the variables
						$firstname = validate($_POST['firstname']);
						$lastname = validate($_POST['lastname']);
						$username = validate($_POST['username']);
						$password = validate($_POST['password']);
						
						// Note! This might need to be checked if it works
						$superuser = $_POST['superuser'];
						
						echo '<p>Superuser value: ' . $superuser . '</p>';
						
						// Check whether a user with same preferences exists in database
						$q_adminCheck = "SELECT * FROM users WHERE firstname='".$firstname."' AND lastname='".$lastname."'";
						$res_adminCheck = mysql_query($q_adminCheck,$connect);
						
						if(!$res_adminCheck)
						{
							echo '<p>Problem connecting to database</p>';
						}
						
						$adminRows = mysql_num_rows($res_adminCheck);
						
						if($adminRows > 0)
						{
							echo '<p>User already exists!</p>';
						}
						else
						{
							echo '<p>User does not exist!</p>';
							
							// Encrypt the password
							$cryptedPasswd = sha1($password);
							
							$q_insertAdmin = "INSERT INTO users(firstname,lastname,is_admin,is_superuser,username,password) VALUES('".$firstname."','".$lastname."',1,'".$superuser."','".$username."','".$cryptedPasswd."')";
							$res_insertAdmin = mysql_query($q_insertAdmin,$connect);
							
							if(!$res_insertAdmin)
							{
								echo '<p>Database connection failed (insert user)</p>';
							}
						}
						
					}
				
					// Code if the user is a superuser
					echo '<h3>Create a new admin account</h3>';
					
						// Form for adding a new admin account
						addAdminForm();
					
					echo '<h3>Modify an admin account</h3>';
					
						// Fetch all admin accounts from database
						$q_getAdmins = "SELECT * FROM users WHERE is_admin=1";
						$res_getAdmins = mysql_query($q_getAdmins,$connect);
						
						if(!$res_getAdmins)
						{
							echo '<p>Could not fetch admin accounts</p>';
						}
						
						// Drop down list to select admins
						echo '<form name="selectAdmin" method="POST" action="accountman.php">
								<p>
								<select name="admins">';
								while($admins = mysql_fetch_array($res_getAdmins))
								{
									echo '<option value="'.$admins['user_id'].'">'.$admins['firstname'].' '.$admins['lastname'].'</option>';
								}
								echo '</select>
								<input type="submit" name="fetchAdmin" value="Select account" />
								</p>
								</form>';
						
						
						
						// Fetch the selected account information to a form
						if(isset($_POST['fetchAdmin']))
						{
							$q_selectedAdmin = "SELECT * FROM users WHERE user_id='".$_POST['admins']."'";
							$res_selectedAdmin = mysql_query($q_selectedAdmin,$connect);
							
							if(!$res_selectedAdmin)
							{
								echo '<p>you failed bitch!</p>';
							}
							
							$adminInfo = mysql_fetch_array($res_selectedAdmin);
							
							echo   '<form name="modifyAdminForm" method="POST" action="accountman.php">
									<p>
									The ID of the selected account: <input type="text" name="targetID" size="2" value="'.$_POST['admins'].'" /></br>
									</p>
									<p>
									Firstname: </br>
									<input type="text" name="firstname" value="'.$adminInfo['firstname'].'" /></br>
									Lastname: </br>
									<input type="text" name="lastname" value="'.$adminInfo['lastname'].'" /></br>
									Username: </br>
									<input type="text" name="username" value="'.$adminInfo['username'].'" /></br>
									<input type="checkbox" name="superuser" value="1">Has superuser privileges</br>';
									
									// Check & show the current status of the is_superuser-field
									if($adminInfo['is_superuser'] == true)
									{
										echo '(Current setting: TRUE)';
									}
									else
									{
										echo '(Current setting: FALSE)';
									}
									
							echo	'</p>
									<p>
									<input type="submit" name="modifyAdmin" value="Update admin account" />
									</p>
								</form>';
						}
						
						// Update the admin info in database
						if(isset($_POST['modifyAdmin']))
						{
							$adminTargetID = $_POST['targetID'];
							$modFirstname = validate($_POST['firstname']);
							$modLastname = validate($_POST['lastname']);
							$modUsername = validate($_POST['username']);
							$modSuperuser = $_POST['superuser'];
							
							// Update the database
							$q_modAdmin = "UPDATE users SET firstname='".$modFirstname."',lastname='".$modLastname."',username='".$modUsername."',is_superuser='".$modSuperuser."' WHERE user_id='".$adminTargetID."'";
							$res_modAdmin = mysql_query($q_modAdmin,$connect);
							
							if(!$res_modAdmin)
							{
								echo '<p>Update failed (admin)</p>';
							}
							else
							{
								echo '<p>Admin account updated!</p>';
							}
						}
				
				echo '</div>';
				
			}
			
			// IF THE USER IS A SUPERUSER OR PLAIN ADMIN
			if($_SESSION['is_superuser'] == true || $_SESSION['is_admin'] == true)
			{
				// INSERTING AND MODIFYING A STUDENT ACCOUNT
				echo '<div class="insertuser">';
				
					// Inserting a new user into the database
					if(isset($_POST['addStudent']))
					{
						$studentFirstname = validate($_POST['stfirstname']);
						$studentLastname = validate($_POST['stlastname']);
						$studentUsername = validate($_POST['stusername']);
						$studentPassword = validate($_POST['stpassword']);
						
						// Check whether a user already exists in the database
						$q_studentCheck = "SELECT * FROM users WHERE firstname='".$studentFirstname."' AND lastname='".$studentLastname."'";
						$res_studentCheck = mysql_query($q_studentCheck,$connect);
						
						if(!$res_studentCheck)
						{
							echo '<p>Problem encountered</p>';
						}
						
						$studentRows = mysql_num_rows($res_studentCheck);
						
						if($studentRows > 0)
						{
							echo '<p>A user with the same information already exists</p>';
						}
						else
						{
							$cryptedPasswd = sha1($studentPassword);
							
							$q_insertStudent = "INSERT INTO users(firstname,lastname,username,password,is_admin,is_superuser) VALUES('".$studentFirstname."', '".$studentLastname."', '".$studentUsername."', '".$cryptedPasswd."',0,0)";
							$res_insertStudent = mysql_query($q_insertStudent,$connect);
							
							if(!$res_insertStudent)
							{
								echo '<p>Connection to database failed</p>';
							}
						}
						
					}
				
					echo '<h3>Add a new student account</h3>';
					
						addStudentForm();
					
					echo '<h3>Modify a student account</h3>';
					
					$q_getStudents = "SELECT * FROM users WHERE is_admin=0 AND is_superuser=0";
					$res_getStudents = mysql_query($q_getStudents,$connect);
						
						if(!$res_getStudents)
						{
							echo '<p>Could not fetch Student accounts</p>';
						}
						
						// Drop down list to select students
						echo '<form name="selectStudent" method="POST" action="accountman.php">
								<p>
								<select name="students">';
								while($students = mysql_fetch_array($res_getStudents))
								{
									echo '<option value="'.$students['user_id'].'">'.$students['firstname'].' '.$students['lastname'].'</option>';
								}
								echo '</select>
								<input type="submit" name="fetchStudent" value="Select account" />
								</p>
								</form>';
					
						// Fetch the selected account information to a form
						if(isset($_POST['fetchStudent']))
						{
							$q_selectedStudent = "SELECT * FROM users WHERE user_id='".$_POST['students']."'";
							$res_selectedStudent = mysql_query($q_selectedStudent,$connect);
							
							if(!$res_selectedStudent)
							{
								echo '<p>you failed bitch!</p>';
							}
							
							$studentInfo = mysql_fetch_array($res_selectedStudent);
							
							echo   '<form name="modifyStudentForm" method="POST" action="accountman.php">
									<p>
									The ID of the selected account: <input type="text" name="targetID" size="2" value="'.$_POST['students'].'" /></br>
									</p>
									<p>
									Firstname: </br>
									<input type="text" name="firstname" value="'.$studentInfo['firstname'].'" /></br>
									Lastname: </br>
									<input type="text" name="lastname" value="'.$studentInfo['lastname'].'" /></br>
									Username: </br>
									<input type="text" name="username" value="'.$studentInfo['username'].'" /></br>
									<p>
									<input type="submit" name="modifyStudent" value="Update student account" />
									</p>
								</form>';
						}
						
						// Update the student info in database
						if(isset($_POST['modifyStudent']))
						{
							$studentTargetID = $_POST['targetID'];
							$modStudentFirstname = validate($_POST['firstname']);
							$modStudentLastname = validate($_POST['lastname']);
							$modStudentUsername = validate($_POST['username']);
							
							// Update the database
							$q_modStudent = "UPDATE users SET firstname='".$modStudentFirstname."',lastname='".$modStudentLastname."',username='".$modStudentUsername."' WHERE user_id='".$studentTargetID."'";
							$res_modStudent = mysql_query($q_modStudent,$connect);
							
							if(!$res_modStudent)
							{
								echo '<p>Update failed (Student)</p>';
							}
							else
							{
								echo '<p>Student account updated!</p>';
							}
						}
						
				
				echo '</div>';
			}
		
		?>

<?php

	// include footer
	include "footer.php";

?>