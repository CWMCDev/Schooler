<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://86.107.110.214/portal/students/grades/1/cc111748/RnlQuFggpslULvtDz0iQ4MvvcdGz1R8NeSWliADpNyDSfF7SXlfkw1kwUvIfYSZBOnkldAfUbKfWPIYGvKnD5lJhLGNEd5jYE4KXaE1QCBuMOLfwy1nFiL25SID8dpComAfhxR5TPww21K42NKa1q258vLMSg5yNSt0fewsKOOWZdgG2kp3OIqT2OGb5dn5O7xQXHj3wlCltruxvLJx5zsywKiEh4kHYrVgWhQMuvIs0JePjglnbl8dDUM87k4b2');
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