<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://86.107.110.214/portal/students/profile/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    if (isset($obj->student)){
      echo '<h1>'.$obj->student->name.'</h1>';
      echo '<h1>'.$obj->student->studentnumber.'</h1>';
      echo '<h1>'.$obj->student->class.'</h1>';
      echo '<h1>'.$obj->student->birthdate.'</h1>';
      echo '<h1>'.$obj->student->adress->street.'</h1>';
      echo '<h1>'.$obj->student->phonenumbers->home.'</h1>';
      echo '<h1>'.$obj->student->phonenumbers->mobile.'</h1>';
      echo '<h1>'.$obj->student->adress->zipcode.'</h1>';
      echo '<h1>'.$obj->student->adress->place.'</h1>';
      echo '<h1>'.$obj->student->mentor->name.'</h1>';
      echo '<h1>'.$obj->student->mentor->abbreviation.'</h1>';
      echo '<h1>'.$obj->student->mentor->email.'</h1>';
      echo '<h1>'.$obj->student->Profile->profile.'</h1>';
      echo '<h1>'.$obj->student->Profile->code.'</h1>';
      echo '<h1>'.$obj->student->Profile->abbreviation.'</h1>';
      echo '<h1>'.$obj->student->Profile->year.'</h1>';
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>

<?php
include_once("footer.php");
?>