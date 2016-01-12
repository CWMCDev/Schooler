<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://api.8t2.eu/portal/students/presention/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    
    echo '<br><br>';
    
    if (isset($obj->presentie)){
      foreach ($obj->presentie as $week) {
        //echo '<tr><td>'.$week->week.'</td>'; 
        echo '<div class="col-xs-12 col-md-6">
              <table class="table table-striped">';
        echo'<tr><th width="20px">'.$week->week.'</th>';
        for( $i = 0; $i<10; $i++ ) {
            $uur = $i + 1;
            echo'<th>'.$uur.'</th>';
         }
        echo'</tr>';
        foreach($week->dagen as $dayName => $day) {
          //echo "<td><article><table><tr><td>Uur</td><td>Status</td></tr>";
          echo '<tr><th width="80px">'.$dayName.'</th>';
          foreach($day as $hour) {
            $type = '';
            $msg = '';
            switch ($hour->status) {
              case 'aanw':
                $type = 'success';
                break;
              
              case 'geoorlafw';
                $type = 'success';
                $msg = 'GA';
                break;

              case 'melding-only';
                $type = 'warning';
                $msg = 'Mld';
                break;

              case 'afw';
                $type = 'danger';
                $msg = 'Afw';
                break;
              default:
                # code...
                break;
            }
            echo '<td width="40px" class='.$type.'>'.$msg.'</td>';
          }
          echo '</tr>';
          //echo "</table></article></td>"; 
        }
        echo '</table>
              </div>';
      }
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>


<?php
include_once("footer.php");
?>