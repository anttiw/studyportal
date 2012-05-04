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
					<input type="text" name="password" />
					</p>
					<input type="submit" name="submitLogin" value="Log in" />
				</form>';
	}

?>