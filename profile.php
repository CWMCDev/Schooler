<?php
$title = "Profile";
include_once("header.php");
?>

<?php
$json = file_get_contents('http://api.8t2.eu/portal/students/profile/'.$_COOKIE['id'].'/'.$_COOKIE['token']);
    $obj = json_decode($json);
    if (isset($obj->student)){
echo '<div id="student_short'>;
echo '<table table-striped width="100px">';
echo '<tr><td>'.$obj->student->name.'</td></tr>';
echo '<tr><td>Leerlingnummer</td>';
echo '<td>'.$obj->student->studentnumber.'<td></tr>';
    } 
echo '</table>';
echo '</div>';
    else {
      $error = "Ongeldige gebruikersnaam of wachtwoord!";
    }
?>

<?php
include_once("footer.php");
?>