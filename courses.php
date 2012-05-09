<?php

	session_start();
	
	// COURSES.PHP
	
	// All included files here
	include "/home/user/included/studyportal/session.php";
	include "/home/user/included/studyportal/sp_connect.php";
	include "functions.php";
	
	include "header.php";

?>

//alkaa addcourse
/*<html>
<body>
<?php
$link=mysql_connect("localhost","root","kdt9edhq");
  $database='studyportal';
  if (!$link)
  die('Failed to connect to Server'.mysql_error());
  $db=mysql_select_db($database, $link);
  session_start();
  if(!$db)
  die('Failed to select Data Base '.mysql_error());

if(isset($_GET['process']))
{
$query="INSERT INTO courses (course_id, course_name, course_description, course_content, course_grading, course_requirements, course_start, course_end)VALUES ('NULL','".$course."','".$description."','".$content."','".$requirements."','".$grading."','".$coursestart."','".$courseend."');
//echo $query; exit;
$result = mysql_query($query) or die(mysql_error());
if(!$result)
{
$msg = "not Inserted";
}
else
{
$msg = "Inserted";
header("location:result.php?m=".$msg);
}
}

?>

		<form id="addCourse" name="addCourse" method="post" action="result.php?process">

		<p>Course Name:</p>
		<input name="course" type="text" id="course" />
    		<p>Description:</p>
		<textarea rows="3" cols="20" input name="description" type="text" id="description"></textarea>
		<p>Content:</p>
		<textarea rows="3" cols="20" input name="content" type="text" id="content"></textarea>
		<p>Grading:</p>
		<textarea rows="3" cols="20" input name="grading" type="text" id="grading"></textarea>
		<p>Requirements:</p>
		<textarea rows="3" cols="20" input name="requirements" type="text" id="requirements"></textarea>
		<p>Course start:</p>
		<input name="coursestart" type="text" id="coursestart" />
		<p>Course end:</p>
		<input name="courseend" type="text" id="courseend" />
		<input type="submit" name="Submit" value="Submit" />
</body>
</html>
tämä siis on se mun courses1.php tiedosto joka jostain syystä ei lisää tietoja tietokantaan. jos viittisit vilkasta sitä nii saisin nuo muut implementoitua.

tämä taas on result.php

<html>
<body>
<?php

$course = $_POST['course'];
$description = $_POST['description'];
$content = $_POST['content'];
$requirements = $_POST['requirements'];
$grading = $_POST['grading'];
$coursestart = $_POST['coursestart'];
$courseend = $_POST['courseend'];

echo "Course name: ". $course . "<br />";
echo "Description: ". $description . "<br />";
echo "Content: ". $content . "<br />";
echo "Requirements: ". $requirements . "<br />";
echo "Grading: ". $grading . "<br />";
echo "Course starts: ". $coursestart . "<br />";
echo "Course ends: ". $courseend . "<br />";
?>


</body>
</html>
*/

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