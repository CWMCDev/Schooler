<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
$json = file_get_contents('http://api.8t2.eu/portal/students/grades/1/'.$_COOKIE['id'].'/'.$_COOKIE['token'],false,$context);
    $obj = json_decode($json);
    if (isset($obj->classes)){
      echo '<div><table class="table table-striped">';
      foreach ($obj->classes as $class) {
        echo '<tr><td width="100px">'.$class->text.'</td>'; 
        $gradesText = '';
        foreach($class->grades as $grade) {
          $gradesText = $grade->Cijfer;
          echo '<td width="25px">'.$gradesText.'</td>';
        }
        echo '<td></td></tr>';
      }
      echo '</div>';
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>

<?php
include_once("footer.php");
?>