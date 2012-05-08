<?php

	session_start();

	// USERS.PHP
	include "/home/user/included/studyportal/sp_connect.php";
	include "functions.php";
	
	// LOGIN
	if(isset($_POST['submitLogin']))
	{
		echo '<p>login form submitted!</p>';
		
		$username = validate($_POST['username']);
		$password = validate($_POST['password']);
		
		if(!$username || !$password)
		{
			echo '<p>You did not fill all the necessary fields!</p>';
		}
		else
		{
			echo '<p>All fields filled</p>';
			
			$q_userCheck = "SELECT * FROM users WHERE username='".$username."' AND password='".sha1($password)."'";
			$res_userCheck = mysql_query($q_userCheck,$connect);
			
			if(!$res_userCheck)
			{
				echo '<p>Connection to database failed!</p>';
			}
			
			$rows_userCheck = mysql_num_rows($res_userCheck);
			
			if($rows_userCheck == 0)
			{
				echo '<p>No matching users found!</p>';
			}
			else
			{
				echo '<p>Users found</p>';
				
				$userInfo = mysql_fetch_array($res_userCheck);
				
				
				// Set a session for the user
				session_regenerate_id(true);
				$_SESSION['sessionID'] = $userInfo['user_id'];
				$_SESSION['is_admin'] = $userInfo['is_admin'];
				$_SESSION['is_superuser'] = $userInfo['is_superuser'];
				$_SESSION['firstname'] = $userInfo['firstname'];
				$_SESSION['lastname'] = $userInfo['lastname'];
				session_write_close();
				
				header("location: index.php");
				exit();
				
			}
		}
		
		// Link to index
		echo '<p><a href="index.php">Back to main page</a></p>';
	}
	
	// LOGOUT
	if($_GET['action'] == logout)
	{
		echo '<p>testing!</p>';
		
		session_start();
		unset($_SESSION['sessionID']);
		unset($_SESSION['is_admin']);
		unset($_SESSION['is_superuser']);
		unset($_SESSION['firstname']);
		unset($_SESSION['lastname']);
		header("location: index.php");
		exit();
	}

?>