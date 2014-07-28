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
            <li class="active"><a href="learn.php">Learn</a></li>
            <li><a href="contribute.php">Contribute</a></li>
            <li><a href="manage.php">My Courses</a></li>
            <li><a href="ourteam.php">Our Team</a></li>
            <li><a href="register.php">Register</a></li>
<?PHP

session_start();

if (isset($_SESSION['login']))
  echo "<li><a href='logout.php'>Log Out</a></li>";
else
  echo "<li><a href='login.php'>Log In</a></li>";


?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase spacingfix2" role="main">
      <div class="jumbotron spacefix2">
        <h3>

<?PHP


  $link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
  if (!$link) { 
    die ('Could not connect to MySQL!'); 
  }
  $query = $_SERVER['QUERY_STRING'];
  $str = explode('=', $query);
  $course_id = $str[1];


  $entries = mysqli_query($link, 
    "SELECT title FROM courses WHERE course_id='$course_id'");
  $entries = mysqli_fetch_array($entries);
  $get_title = $entries['title'];

  echo $get_title;


?>

          </h3>
        <h3><span class="label label-info">Recurring: No</span></h3>
        <h3><span class="label label-info">Description:</span></h3>
        <div class="well">
          <p>
            <?PHP


  $link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
  if (!$link) { 
    die ('Could not connect to MySQL!'); 
  }
  $query = $_SERVER['QUERY_STRING'];
  $str = explode('=', $query);
  $course_id = $str[1];


  $entries = mysqli_query($link, 
    "SELECT description FROM courses WHERE course_id='$course_id'");
  $entries = mysqli_fetch_array($entries);
  $get_title = $entries['description'];

  echo $get_title;


?>
          </p>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">WebEx</h3>
              </div>
              <div class="panel-body">
                <ul class="list-group">
                  <li class="list-group-item"><a href=
<?PHP


  $link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
  if (!$link) { 
    die ('Could not connect to MySQL!'); 
  }
  $query = $_SERVER['QUERY_STRING'];
  $str = explode('=', $query);
  $course_id = $str[1];


  $entries = mysqli_query($link, 
    "SELECT host_link FROM webex WHERE course_id='$course_id'");
  $entries = mysqli_fetch_array($entries);
  $get_title = $entries['host_link'];

  echo $get_title;


?>
                    >
                    Host WebEx Link
                  </a></li>

                                    <li class="list-group-item"><a href=
<?PHP


  $link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
  if (!$link) { 
    die ('Could not connect to MySQL!'); 
  }
  $query = $_SERVER['QUERY_STRING'];
  $str = explode('=', $query);
  $course_id = $str[1];


  $entries = mysqli_query($link, 
    "SELECT reg_link FROM webex WHERE course_id='$course_id'");
  $entries = mysqli_fetch_array($entries);
  $get_title = $entries['reg_link'];

  echo $get_title;


?>
                    >
                    Regular Attendee WebEx Link
                  </a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Additional Links</h3>
              </div>
              <div class="panel-body">
                <ul class="list-group">
                  <li class="list-group-item"><a href="#">Powerpoint</a></li>
                  <li class="list-group-item"><a href="#">Manual</a></li>
                  <li class="list-group-item"><a href="#">Exercises</a></li>
                  <li class="list-group-item"><a href="#">Code Samples</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
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
