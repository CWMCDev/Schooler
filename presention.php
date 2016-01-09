<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://86.107.110.214/portal/students/presention/cc111748/RnlQuFggpslULvtDz0iQ4MvvcdGz1R8NeSWliADpNyDSfF7SXlfkw1kwUvIfYSZBOnkldAfUbKfWPIYGvKnD5lJhLGNEd5jYE4KXaE1QCBuMOLfwy1nFiL25SID8dpComAfhxR5TPww21K42NKa1q258vLMSg5yNSt0fewsKOOWZdgG2kp3OIqT2OGb5dn5O7xQXHj3wlCltruxvLJx5zsywKiEh4kHYrVgWhQMuvIs0JePjglnbl8dDUM87k4b2');
    $obj = json_decode($json);
    echo json_encode($obj, JSON_PRETTY_PRINT);
    
    echo '<br><br>';
    
    if (isset($obj->presentie)){
      echo '<table style="width:100%">';
      foreach ($obj->presentie as $week) {
        echo '<tr><td>'.$week->week.'</td>'; 
        foreach($week->dagen as $day) {
          echo "<td><article><table><tr><td>Uur</td><td>Status</td></tr>";
          foreach($day as $hour) {
            echo '<tr><td>'.$hour->hour."</td><td>".$hour->status.'</td></tr>';
          }
          echo "</table></article></td>"; 
        }
        echo '</tr>';
      }
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>


<?php
include_once("footer.php");
?>