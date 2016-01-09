<?php
if(!isset($title) || !$title){
  header("HTTP/1.1 403 Forbidden");
  exit;
}

if(!isset($_COOKIE['token']) || !isset($_COOKIE['id'])) {
  // NO Token found
  header('Location: index.php?noToken=true');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Schooler - <?php echo($title); ?></title>
  <!-- Latest jQuery -->
  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
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
          <li><a href="dashboard.php">Dashboard</a></li>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown">Student<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="cijfers.php">Cijfers</a></li>
              <li><a href="presention.php">Presentie</a></li>
              <li><a href="classlist.php">Klassenlijst</a></li>
              <li><a href="profile.php">Profiel</a></li>
            </ul>
          </li> <!--dropdown-->
          <li><a href="http://foto.ccweb.nl" target="_blank">Activiteiten</a></li> 
          <li><a href="schedule.php">Rooster</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php?destroySession=true"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
      </div> <!-- collapse navbar-collapse -->
    </div> <!-- container-fluid -->
  </nav>