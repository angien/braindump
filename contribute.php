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
      <link rel="shortcut icon" href="/images/favicon.ico">

  <!-- for AJAX validation -->
  <script src="validate.js"></script>
    <title>Cisco BrainDump</title>

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap-3.2.0-dist//css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="/bootstrap-3.2.0-dist//css/bootstrap-theme.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    
    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">

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
            <li class="active"><a href="contribute.php">Contribute</a></li>
            <li><a href="manage.php">My Courses</a></li>
            <li><a href="ourteam.php">Our Team</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase spacingfix2">
      <div class="jumbotron">

        <h2>We're excited that you want to make a BrainDump!</h2>

<form action="<?php $PHP_SELF?>" method="post" onsubmit="return finalValidate(['title', 'description','recurring','date','time'])">
    <h3><span class="label label-info">Title:</span></h3>
      <input type="text" name ="title" onkeyup="validate(this.name, this.value)" />
      <input type="checkbox" name="title" disabled><small><span name="title"></span></small><br>
    <h3><span class="label label-info">Description:</span></h3>
      <textarea name ="descrip" onkeyup="validate(this.name, this.value)" rows="8" cols="50"></textarea>
    <input type="checkbox" name="descrip" disabled><small><span name="descrip"></span></small><br>
    <h3><span class="label label-info">Start Date:</span></h3>
    <input type="text" name ="date" onkeyup="validate(this.name, this.value)" />
    <input type="checkbox" name="date" disabled><small><span name="date"></span></small><br>
    <h3><span class="label label-info">Start Time:</span></h3>
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
    <h3><input class="btn btn-default" type="submit" name="submit" value="Create BrainDump"/></h3>
  </form>
<?php

// POSTING TO SQL TABLE
if(isset($_POST["submit"])) {

$link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
if (!$link) { 
  die ('Could not connect to MySQL!'); 
}
$id = $_SESSION['login'];

  // grab fields from input
  $title = $_POST["title"];
  $description = $_POST["descrip"];
  $date=$_POST["date"];
  $time=$_POST["time"];
  $recurring = $_POST["recurring"];
  if ($recurring == 'Yes')
    $recurring = 1;
  else
    $recurring = 0;

  // write SQL insert
  $insert = "INSERT INTO courses
  (
    title,
    description,
    recurring
  )
  VALUES
  (
    '$title',
    '$description',
    '$recurring'
  )";

    // make the query
  $result = mysqli_query($link, $insert);

    // check if insert query worked
  if ($result) {
    $result2 = mysqli_query($link, 
      "SELECT course_id FROM courses WHERE title='$title' AND
      description='$description' AND
      recurring='$recurring'");
    $entries = mysqli_fetch_array($result2);
    $get_new_id = $entries['course_id'];
    mysqli_query($link, "INSERT INTO braindumpers (id, course_id) VALUES ('$id', '$get_new_id')");
    mysqli_query($link, "INSERT INTO webex (course_id, date, time) VALUES ('$get_new_id', '$date', '$time')");

    echo 'Course was successfully created. You can view it in <a href="manage.php">your courses</a>.';
    /*$date_arr = explode("/", $date);
    $time_arr = explode(':', $time);

    $url = 'https://cisco.webex.com/cisco/m.php?';
    $data = array(
      'AT' => 'SM', 
      'MN' => $title, 
      'PW' => 123,
      'YE' => $date_arr[0],
      'MO' => $date_arr[1],
      'DA' => $date_arr[2],
      'HO' => $time_arr[0],
      'MI' => $time_arr[1]
    );

    $postString = http_build_query($data, '', '&');
    $together = $url . $postString;
    echo $together;

    echo "<script type='text/javascript'>
    var url ='" . $together . "'; var xmlhttp=new XMLHttpRequest();
    xmlhttp.open('GET',url);
    xmlhttp.send();
    </script>;";*/
  }
  else // insert or some row was successfully updated
    echo 'Course was NOT created.';

    // close db
  mysqli_close($link);
}


?>


      </div>
    </div>
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
    <script src="/bootstrap-3.2.0-dist//js/bootstrap.min.js"></script>
    <script src="/bootstrap-3.2.0-dist/js/docs.min.js"></script>
    <script src="home.js"></script>
  </body>
</html>
