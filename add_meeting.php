<?php

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

	header ("Location: login.php");
}

$link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
if (!$link) { 
	die ('Could not connect to MySQL!'); 
}

$status = $_REQUEST["ST"];
if ($status == "SUCCESS") {

	$course_id=$_REQUEST["course_id"];
	$date=$_REQUEST['date'];
	$time=$_REQUEST['time'];
	$meeting_id=$_REQUEST["MK"];

	$url = "https://cisco.webex.com/cisco/m.php?AT=JM&MK=".$meeting_id."&PW=123";

 	$update = "UPDATE webex
		SET reg_link='$url' 
		WHERE course_id='$course_id' AND date='$date' AND time='$time'";
		mysqli_query($link, $update);
		if (mysqli_affected_rows($link) <= 0) // 0: query affected no rows; 1: query errored
			echo 'Insert was NOT successful.';
		else {
			echo '(',mysqli_affected_rows($link),')',' rows were affected! <br>';
			echo 'The meeting was successfully created.';
		}

		$url = "https://cisco.webex.com/cisco/m.php?AT=HM&MK=".$meeting_id."&PW=123";

 	$update = "UPDATE webex
		SET host_link='$url' 
		WHERE course_id='$course_id' AND date='$date' AND time='$time'";
		mysqli_query($link, $update);
		if (mysqli_affected_rows($link) <= 0) // 0: query affected no rows; 1: query errored
			echo 'Insert was NOT successful.';
		else {
			echo '(',mysqli_affected_rows($link),')',' rows were affected! <br>';
			echo 'The meeting was successfully created.';
			header ("Location: manage.php");
		}

	// close db
	mysqli_close($link);

}
else
	echo "The meeting could not be created. Please make sure you are logged in on WebEx."


?>