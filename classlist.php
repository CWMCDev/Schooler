<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://86.107.110.214/portal/students/classlist/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    if (isset($obj->classList)){
        foreach ($obj->classList as $person) {
          echo '<p>'.$person->name.'</p>';
          echo '<p>'.$person->id.'</p>';
        }
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>


<?php
include_once("footer.php");
?>