<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://api.8t2.eu/portal/students/profile/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    if (isset($obj->student)){
      echo '<p>'.$obj->student->name.'</p>';
      echo '<p>'.$obj->student->studentnumber.'</p>';
      echo '<p>'.$obj->student->class.'</p>';
      echo '<p>'.$obj->student->birthdate.'</p>';
      echo '<p>'.$obj->student->phonenumbers->home.'</p>';
      echo '<p>'.$obj->student->phonenumbers->mobile.'</p>';
      echo '<p>'.$obj->adress->street.'</p>';
      echo '<p>'.$obj->adress->zipcode.'</p>';
      echo '<p>'.$obj->adress->place.'</p>';
      echo '<p>'.$obj->mentor->name.'</p>';
      echo '<p>'.$obj->mentor->abbreviation.'</p>';
      echo '<p>'.$obj->mentor->email.'</p>';
      echo '<p>'.$obj->Profile->profile.'</p>';
      echo '<p>'.$obj->Profile->code.'</p>';
      echo '<p>'.$obj->Profile->abbreviation.'</p>';
      echo '<p>'.$obj->Profile->year.'</p>';
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>

<?php
include_once("footer.php");
?>