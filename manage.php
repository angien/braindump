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
            <li><a href="contribute.php">Contribute</a></li>
            <li class="active"><a href="manage.php">My Courses</a></li>
            <li><a href="ourteam.php">Our Team</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase" role="main">
      <div class="jumbotron spacingfix2">
        <div class="page-header">
          <h3>My BrainDumps</h3>
        </div>
    <html>
<?PHP

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

  header ("Location: login.php");

}

$id = $_SESSION['login'];

$link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
if (!$link) { 
  die ('Could not connect to MySQL!'); 
}

  // pull all braindumps
$result = mysqli_query($link, "SELECT * FROM braindumpers, courses WHERE id='$id' AND
  braindumpers.course_id = courses.course_id");

echo "<table class='table'>";
if($result && (mysqli_affected_rows($link)>0)) {
  echo "<tr class='label-primary'><th>Title</th><th>Description</th><th>Date</th><th>Time</th><th>Webex Link</th><th>Make Changes</th></tr>";
  while($row = mysqli_fetch_array($result)){
    echo "<tr><td><a href='more.php?course_id=".$row['course_id']."'>".$row['title']."</a></td><td>".$row['description']."</td>";
    $course_id = $row["course_id"];
    $result2 = mysqli_query($link, "SELECT * FROM webex WHERE course_id=$course_id");
    $row2 = mysqli_fetch_array($result2);
    echo "<td>".$row2['date']."</td>";
    echo "<td>".$row2['time']."</td>";
    if ($row2['host_link'] == NULL) {

    $MO = explode('-',$row2['date'])[1];
    $YE = explode('-',$row2['date'])[0];
    $DA = explode('-',$row2['date'])[2];
    $HO = explode(':',$row2['time'])[0];
    $MI = explode(':',$row2['time'])[1];

    $url = "https://cisco.webex.com/cisco/m.php?AT=SM&PW=123&MN=".$row['title']."&YE=".$YE."&MO=".$MO."&DA=".$DA."&HO=".$HO."&MI=".$MI."&BU=localhost/braindump/add_meeting.php%3Fcourse_id%3D".$row['course_id']."%26title=".$row['title']."%26date=".$row2['date']."%26time=".$row2['time'];

      echo "<td><form action='".$url;
      echo "' method='post'>";
      echo "<input type='submit' value='Create WebEx'/></form></td>";
    }
    else {
      echo '<td><a href="'.$row2['host_link'].'">Click</a></td>';
    }

    echo "<td><form action='change_time.php?course_id=".$row['course_id']."&date=".$row2['date']."&time=".$row2['time'];
    echo "' method='post'>";
    echo "<input type='submit' value='Change Time'/></form></td></tr>";

  }
}
else {
  echo "<tr>You have not created any BrainDumps.</tr>";
}
echo "</table><br>";

    // pull all courses
$result = mysqli_query($link, "SELECT * FROM learners, courses WHERE id='$id' AND learners.course_id = courses.course_id");
echo "<div class='page-header'>
          <h3>My Courses</h3>
        </div>";
echo "<table class='table'>";
if($result && (mysqli_affected_rows($link)>0)) {
  echo "<tr class='label-primary'><th>Title</th><th>Description</th><th>Date</th><th>Time</th><th>WebEx Link</th><th>Subscription</th></tr>";
  while($row = mysqli_fetch_array($result)){
   echo "<tr><td><a href='more.php?course_id=".$row['course_id']."'>".$row['title']."</a></td><td>".$row['description']."</td>";
    $course_id = $row["course_id"];
    $result2 = mysqli_query($link, "SELECT * FROM webex WHERE course_id=$course_id");
    $row2 = mysqli_fetch_array($result2);
    echo "<td>".$row2['date']."</td>";
    echo "<td>".$row2['time']."</td>";
    if ($row2['reg_link'] == NULL) {

      echo "<td>There is no WebEx meeting yet.</td>";
    }
    else {
      echo '<td><a href="'.$row2['reg_link'].'">Click</a></td>';
    }

    echo "<td><form action='subscribe.php?course_id=".$row['course_id']."&unsub=1";
    echo "' method='post'>";
    echo "<input type='submit' value='Unsubscribe'/></form></td></tr>";
  }
}
else {
  echo "<tr>You have not subscribed to any BrainDumps.</tr>";
}
echo "</table><br>";


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
