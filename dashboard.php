<?php
$title = "Dashboard";
include_once("header.php");
?>
<?php
$json = file_get_contents('http://api.8t2.eu/portal/students/profile/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    if (isset($obj->student->name)){
      echo $obj->student->name;
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>

<?php
include_once("footer.php");
?>
