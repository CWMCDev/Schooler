<?php
if(isset($_GET['destroySession'])) {
  setcookie('token', '', time()-3600);
  setcookie('ztoken', '', time()-3600);
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $user = $_POST['username'];
    if (substr($user,0,2) == 'cc'){
      $user = substr($_POST['username'],2);
    }

    $json = file_get_contents('http://api.8t2.eu/auth/register/'. $user .'/' . $_POST['password']);
    $obj = json_decode($json);
    if (isset($obj->token)){
      setcookie('id', "cc".$user, time() + (60 * 60 * 24 * 365), "/");
      setcookie('token', $obj->token, time() + (60 * 60 * 24 * 365), "/");
      header('Location: dashboard.php');
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
  }
}

if(isset($_COOKIE['token'])) {
  // NO Token found
  header('Location: dashboard.php');
}

//Error Handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(empty($_POST['username'])){
    $error = "Voer een gebruikersnaam in.";
  } elseif (empty($_POST['password'])){
    $error = "Voer een wachtwoord in.";
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if(isset($_GET['noToken'])){
    $error = "Log eerst in!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Schooler</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="main.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <img class"img-responsive" src="images/schooler_logo.jpg" alt="Logo" id="logo">
    <?php if($error != null){
      echo'<div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        '.$error.'
      </div>';
    }?>
    <form class="form-signin" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
      <h2 class="form-signin-heading">Please sign in</h2>
      <label for="username" class="sr-only">Leerlingnummer</label>
      <input type="username" id="username" name="username" class="form-control" placeholder="Leerlingnummer" required <?php if(empty($_POST['username'])){echo "autofocus";} ?> value=<?php if(!empty($_POST['username'])){echo $_POST['username'];} ?>>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required <?php if(!empty($_POST['username'])){echo "autofocus";} ?>>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

  </div> <!-- /container -->
</body>
</html>

