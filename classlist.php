<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
$json = file_get_contents('http://api.8t2.eu/portal/students/classlist/'.$_COOKIE['id'].'/'.$_COOKIE['token'],false,$context);
    $obj = json_decode($json);
    if (isset($obj->classList)){
    	echo '<div id="container">';
    	echo '<table class="table table-striped width="300px">';
        foreach ($obj->classList as $person) {
          echo '<tr><td width="100px">'.$person->name.'</td>';
          echo '<td width="200px">'.$person->id.'</td></tr>';
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