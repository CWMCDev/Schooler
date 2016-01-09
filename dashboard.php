<?php
if(!isset($_COOKIE['token'])) {
  // NO Token found
  header('Location: index.php?noToken=true');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Schooler - Dashboard</title>
	<!-- Latest compiled and minified CSS Bootstrap-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme Bootstrap-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript Bootstrap-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="dashboard.css">
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">
        <img src="images/schooler_logo.jpg" alt="Brand" id="dashboard-logo"/>
      </a>
    </div> <!-- narbar-header -->
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Dashboard</a></li>
          <li class="dropdown">
          <a ata-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="student-dropdown" class="dropdown-toggle" data-toggle="dropdown" href="#">Student<span class="caret"></span></a>
          <ul class="dropdown-menu" aria-labelledby="student-dropdown">
            <li><a href="#">Cijfers</a></li>
            <li><a href="#">Presentie</a></li>
            <li><a href="#">Klassenlijst</a></li>
            <li><a href="#">Profiel</a></li>
          </ul>
        </li> <!--dropdown-->
        <li><a href="http://foto.ccweb.nl" target="_blank">Activiteiten</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?destroySession=true"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div> <!-- collapse navbar-collapse -->
  </div> <!-- container-fluid -->
</nav>
</body>
</html>