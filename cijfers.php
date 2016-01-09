<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://86.107.110.214/portal/students/grades/1/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    if (isset($obj->student)){
      foreach ($obj->classes as $class) {
        echo '<h1>'.$class->text.'</h1>'; 
      }

    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>

<?php
include_once("footer.php");
?>