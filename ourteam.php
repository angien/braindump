<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/images/favicon.ico">

  <title>Cisco Braindump</title>

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
              <li class="active"><a href="ourteam.php">Our Team</a></li>
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
        <div class="jumbotron">
          <h3>Our Team:</h3>
          <div class="row">
              <div class="row">
                <div class="col-md-2">
                  <img class="profilepic" src="/images/angie_nguyen.jpg" alt="Angie Nguyen"/>
                </div>
                <div class="col-md-10">
                  <div class="well">
                    <p>Angie Nguyen is our back-end developer.  She attends UC San Diego and majors in Computer Science.  For the summer, she's working for Cisco in the Cisco.com and Marketing IT.</p>
                  </div>
                </div>
              </div>
                <div class="row spacingfix2">
                  <div class="col-md-2">
                    <img class="profilepic" src="http://i.picresize.com/images/2014/07/24/0Hma.jpg" alt="John Canela"/>
                  </div>
                  <div class="col-md-10">
                    <div class="well">
                      <p>John Canela is our marketing expert. He goes to school at the New Jersey Institute of Technology and is majoring in Information Technology with a concentration in Network Security and a minor in Business. John is currently working at Cisco as an IT Analyst intern within CITS-Channel Partner Programs.  </p>
                    </div>
                  </div>
                </div>
                <div class="row spacingfix2">
                  <div class="col-md-2">
                    <img class="profilepic" src="/images/kevin_tsang.jpg" alt="Kevin Tsang"/>
                  </div>
                  <div class="col-md-10">
                    <div class="well">
                      <p>Kevin Tsang is our front-end developer.  He attends University of Washington and is majoring in Informatics with a concentration in cybersecurity.  Kevin is currently working at Cisco and is contributing to OpenStack for the summer under GIS-CAS.  He previously helped build physical topologies for Cisco's cloud services project under GIS-ETE.</p>
                    </div>
                  </div>
                </div>
            </div>
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
    <script src="/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
    <script src="/bootstrap-3.2.0-dist/js/docs.min.js"></script>
    <script src=""></script>
  </body>
  </html>
