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

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->


      <div class="jumbotron spacingfix2">
        <div class="row">
          <div class="jumbotron col-sm-7">
            <h2>Welcome to BrainDump!</h2>
            <p>We are a repository where Cisco employees can share knowledge with each other.  Any employee is welcome to make an account and follow topics they are interested in.  They can also create crash courses for any particular subject to share with others.</p>
            <p><a id="learnbutton" href="learn.html" class="btn btn-primary btn-lg" role="button">Come dump your brain! &raquo;</a></p>
          </div>
          <div class="jumbotron col-sm-5">
            <div class="row centerfix">


<?PHP


if (isset($_SESSION['login'])) {

  $link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
  if (!$link) { 
    die ('Could not connect to MySQL!'); 
  }

  $id = $_SESSION['login'];

  $entries = mysqli_query($link, 
    "SELECT name FROM users WHERE id='$id'");
  $entries = mysqli_fetch_array($entries);
  $get_name = $entries['name'];

  echo "<p>Welcome, " . $get_name . "!</p>";
}
else
  echo "<p>Please log in below.</p>";


?>

  <form action="<?php $PHP_SELF?>" method="post" onsubmit="return finalValidate(['email', 'pass'])">
    <h3><span class="label label-info">Cisco E-mail:</span></h3>
    <p><input type="text" name ="email" onkeyup="validate(this.name, this.value)" />
    <input type="checkbox" name="email" disabled></p><small><span name="email"></span></small>
     <h3><span class="label label-info">Password:</span></h3>
    <p><input type="password" name ="pass" onkeyup="validate(this.name, this.value)" />
    <input type="checkbox" name="pass" disabled></p><small><span name="pass"></span></small>
 <input type="submit" name="submit" class="btn btn-lg btn-default" value="Login">
  </form>

            </div>
          </div>
        </div>

        <div id="carousel-example-generic" class="carousel slide spacingfix dropshadow" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="item active">
              <img class="picturefix" src="http://i.picresize.com/images/2014/07/24/Ibej0.png" alt="Python">
            </div>
            <div class="item">
              <img class="picturefix" src="http://i.picresize.com/images/2014/07/24/OKtuN.png" alt="MySQL">
            </div>
            <div class="item">
              <img class="picturefix" src="http://i.picresize.com/images/2014/07/24/wxv7K.png" alt="PHP">
            </div>
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
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
    <script src="/bootstrap-3.2.0-dist//js/bootstrap.min.js"></script>
    <script src="/bootstrap-3.2.0-dist/js/docs.min.js"></script>
    <script src="home.js"></script>
  </body>
</html>
<?php 
// POSTING TO SQL TABLE
if(isset($_POST["submit"])) {

  // grab fields from input
  $email = $_POST["email"];
  $password = $_POST["pass"];

  
  // make SQL table connection
  $link = mysqli_connect('localhost','root','', 'cisco_braindump'); 
  if (!$link) { 
    die ('Could not connect to MySQL!'); 
  }

  // write SQL insert
  $validate = mysqli_query($link, "SELECT id FROM users WHERE email='$email' AND 
    password='$password'");
  $entries = mysqli_fetch_array($validate);


  // check if insert query worked
  if (!empty($entries)) {
    session_start();
    $_SESSION['login'] = $entries['id'];
    header ("Location: manage.php");
  }
  else // insert or some row was successfully updated
    echo 'Incorrect E-mail/Password combination.';

    // close db
    mysqli_close($link);
  }
?>