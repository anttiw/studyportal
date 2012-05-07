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
			
			// Start here on monday! ->
			
			$q_userCheck = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."'";
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
	
	/*
	// ##### LOGIN #################
	if(isset($_POST['loginForm']))
	{
	
		// Check & validate the input
		$username = validate($_POST['username']);
		$password = validate($_POST['password']);
		
		// Check that form was filled
		if(!$username || !$password)
		{
			echo '<p>You did not fill in the necessary fields. Try again!</p>';
		}
		else
		{
			// Check that username and password matches
			
			// Change the normal text password to encrypted password
			// $checkpasswd = sha1($password);
			
			// Make a query to look for users in the database
			$q_userCheck = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."'";
			$res_userCheck = mysql_query($q_userCheck,$connect);
			mysql_close($connect);
			
			// Check that connection was okay and result was fetched
			if(!$res_userCheck)
			{
				echo '<p>Connection to database failed</p>';
			}
			
			// Fetch number of rows returned
			$rows_userCheck = mysql_num_rows($res_userCheck);
			
			// Check how many rows was returned
			if($rows_userCheck == 0)
			{
				echo '<p>No matching users found!</p>';
			}
			elseif($rows_userCheck > 1)
			{
				echo '<p>More than one user found! Error! Run, Forrest, run!</p>';
			}
			else
			{
				// If result was found, set it to an array
				$userInfo = mysql_fetch_array($res_userCheck);
				
				// Set a session for the user
				session_regenerate_id = true;
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
		
		
	}
	*/

?>