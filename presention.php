<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://86.107.110.214/portal/students/presention/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    
    echo '<br><br>';
    
    if (isset($obj->presentie)){
      echo '<table style="width:100%">';
      foreach ($obj->presentie as $week) {
        //echo '<tr><td>'.$week->week.'</td>'; 
        foreach($week->dagen as $day) {
          //echo "<td><article><table><tr><td>Uur</td><td>Status</td></tr>";
          echo '<tr>';
          foreach($day as $hour) {
            $bg = '';
            $msg = '';
            switch ($hour->status) {
              case 'aanw':
                $bg = '4FD57F';
                break;
              
              case 'geoorlafw';
                $bg = '4FD57F';
                $msg = 'geoorloofd afw';

              case 'melding-only';
                $bg = 'FF8C00';
                $msg = 'Melding';

              case 'afw';
                $bg = 'FF0000';
                $msg = 'Afwezig';
              default:
                # code...
                break;
            }
            echo '<td bgcolor='.$bg.'>'.$hour->hour."</td><td>".$hour->status.'</td>';
          }
          echo '</tr>';
          //echo "</table></article></td>"; 
        }
        //echo '</tr>';
      }
      echo '</table>';
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>


<?php
include_once("footer.php");
?>