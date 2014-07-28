<?php 

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

	header ("Location: login.php");

}

$id = $_SESSION['login'];

	// grab fields from input
$course_id = $_REQUEST["course_id"];
$unsub = $_REQUEST["unsub"];

	// make SQL table connection
$link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
if (!$link) { 
	die ('Could not connect to MySQL!'); 
}

// if unsubscribing
if ($unsub) {
	$delete = "DELETE FROM learners WHERE id='$id' AND course_id='$course_id'";
	// make the query
	$result = mysqli_query($link, $delete);

		// check if insert query worked
	if ((!$result) || mysqli_affected_rows($link) <= 0) // 0: query affected no rows; 1: query errored
		echo 'You were NOT unsubscribed.';
	else {
		echo '(',mysqli_affected_rows($link),')',' rows were affected! <br>';
		echo 'You were unsubscribed.';
		header ("Location: manage.php");
	}
}
else {
	// write SQL insert
	$insert = "INSERT INTO learners
	(
		id,
		course_id
	)
	VALUES
	(
		'$id',
		'$course_id'
	)";

		// make the query
	$result = mysqli_query($link, $insert);

		// check if insert query worked
	if ($result) {
		echo 'Subscription was successful.';
		header ("Location: manage.php");
	}
	else // insert or some row was successfully updated
		echo 'You have already subscribed!';
}


// close db
mysqli_close($link);
?>