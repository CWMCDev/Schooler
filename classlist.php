<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://api.8t2.eu/portal/students/classlist/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    if (isset($obj->classList)){
    	echo '<div id="container">';
    	echo '<table class="table table-striped">';
        foreach ($obj->classList as $person) {
          echo '<tr><td>'.$person->name.'</td>';
          echo '<td>'.$person->id.'</td></tr>';
        }
        echo '</table>';
        echo '</div>';
    } else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>


<?php
include_once("footer.php");
?>