<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://api.8t2.eu/portal/students/grades/1/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    if (isset($obj->classes)){
      echo '<table style="width:100%">';
      foreach ($obj->classes as $class) {
        echo '<tr><td>'.$class->text.'</td>'; 
        $gradesText = '';
        foreach($class->grades as $grade) {
          if ($gradesText == '') {
            $gradesText .= $grade->Cijfer;
          } else {
            $gradesText .= " - ".$grade->Cijfer;
          }
        }
        echo '<td>'.$gradesText.'</td></tr>';
      }

    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>

<?php
include_once("footer.php");
?>