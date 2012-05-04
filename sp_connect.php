<?php

	// Connect to database "Formulasirkus"
	$user = "sp_dev";
	$password = "team6dev";
	$database = "studyportal";
	$host = "anttiw.ipt.oamk.fi";
	
	$connect = mysql_connect($host,$user,$password);
	mysql_select_db($database,$connect);

?>