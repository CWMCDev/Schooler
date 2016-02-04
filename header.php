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
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Schooler - <?php echo($title); ?></title>
  <!-- Latest jQuery -->
  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script src="/scripts/sonic.js"></script>
  <script src="/scripts/loading.js"></script>
  <link rel="stylesheet" type="text/css" href="dashboard.css">
  <script type="text/javascript">
    function readCookie(name) {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for(var i=0;i < ca.length;i++) {
          var c = ca[i];
          while (c.charAt(0)==' ') c = c.substring(1,c.length);
          if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
    }
    $(document).ready( function () {
      var id = readCookie('id');
      var token = readCookie('token');

      var url = 'http://api.8t2.eu/mail/'+id+'/'+token;

      $.ajax({
        url: url,
        dataType: 'jsonp',
        success: function(result){
          var unread = result.unread;
          if(unread>0){
            $("#mail-count").html(unread);
            $("#mail-count").removeClass('hidden');
            if(typeof updateUnread == 'function'){
              updateUnread(unread);
            }
          }
        }
      });

    })
    
  </script>

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
        <a class="navbar-brand" href="dashboard.php">
          <img src="images/schooler_logo.png" alt="Brand" id="dashboard-logo"/>
        </a>
      </div>
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
            </li>
            <li><a href="schedule.php">Schedule</a></li>
            <!--<li><a href="schedule.php">Rooster</a></li>-->
            <li><a href="http://foto.ccweb.nl" target="_blank">Activiteiten</a></li> 
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/email.php">Postvak-In <span class="badge hidden" id="mail-count">0</span></a></li>
            <li><a href="index.php?destroySession=true"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          </ul>
        </div>
    </div>
  </nav>
  <div class="container">