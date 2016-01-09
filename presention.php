<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://86.107.110.214/portal/students/profile/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    
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