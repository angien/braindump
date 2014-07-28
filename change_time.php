<?php

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

	header ("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/images/favicon.ico">

    <title>Cisco BrainDump</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="/bootstrap-3.2.0-dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/bootstrap-3.2.0-dist/assets/js/ie-emulation-modes-warning.js"></script>
    
    <!-- angies -->
    <script src="validate.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/bootstrap-3.2.0-dist/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a id="brandname" class="navbar-brand" href="index.php">BrainDump</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="learn.php">Learn</a></li>
              <li><a href="contribute.php">Contribute</a></li>
              <li><a href="manage.php">My Courses</a></li>
              <li><a href="ourteam.html">Our Team</a></li>
              <li><a href="register.php">Register</a></li>
              <li><a href="logout.php">Log Out</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

    <div class="container theme-showcase spacingfix2" role="main">
      <div class="jumbotron">
  
        <!--Angie's form goes here -->
        <h2>Change Time</h2><br>
   
	<form action="<?php $PHP_SELF?>" method="post" onsubmit="return finalValidate(['recurring','date','time'])">
		<input type="hidden" name ="course_id" value="<?php echo $_REQUEST['course_id'] ?>" />
		<input type="hidden" name ="old_date" value="<?php echo $_REQUEST['date'] ?>" />
		<input type="hidden" name ="old_time" value="<?php echo $_REQUEST['time'] ?>" />
              <h3><span class="label label-info">New Start Date:</span></h3> 
			<input type="text" name ="date" onkeyup="validate(this.name, this.value)" />
		<input type="checkbox" name="date" disabled><small><span name="date"></span></small><br>

		              <h3><span class="label label-info">New Start Time:</span></h3> 
<input type="text" name ="time" onkeyup="validate(this.name, this.value)" />
		<input type="checkbox" name="time" disabled><small><span name="time"></span></small><br>
		              <h3><span class="label label-info">Recurring:</span></h3> 
		 <select name="recurring" onchange="validate(this.name, this.value)">
		<option>No</option>
		<!--<option>SELECT</option>
		<option>Yes</option>
		<option>No</option>-->
		</select>
		<input type="checkbox" name="recurring" checked="true" disabled><small><span name="recurring"></span></small><br>
		<input type="submit" name="submit" value="Create BrainDump">
	</form>

<?php

// POSTING TO SQL TABLE
if(isset($_POST["submit"])) {

	// grab fields from input
	$course_id = $_POST["course_id"];
	$old_date = $_POST["old_date"];
	$old_time = $_POST["old_time"];
	$date=$_POST["date"];
	$time=$_POST["time"];
	$recurring = $_POST["recurring"];
	if ($recurring == 'Yes')
		$recurring = 1;
	else
		$recurring = 0;

	$link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
	if (!$link) { 
		die ('Could not connect to MySQL!'); 
	}

	// write SQL insert
	$update = "UPDATE webex
		SET time='$time', date='$date', link=NULL
		WHERE course_id='$course_id' AND date='$old_date' AND time='$old_time'";

		// make the query
	$result = mysqli_query($link, $update);
	if (mysqli_affected_rows($link) <= 0) // 0: query affected no rows; 1: query errored
		echo 'You changes were NOT made.';
	else {
		echo '(',mysqli_affected_rows($link),')',' rows were affected! <br>';
		echo 'Your changes were made.';
		header ("Location: manage.php");
	}

		// close db
	mysqli_close($link);
}


?>

      </div>
    </div>
      <!-- /container -->
    <div class="footer">
      <img id="ciscologo" src="new-cisco-logo.png" alt="Cisco"/>
      <img id="lastpic" class="floatpics" src="http://static.wixstatic.com/media/89b1d2497b29ccbb7d37be1ec6ef0052.png_srz_p_16_16_85_22_0.50_1.20_0.00_png_srz" />
      <img class="floatpics" src="http://static.wixstatic.com/media/608e7725939b0eda16493c462180552c.wix_mp_srz_p_16_16_85_22_0.50_1.20_0.00_wix_mp_srz" />
      <img class="floatpics" src="http://static.wixstatic.com/media/da00086a27cc2c52ec7a11ec468c4d29.wix_mp_srz_p_16_16_85_22_0.50_1.20_0.00_wix_mp_srz" />
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    <script src="/bootstrap-3.2.0-dist/js/docs.min.js"></script>
    <script src=""></script>
  </body>
</html>





