<?php

	// FUNCTIONS.PHP
	
	// Input validation & checking
	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	// The login form
	function loginForm()
	{
		echo   '<form name="loginForm" method="POST" action="users.php">
					<p>Username: </br>
					<input type="text" name="username" />
					</p>
					<p>Password: </br>
					<input type="password" name="password" />
					</p>
					<input type="submit" name="submitLogin" value="Log in" />
				</form>';
	}
	
	// Form for adding a new admin account
	function addAdminForm()
	{
		echo   '<form name="addAdminForm" method="POST" action="accountman.php">
					<p>
					Firstname: </br>
					<input type="text" name="firstname" /></br>
					Lastname: </br>
					<input type="text" name="lastname" /></br>
					Username: </br>
					<input type="text" name="username" /></br>
					Password: </br>
					<input type="text" name="password" /></br>
					<input type="checkbox" name="superuser" value="1">Has superuser privileges
					</p>
					<p>
					<input type="submit" name="addAdmin" value="Create admin account" />
					</p>
				</form>';
	}
	
	function addStudentForm()
	{
		echo 	'<form name="addStudentForm" method="POST" action="accountman.php">
					<p>
					Firstname: </br>
					<input type="text" name="stfirstname" /></br>
					Lastname: </br>
					<input type="text" name="stlastname" /></br>
					Username: </br>
					<input type="text" name="stusername" /></br>
					Password: </br>
					<input type="text" name="stpassword" /></br>
					</p>
					<p>
					<input type="submit" name="addStudent" value="Create student account" />
					</p>
				</form>';
	}

?>